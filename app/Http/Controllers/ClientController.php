<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function user()
    {
        $client = Auth::user()->client;
        $orders = $client->orders()->with('services')->latest()->get();

        return view('clients.user', [
            'client' => $client,
            'orders' => $orders
        ]);
    }

    public function edit()
    {
        $client = Auth::user()->client;
        return view('clients.edit', [
            'client' => $client,
        ]);
    }

    public function update(Request $request)
    {
        $client = Auth::user()->client;
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'cuil' => [
                'nullable',
                'string',
                'max:11',
            ],
        ], [
            'name.required' => 'Debes ingresar tu nombre',
            'name.string' => 'El nombre debe ser texto válido',

            'surname.required' => 'Debes ingresar tu apellido',
            'surname.string' => 'El apellido debe ser texto válido',

            'telephone.required' => 'Debes ingresar tu teléfono',
            'telephone.string' => 'El teléfono debe ser texto válido',
            'telephone.max' => 'El teléfono no debe exceder los 20 caracteres',

            'address.required' => 'Debes ingresar tu dirección',
            'address.string' => 'La dirección debe ser texto válido',

            'cuil.string' => 'El CUIL debe ser texto válido',
            'cuil.max' => 'El CUIL no debe exceder los 11 caracteres',
        ]);

        $client->update($validated);
        return redirect()
            ->route('client.profile')
            ->with('success', 'Se actualizaron tus datos con éxito');
    }

    public function list()
    {
        $clients = Client::all();
        return view('clients.list', [
            'clients' => $clients
        ]);
    }
}
