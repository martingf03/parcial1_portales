<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }

    public function authenticate()
    {
        $credentials = request()->only(["email", "password"]);

        if (Auth::attempt($credentials)) {
            return redirect()
                ->intended(route("blog.index"))
                ->with("success", "Sesión iniciada con éxito.");
        }

        return redirect()
            ->back()
            ->withInput()
            ->with("error", "Las credenciales ingresadas son incorrectas.");
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
        ->route("auth.login")
        ->with("success","Sesión cerrada con éxito.");
    }
}
