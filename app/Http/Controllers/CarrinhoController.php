<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public function index()
    {
        $ids    = session('carrinho', []);
        $carros = Carro::with('capa')->whereIn('id', $ids)->get()->keyBy('id');
        $total  = $carros->sum('preco');

        return view('cliente.carrinho', compact('carros', 'total'));
    }

    public function adicionar(Carro $carro)
    {
        $carrinho = session('carrinho', []);

        if (!in_array($carro->id, $carrinho)) {
            $carrinho[] = $carro->id;
            session(['carrinho' => $carrinho]);
        }

        return redirect()->route('carrinho')->with('success', 'Carro adicionado ao carrinho.');
    }

    public function remover(Carro $carro)
    {
        $carrinho = array_values(array_filter(
            session('carrinho', []),
            fn($id) => $id != $carro->id
        ));

        session(['carrinho' => $carrinho]);

        return redirect()->route('carrinho');
    }

    public function checkout()
    {
        $ids    = session('carrinho', []);
        $carros = Carro::with('capa')->whereIn('id', $ids)->get()->keyBy('id');
        $total  = $carros->sum('preco');

        if ($carros->isEmpty()) {
            return redirect()->route('carrinho');
        }

        return view('cliente.checkout', compact('carros', 'total'));
    }

    public function limpar()
    {
        session()->forget('carrinho');
        return redirect()->route('carrinho');
    }
}
