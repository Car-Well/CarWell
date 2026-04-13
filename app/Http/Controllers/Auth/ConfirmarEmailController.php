<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\CodigoVerificacao;
use App\Models\Cliente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ConfirmarEmailController extends Controller
{
    public function showConfirmar(Request $request)
    {
        if (! $request->session()->has('verify_email')) {
            return redirect()->route('registrar');
        }

        return view('login.confirmar-email');
    }

    public function confirmar(Request $request)
    {
        $request->validate([
            'code' => ['required', 'digits:6'],
        ], [
            'code.required' => 'Digite o código de verificação.',
            'code.digits'   => 'O código deve ter 6 dígitos.',
        ]);

        $email = $request->session()->get('verify_email');

        if (! $email) {
            return redirect()->route('registrar');
        }

        $cliente = Cliente::where('email', $email)
                          ->whereNull('email_verified_at')
                          ->first();

        if (! $cliente) {
            return redirect()->route('registrar');
        }

        if (Carbon::now()->isAfter($cliente->email_verification_expires_at)) {
            return back()->withErrors(['code' => 'Código expirado. Clique em "Reenviar código".']);
        }

        if ($request->code !== $cliente->email_verification_code) {
            return back()->withErrors(['code' => 'Código incorreto. Tente novamente.']);
        }

        $cliente->update([
            'email_verified_at'             => Carbon::now(),
            'email_verification_code'       => null,
            'email_verification_expires_at' => null,
        ]);

        $request->session()->forget('verify_email');

        Auth::guard('cliente')->login($cliente);
        $request->session()->regenerate();

        return redirect()->route('home');
    }

    public function reenviar(Request $request)
    {
        $email = $request->session()->get('verify_email');

        if (! $email) {
            return redirect()->route('registrar');
        }

        $cliente = Cliente::where('email', $email)
                          ->whereNull('email_verified_at')
                          ->first();

        if (! $cliente) {
            return redirect()->route('registrar');
        }

        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $cliente->update([
            'email_verification_code'       => $code,
            'email_verification_expires_at' => Carbon::now()->addMinutes(15),
        ]);

        Mail::to($cliente->email)->send(new CodigoVerificacao($code));

        return back()->with('reenvio', 'Novo código enviado para o seu e-mail.');
    }
}
