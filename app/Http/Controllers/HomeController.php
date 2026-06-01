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

        $marcas = MarcaCarros::whereNotNull('logo')->orderBy('nome')->get();

        return view('home', compact('carros', 'marcas'));
    }
}
