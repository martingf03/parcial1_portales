<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Client\Preference;


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
            'success' => route('orders.success', $order),
            'failure' => route('orders.failure', $order),
            'pending' => route('orders.pending', $order)
        );


        $client = new PreferenceClient();
        try {
            $preference = $client->create([
                'items' => [$item],
            ]);
            $preference->back_urls=$backUrls;
            $preference->auto_return='approved';
        } catch (\MercadoPago\Exceptions\MPApiException $e) {
            dd($e->getApiResponse());
        }


        return view('orders.payment', [
            'preference_id' => $preference->id,
            'public_key' => $publicKey,
            'order' => $order
        ]);
    }

    public function success()
    {
        return view('orders.success');
    }

    public function failure()
    {
        return view('orders.failure');
    }

    public function pending()
    {
        return view('orders.pending');
    }

    public function paymentConfirmation(Request $request)
    {
        Log::info(collect($request->input()));
    }
}
