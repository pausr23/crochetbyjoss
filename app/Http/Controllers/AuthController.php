<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Mostrar formulario de inicio de sesión
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Manejar el inicio de sesión
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            // Si el inicio de sesión es exitoso, redirigir al home
            return redirect('/');
        }

        return back()->withErrors(['email' => 'Credenciales incorrectas']);
    }

    // Cerrar sesión
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Sesión cerrada correctamente');
    }
}