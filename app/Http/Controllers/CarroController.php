<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use Illuminate\Http\Request;

class CarroController extends Controller
{
    public function porIds(Request $request)
    {
        $ids = array_values(array_filter(array_map('intval', (array) $request->get('ids', []))));

        if (empty($ids)) {
            return response()->json([]);
        }

        $carros = Carro::with('capa')->whereIn('id', $ids)->get();

        return response()->json($carros->map(fn($c) => [
            'id'          => $c->id,
            'nome'        => $c->veiculo_nome,
            'ano'         => $c->ano,
            'combustivel' => $c->combustivel,
            'cambio'      => $c->cambio,
            'preco'       => $c->preco,
            'capa_path'   => $c->capa_path,
            'url'         => route('carro.show', $c->id),
        ]));
    }

    public function show(Carro $carro)
    {
        $carro->load(['capa', 'fotos' => fn($q) => $q->orderBy('ordem')]);

        $relacionados = Carro::with('capa')
            ->where('status', 'disponivel')
            ->where('id', '!=', $carro->id)
            ->latest()
            ->take(6)
            ->get();

        return view('cliente.info_carro', compact('carro', 'relacionados'));
    }
}
