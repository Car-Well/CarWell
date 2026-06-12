<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdmUserController extends Controller
{
    public function index(Request $request)
    {
        $query = Cliente::query()->orderByDesc('id');

        if ($request->filled('q')) {
            $q = trim((string) $request->get('q'));
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', '%' . $q . '%')
                    ->orWhere('email', 'like', '%' . $q . '%')
                    ->orWhere('perfil', 'like', '%' . $q . '%');
            });
        }

        if ($request->filled('perfil') && $request->get('perfil') !== 'all') {
            $query->where('perfil', $request->get('perfil'));
        }

        $usuarios = $query->get();

        $kpis = [
            'total' => (int) Cliente::count(),
            'admin' => (int) Cliente::where('perfil', 'admin')->count(),
            'cliente' => (int) Cliente::where('perfil', 'cliente')->count(),
            'inativo' => (int) Cliente::where('perfil', 'inativo')->count(),
        ];

        return view('adm.admGerUser', compact('usuarios', 'kpis'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'foto'             => ['nullable', 'image', 'max:2048'],
            'nome'             => ['required', 'string', 'max:255'],
            'email'            => ['required', 'email', 'max:255', 'unique:clientes,email'],
            'telefone'         => ['nullable', 'string', 'max:20'],
            'senha'            => ['required', 'string', 'min:6', 'confirmed'],
            'nascimento'       => ['nullable', 'date'],
            'perfil'           => ['required', 'in:cliente,admin,inativo'],
            'cep'              => ['nullable', 'string', 'max:9'],
            'rua'              => ['nullable', 'string', 'max:255'],
            'numero'           => ['nullable', 'string', 'max:20'],
            'bairro'           => ['nullable', 'string', 'max:100'],
            'cidade'           => ['nullable', 'string', 'max:100'],
            'estado'           => ['nullable', 'string', 'max:2'],
            'complemento'      => ['nullable', 'string', 'max:100'],
            'ponto_referencia' => ['nullable', 'string', 'max:255'],
        ]);

        $cliente = new Cliente();
        $cliente->name           = $data['nome'];
        $cliente->email          = $data['email'];
        $cliente->telefone       = $data['telefone'] ?? null;
        $cliente->password       = Hash::make($data['senha']);
        $cliente->nascimento     = $data['nascimento'] ?? null;
        $cliente->perfil         = $data['perfil'] ?? 'cliente';
        $cliente->cep            = $data['cep'] ?? null;
        $cliente->rua            = $data['rua'] ?? null;
        $cliente->numero         = $data['numero'] ?? null;
        $cliente->bairro         = $data['bairro'] ?? null;
        $cliente->cidade         = $data['cidade'] ?? null;
        $cliente->estado         = $data['estado'] ?? null;
        $cliente->complemento    = $data['complemento'] ?? null;
        $cliente->ponto_referencia = $data['ponto_referencia'] ?? null;
        $cliente->endereco       = collect([$data['rua'] ?? null, $data['numero'] ?? null, $data['bairro'] ?? null, $data['cidade'] ?? null])->filter()->implode(', ');

        if ($request->hasFile('foto')) {
            $cliente->foto = $request->file('foto')->store('clientes', 'public');
        }

        $cliente->save();

        return redirect()->route('adm.usuarios.index')->with('success', 'Usuário criado com sucesso.');
    }

    public function update(Request $request, Cliente $cliente)
    {
        $data = $request->validate([
            'foto'             => ['nullable', 'image', 'max:2048'],
            'nome'             => ['required', 'string', 'max:255'],
            'email'            => [
                'required',
                'email',
                'max:255',
                Rule::unique('clientes', 'email')->ignore($cliente->id),
            ],
            'telefone'         => ['nullable', 'string', 'max:20'],
            'senha'            => ['nullable', 'string', 'min:6', 'confirmed'],
            'nascimento'       => ['nullable', 'date'],
            'perfil'           => ['required', 'in:cliente,admin,inativo'],
            'cep'              => ['nullable', 'string', 'max:9'],
            'rua'              => ['nullable', 'string', 'max:255'],
            'numero'           => ['nullable', 'string', 'max:20'],
            'bairro'           => ['nullable', 'string', 'max:100'],
            'cidade'           => ['nullable', 'string', 'max:100'],
            'estado'           => ['nullable', 'string', 'max:2'],
            'complemento'      => ['nullable', 'string', 'max:100'],
            'ponto_referencia' => ['nullable', 'string', 'max:255'],
        ]);

        $cliente->name           = $data['nome'];
        $cliente->email          = $data['email'];
        $cliente->telefone       = $data['telefone'] ?? null;
        $cliente->nascimento     = $data['nascimento'] ?? null;
        $cliente->perfil         = $data['perfil'];
        $cliente->cep            = $data['cep'] ?? null;
        $cliente->rua            = $data['rua'] ?? null;
        $cliente->numero         = $data['numero'] ?? null;
        $cliente->bairro         = $data['bairro'] ?? null;
        $cliente->cidade         = $data['cidade'] ?? null;
        $cliente->estado         = $data['estado'] ?? null;
        $cliente->complemento    = $data['complemento'] ?? null;
        $cliente->ponto_referencia = $data['ponto_referencia'] ?? null;
        $cliente->endereco       = collect([$data['rua'] ?? null, $data['numero'] ?? null, $data['bairro'] ?? null, $data['cidade'] ?? null])->filter()->implode(', ');

        if (!empty($data['senha'])) {
            $cliente->password = Hash::make($data['senha']);
        }

        if ($request->hasFile('foto')) {
            if ($cliente->foto) {
                Storage::disk('public')->delete($cliente->foto);
            }
            $cliente->foto = $request->file('foto')->store('clientes', 'public');
        }

        $cliente->save();

        return redirect()->route('adm.usuarios.index')->with('success', 'Usuário atualizado com sucesso.');
    }

    public function destroy(Cliente $cliente)
    {
        if ($cliente->foto) {
            Storage::disk('public')->delete($cliente->foto);
        }

        $cliente->delete();

        return redirect()->route('adm.usuarios.index')->with('success', 'Usuário excluído com sucesso.');
    }
}

