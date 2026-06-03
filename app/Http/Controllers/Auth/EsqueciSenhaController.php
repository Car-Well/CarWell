<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class EsqueciSenhaController extends Controller
{
    public function showForm()
    {
        return view('login.esqueci-senha');
    }

    public function enviarLink(Request $request)
    {
        $request->validate(['email' => ['required', 'email']], [
            'email.required' => 'Informe seu e-mail.',
            'email.email'    => 'Digite um e-mail válido.',
        ]);

        ResetPassword::createUrlUsing(function ($notifiable, $token) {
            return route('senha.redefinir.form', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ]);
        });

        $status = Password::broker('clientes')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', 'Link de redefinição enviado! Verifique seu e-mail.')
            : back()->withErrors(['email' => 'Nenhuma conta encontrada com este e-mail.']);
    }

    public function showReset(string $token, Request $request)
    {
        return view('login.redefinir-senha', [
            'token' => $token,
            'email' => $request->query('email', ''),
        ]);
    }

    public function redefinir(Request $request)
    {
        $request->validate([
            'token'                 => ['required'],
            'email'                 => ['required', 'email'],
            'password'              => ['required', 'min:8', 'confirmed'],
        ], [
            'password.min'       => 'A senha deve ter ao menos 8 caracteres.',
            'password.confirmed' => 'As senhas não conferem.',
        ]);

        $status = Password::broker('clientes')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($cliente, $password) {
                $cliente->forceFill(['password' => Hash::make($password)])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login-cliente')->with('status', 'Senha redefinida com sucesso! Faça login.')
            : back()->withErrors(['email' => 'Link inválido ou expirado. Solicite um novo.']);
    }
}
