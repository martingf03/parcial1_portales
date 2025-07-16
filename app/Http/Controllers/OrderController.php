<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Carbon;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Client\Payment\PaymentClient;


class OrderController extends Controller
{
    public function create()
    {
        $client = Auth::user()->client;

        if (!$client) {
            return redirect()->route('services')->with('error', 'No tenés un cliente asociado a tu usuario');
        }

        $services = Service::all();

        return view('orders.create', [
            'services' => $services
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_ids' => 'required|array',
            'service_ids.*' => 'exists:services,id',
            'problem_description' => 'required|string'
        ], [
            'service_ids.required' => 'Debe elegir al menos un servicio',
            'problem_description.required' => 'Debe llenar el campo con la descripción de su problema.'
        ]);

        $client = Auth::user()->client;

        if (!$client) {
            return back()->with('error', 'No existe un cliente asociado a tu usuario');
        }

        $selectedServices = Service::whereIn('id', $validated['service_ids'])->get();

        $totalPrice = $selectedServices->sum('price');
        $estimatedDays = $selectedServices->sum('duration');

        $order = Order::create([
            'client_id' => $client->id,
            'status' => 'pending',
            'total_price' => $totalPrice,
            'problem_description' =>  $validated['problem_description'],
            'estimated_days' => $estimatedDays
        ]);

        $attachData = [];
        foreach ($selectedServices as $service) {
            $attachData[$service->id] = ['price' => $service->price];
        }

        $order->services()->attach($attachData);

        return redirect()->route('orders.show', $order)
            ->with('success', 'Hemos generado su pedido de contratación.');
    }

    public function show($id)
    {
        $order = Order::with('services')->findOrFail($id);

        if ($order->client_id !== Auth::user()->client->id) {
            abort(403, 'No se puede mostrar el contenido.');
        }

        return view('orders.show', [
            'order' => $order
        ]);
    }

    public function cancelConfirmation($id)
    {
        $order = Order::with('services')->findOrFail($id);

        if ($order->client_id !== Auth::user()->client->id) {
            abort(403, 'No se puede mostrar el contenido.');
        }

        if ($order->status !== 'pending') {
            return redirect()->route('orders.show', $id)->with('Solo podés cancelar pedidos pendientes.');
        }

        return view('orders.cancel', [
            'order' => $order
        ]);
    }

    public function cancel($id)
    {
        $order = Order::with('services')->findOrFail($id);
        $order->status = 'cancelled';
        $order->save();

        return redirect()->route('client.profile')->with('success', "Cancelaste el pedido #{$order->id}");
    }

    /* Las funciones de pago de MercadoPago */

    public function pay(Order $order)
    {
        if ($order->client_id !== Auth::user()->client->id || $order->status !== 'pending') {
            abort(403, 'No tenés permisos para realizar esta acción.');
        }

        $accessToken = config('mercadopago.access_token');
        $publicKey = config('mercadopago.public_key');

        MercadoPagoConfig::setAccessToken($accessToken);

        $item = [
            'title' => "Pago por orden #{$order->id}",
            'quantity' => 1,
            'unit_price' => (float) $order->total_price,
            'currency_id' => 'ARS'
        ];

        $backUrls = array(
            'success' => str_replace('http://', 'https://', route('orders.success', $order)),
            'failure' => str_replace('http://', 'https://', route('orders.failure', $order)),
        );

        $client = new PreferenceClient();
        try {
            $preference = $client->create([
                'items' => [$item],
                'back_urls' => $backUrls,
                'auto_return' => 'approved',
                'external_reference' => $order->id,
                'notification_url' => url(route('orders.payment-confirmation')),
                'binary_mode' => true
            ]);

            return view('orders.payment', [
                'preference_id' => $preference->id,
                'public_key' => $publicKey,
                'order' => $order
            ]);
        } catch (\MercadoPago\Exceptions\MPApiException $e) {
            dd($e->getApiResponse());
        }
    }

    public function success(Request $request, Order $order)
    {
        $paymentId = $request->query('payment_id');
        $status = $request->query('status');

        if ($status === 'approved' && !$order->paid_at) {
            $order->update([
                'status' => 'paid',
                'paid_at' => now()
            ]);
        }

        return view('orders.success', compact('order'));
    }

    public function failure(Request $request, Order $order)
    {
        $status = $request->query('status');
        $paymentId = $request->query('payment_id');

        return view('orders.failure', [
            'order' => $order,
            'status' => $status,
            'payment_id' => $paymentId,
        ]);
    }

        public function paymentConfirmation(Request $request)
        {
            Log::info('Webhook recibido', $request->all());

            $type = $request->get('type');
            $id = $request->get('data')['id'] ?? null;

            if ($type === 'payment' && $id) {
                try {
                    MercadoPagoConfig::setAccessToken(config('mercadopago.access_token'));

                    $paymentClient = new PaymentClient;
                    $payment = $paymentClient->get($id);

                    if ($payment->status === 'approved') {

                        $orderId = $payment->external_reference;
                        $order = Order::find($orderId);

                        if ($order && $order->status !== 'paid') {
                            $order->status = 'paid';
                            $order->paid_at = $payment->date_approved;
                            $order->save();

                            Log::info("Orden #{$order->id} marcada como pagada vía webhook.");
                        }
                    }
                } catch (\Exception $e) {
                    Log::error('Error al procesar webhook: ' . $e->getMessage());
                }
            }

            return response()->json(['status' => 'ok'], 200);
        }
}
