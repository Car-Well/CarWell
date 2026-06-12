<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Cliente;
use App\Services\GcsStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdmClienteController extends Controller
{
    public function __construct(){
        $this->middleware('admin.autenticado');
    }

    public function index(Request $request)
    {
        $query = Cliente::orderBy('id', 'desc');

        if ($request->filled('q')) {
            $q = trim($request->get('q'));
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', '%' . $q . '%')
                    ->orWhere('email', 'like', '%' . $q . '%');
            });
        }

        if ($request->filled('perfil') && $request->get('perfil') !== 'all') {
            $query->where('perfil', $request->get('perfil'));
        }

        $clientes = $query->get();

        $kpis = [
            'total'    => (int) Cliente::count(),
            'admin'    => (int) Cliente::where('perfil', 'admin')->count(),
            'cliente'  => (int) Cliente::where('perfil', 'cliente')->count(),
            'inativo'  => (int) Cliente::where('perfil', 'inativo')->count(),
        ];
        $q = (string) $request->get('q', '');
        $perfil = (string) $request->get('perfil', 'all');

        return view('adm.admGerUser', compact('clientes', 'kpis', 'q', 'perfil'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', 'unique:clientes,email'],
            'password'   => ['required', 'string', 'min:6', 'confirmed'],
            'telefone'   => ['nullable', 'string', 'max:20'],
            'nascimento' => ['nullable', 'date'],
            'endereco'   => ['nullable', 'string', 'max:255'],
            'perfil'     => ['required', 'in:admin,cliente,inativo'],
            'foto'       => ['nullable', 'image', 'max:2048'],
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['email_verified_at'] = now();

        if ($request->hasFile('foto')) {
            $data['foto'] = GcsStorage::store($request->file('foto'), 'clientes');
        }

        $cliente = Cliente::create($data);

        if (($data['perfil'] ?? '') === 'admin') {
            Admin::updateOrCreate(
                ['email' => $data['email']],
                ['name' => $data['name'], 'password' => $data['password']]
            );
        }

        return redirect()->route('adm.usuarios.index')->with('success', 'Usuário criado com sucesso.');
    }

    public function update(Request $request, Cliente $cliente)
    {
        $data = $request->validate([
            'name'            => ['required', 'string', 'max:255'],
            'email'           => ['required', 'email', 'unique:clientes,email,' . $cliente->id],
            'password'        => ['nullable', 'string', 'min:6', 'confirmed'],
            'telefone'        => ['nullable', 'string', 'max:20'],
            'nascimento'      => ['nullable', 'date'],
            'perfil'          => ['required', 'in:admin,cliente,inativo'],
            'foto'            => ['nullable', 'image', 'max:2048'],
            'cep'             => ['nullable', 'string', 'max:9'],
            'rua'             => ['nullable', 'string', 'max:255'],
            'numero'          => ['nullable', 'string', 'max:20'],
            'bairro'          => ['nullable', 'string', 'max:100'],
            'cidade'          => ['nullable', 'string', 'max:100'],
            'estado'          => ['nullable', 'string', 'size:2'],
            'complemento'     => ['nullable', 'string', 'max:100'],
            'ponto_referencia'=> ['nullable', 'string', 'max:255'],
        ]);

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        if ($request->hasFile('foto')) {
            GcsStorage::delete($cliente->foto);
            $data['foto'] = GcsStorage::store($request->file('foto'), 'clientes');
        }

        $cliente->update($data);

        if (($data['perfil'] ?? '') === 'admin') {
            Admin::updateOrCreate(
                ['email' => $cliente->email],
                ['name' => $cliente->name, 'password' => $cliente->password]
            );
        } else {
            Admin::where('email', $cliente->email)->delete();
        }

        return redirect()->route('adm.usuarios.index')->with('success', 'Usuário atualizado com sucesso.');
    }

    public function destroy(Cliente $cliente)
    {
        if ($cliente->foto) {
            GcsStorage::delete($cliente->foto);
        }

        $cliente->delete();

        return redirect()->route('adm.usuarios.index')->with('success', 'Usuário excluído com sucesso.');
    }
}