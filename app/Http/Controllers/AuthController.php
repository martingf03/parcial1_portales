<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Client;

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

    public function register()
    {
        return view("auth.register");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Datos necesarios para la tabla users:
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            // Datos adicionales para sumar a la tabla clients del sql:
            'surname' => 'required|string|max:255',
            'cuil' => 'required|string|max:20|unique:clients,cuil',
            'telephone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ], [
            'email.unique' => 'Este email ya está registrado.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'cuil.unique' => 'Este CUIL ya está registrado.',
        ]);

        // Esto para la creación del User en tabla users del sql:
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'cliente',
        ]);

        // Esto para la creación del Cliente en tabla clients del sql:
        Client::create([
            'name' => $validated['name'],
            'surname' => $validated['surname'],
            'cuil' => $validated['cuil'],
            'telephone' => $validated['telephone'],
            'address' => $validated['address'],
            'user_id' => $user->id,
        ]);


        Auth::login($user);

        return redirect()
            ->route('blog.index')
            ->with('success', '¡Registro exitoso! Ahora estás autenticado.');
    }
}
