<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

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
}
