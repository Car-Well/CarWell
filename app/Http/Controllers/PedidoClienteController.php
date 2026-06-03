<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoClienteController extends Controller
{
    public function index()
    {
        $cliente = Auth::guard('cliente')->user();
        $pedidos = Pedido::with('carro.capa')
            ->where('cliente_id', $cliente->id)
            ->latest()
            ->get();

        return view('cliente.meus-pedidos', compact('pedidos'));
    }

    public function store(Request $request)
    {
        $cliente   = Auth::guard('cliente')->user();
        $carroIds  = $request->input('carros', []);
        $pagamento = $request->input('pagamento', 'credito');

        $ultimoPedido = null;

        foreach ($carroIds as $carroId) {
            $carro = Carro::with('capa')->find((int) $carroId);
            if (!$carro) continue;

            $ultimoPedido = Pedido::create([
                'cliente_id' => $cliente->id,
                'carro_id'   => $carro->id,
                'status'     => 'em_separacao',
                'pagamento'  => $pagamento,
                'valor'      => $carro->preco,
            ]);

            $carro->update(['status' => 'reservado']);
        }

        if (!$ultimoPedido) {
            return redirect()->route('carrinho');
        }

        return redirect()->route('pedido.show', $ultimoPedido->id);
    }

    public function show(Pedido $pedido)
    {
        $cliente = Auth::guard('cliente')->user();

        if ($pedido->cliente_id !== $cliente->id) {
            abort(403);
        }

        $pedido->load('carro.capa');
        return view('cliente.pedido', compact('pedido'));
    }
}
