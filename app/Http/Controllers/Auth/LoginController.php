<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admHome');
        }

        if (Auth::guard('cliente')->check()) {
            return redirect()->route('home');
        }

        return view('login.login-cliente');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required'    => 'O e-mail é obrigatório.',
            'email.email'       => 'Digite um e-mail válido.',
            'password.required' => 'A senha é obrigatória.',
        ]);

        // Tenta login como admin primeiro
        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('admHome');
        }

        // Tenta login como cliente
        $cliente = Cliente::where('email', $credentials['email'])->first();

        if ($cliente && ! $cliente->email_verified_at) {
            $request->session()->put('verify_email', $cliente->email);
            return redirect()->route('confirmar-email')
                ->withErrors(['email' => 'Confirme seu e-mail antes de entrar.']);
        }

        if (Auth::guard('cliente')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }

        return back()
            ->withErrors(['email' => 'E-mail ou senha incorretos.'])
            ->withInput($request->only('email'));
    }
}
