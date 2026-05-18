<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PerfilController extends Controller
{
    public function show()
    {
        return view('login.perfil', [
            'cliente' => Auth::guard('cliente')->user(),
        ]);
    }

    public function update(Request $request)
    {
        $cliente = Auth::guard('cliente')->user();

        $request->validate([
            'name'       => ['nullable', 'string', 'max:100'],
            'email'      => ['required', 'email', 'max:255', Rule::unique('clientes', 'email')->ignore($cliente->id)],
            'telefone'   => ['nullable', 'string', 'min:10', 'max:20', 'regex:/^[\+\d\s\(\)\-]+$/'],
            'nascimento' => ['nullable', 'date'],
            'foto'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'email.required' => 'O email é obrigatório.',
            'email.email'    => 'Digite um email válido.',
            'email.unique'   => 'Este email já está em uso.',
            'foto.image' => 'O arquivo deve ser uma imagem.',
            'foto.mimes' => 'Formatos aceitos: jpg, jpeg, png, webp.',
            'foto.max'   => 'A imagem deve ter no máximo 2MB.',
        ]);

        $data = [
            'name'       => $request->name,
            'email'      => $request->email,
            'telefone'   => $request->telefone,
            'nascimento' => $request->nascimento ?: null,
        ];

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('fotos', 'public');
            $data['foto'] = $path;
        }

        $cliente->update($data);

        return back()->with('success', 'Informações salvas com sucesso!');
    }

    public function updateEndereco(Request $request)
    {
        $cliente = Auth::guard('cliente')->user();

        $request->validate([
            'cep'             => ['nullable', 'string', 'max:9'],
            'rua'             => ['nullable', 'string', 'max:255'],
            'bairro'          => ['nullable', 'string', 'max:100'],
            'cidade'          => ['nullable', 'string', 'max:100'],
            'estado'          => ['nullable', 'string', 'size:2'],
            'numero'          => ['nullable', 'string', 'max:20'],
            'complemento'     => ['nullable', 'string', 'max:100'],
            'ponto_referencia' => ['nullable', 'string', 'max:255'],
        ]);

        $cliente->update([
            'cep'             => $request->cep,
            'rua'             => $request->rua,
            'bairro'          => $request->bairro,
            'cidade'          => $request->cidade,
            'estado'          => $request->estado,
            'numero'          => $request->numero,
            'complemento'     => $request->complemento,
            'ponto_referencia' => $request->ponto_referencia,
            'endereco'        => collect([$request->rua, $request->numero, $request->bairro, $request->cidade])->filter()->implode(', '),
        ]);

        return back()->with('success_endereco', 'Endereço salvo com sucesso!');
    }

    public function logout(Request $request)
    {
        Auth::guard('cliente')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login-cliente');
    }
}
