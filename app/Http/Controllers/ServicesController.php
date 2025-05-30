<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServicesController extends Controller
{
    public function services() {
        $services = Service::all();

        return view("services", ["services"=> $services]);
    }

}
