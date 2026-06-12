<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use App\Models\MarcaCarros;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $busca              = $request->query('busca');
        $marcaSelecionada   = $request->query('marca');
        $categoriaSelecionada = $request->query('categoria');

        $query = Carro::with('capa')->where('status', 'disponivel');

        if ($busca) {
            $query->where(function ($q) use ($busca) {
                $q->where('marca', 'like', "%{$busca}%")
                  ->orWhere('modelo', 'like', "%{$busca}%");
            });
        }

        if ($marcaSelecionada) {
            $query->where('marca', $marcaSelecionada);
        }

        if ($categoriaSelecionada) {
            $query->where('categoria', $categoriaSelecionada);
        }

        $carros     = $query->latest()->get();
        $marcas     = MarcaCarros::whereNotNull('logo')->orderBy('nome')->get();
        $destacados = Carro::with('capa')->where('destacado', true)->where('status', 'disponivel')->latest()->get();

        return view('cliente.home', compact('carros', 'marcas', 'destacados', 'busca', 'marcaSelecionada', 'categoriaSelecionada'));
    }
}
