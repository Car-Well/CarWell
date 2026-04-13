<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'name'     => ['nullable', 'string', 'max:100'],
            'telefone' => ['nullable', 'string', 'min:10', 'max:20', 'regex:/^[\+\d\s\(\)\-]+$/'],
            'endereco' => ['nullable', 'string', 'max:255'],
            'foto'     => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'foto.image' => 'O arquivo deve ser uma imagem.',
            'foto.mimes' => 'Formatos aceitos: jpg, jpeg, png, webp.',
            'foto.max'   => 'A imagem deve ter no máximo 2MB.',
        ]);

        $data = [
            'name'     => $request->name,
            'telefone' => $request->telefone,
            'endereco' => $request->endereco,
        ];

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('fotos', 'public');
            $data['foto'] = $path;
        }

        $cliente->update($data);

        return back()->with('success', 'Informações salvas com sucesso!');
    }

    public function logout(Request $request)
    {
        Auth::guard('cliente')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login-cliente');
    }
}
