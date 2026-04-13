<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\CodigoVerificacao;
use App\Models\Cliente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegistrarClienteController extends Controller
{
    public function showRegistrar()
    {
        if (Auth::guard('cliente')->check()) {
            return redirect()->route('home');
        }

        return view('login.registrar-cliente');
    }

    public function registrar(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:100'],
            'telefone' => ['required', 'string', 'min:10', 'max:20', 'regex:/^[\+\d\s\(\)\-]+$/'],
            'email'    => ['required', 'email', 'unique:clientes,email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ], [
            'name.required'      => 'O nome completo é obrigatório.',
            'telefone.required'  => 'O telefone é obrigatório.',
            'telefone.min'       => 'O telefone deve ter no mínimo 10 dígitos.',
            'telefone.regex'     => 'Digite apenas números, espaços, parênteses e traços.',
            'email.required'     => 'O e-mail é obrigatório.',
            'email.email'        => 'Digite um e-mail válido.',
            'email.unique'       => 'Este e-mail já está cadastrado.',
            'password.required'  => 'A senha é obrigatória.',
            'password.min'       => 'A senha deve ter no mínimo 8 caracteres.',
            'password.confirmed' => 'As senhas não coincidem.',
        ]);

        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $cliente = Cliente::create([
            'name'                          => $request->name,
            'telefone'                      => $request->telefone,
            'email'                         => $request->email,
            'password'                      => Hash::make($request->password),
            'email_verification_code'       => $code,
            'email_verification_expires_at' => Carbon::now()->addMinutes(15),
        ]);

        Mail::to($cliente->email)->send(new CodigoVerificacao($code));

        $request->session()->put('verify_email', $cliente->email);

        return redirect()->route('confirmar-email');
    }
}
