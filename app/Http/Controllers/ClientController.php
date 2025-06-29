<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;

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

    public function list()
    {
        $clients = Client::all();
        return view('clients.list', [
            'clients' => $clients
        ]);
    }
}
