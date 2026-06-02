<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use App\Models\MarcaCarros;

class HomeController extends Controller
{
    public function index()
    {
        $carros = Carro::with('capa')
            ->where('status', 'disponivel')
            ->latest()
            ->get();

        $marcas      = MarcaCarros::whereNotNull('logo')->orderBy('nome')->get();
        $destacados  = Carro::with('capa')->where('destacado', true)->where('status', '!=', 'vendido')->latest()->get();

        return view('cliente.home', compact('carros', 'marcas', 'destacados'));
    }
}
