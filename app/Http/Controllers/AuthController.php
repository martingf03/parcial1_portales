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

    public function authenticate(Request $request)
    {

        $validated = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|string',
            ],
            [
                'email.required' => 'Debes ingresar tu email.',
                'email.email' => 'El email ingresado no es válido.',
                'password.required' => 'Debes ingresar tu contraseña.',
            ]
        );

        if (Auth::attempt($validated)) {
            return redirect()
                ->intended(route('blog.index'))
                ->with('success', 'Sesión iniciada con éxito.');
        }

        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Las credenciales ingresadas son incorrectas.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route("auth.login")
            ->with("success", "Sesión cerrada con éxito.");
    }
}
