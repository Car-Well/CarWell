<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Carro;
use Illuminate\Http\Request;

class AdmPedidoController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.autenticado');
    }

    public function index(Request $request)
    {
        $query = Pedido::with(['cliente', 'carro'])->orderBy('id', 'desc');

        if ($request->filled('q')) {
            $q = trim($request->get('q'));
            $query->where(function ($sub) use ($q) {
                $sub->whereHas('cliente', fn($u) => $u->where('name', 'like', '%' . $q . '%'))
                    ->orWhereHas('carro', fn($c) =>
                        $c->where('marca', 'like', '%' . $q . '%')
                          ->orWhere('modelo', 'like', '%' . $q . '%')
                    );
            });
        }

        if ($request->filled('status') && $request->get('status') !== 'all') {
            $query->where('status', $request->get('status'));
        }

        $pedidos = $query->get();

        $kpis = [
            'total'        => (int) Pedido::count(),
            'em_separacao' => (int) Pedido::where('status', 'em_separacao')->count(),
            'a_caminho'    => (int) Pedido::where('status', 'a_caminho')->count(),
            'entregue'     => (int) Pedido::where('status', 'entregue')->count(),
        ];

        $clientes = Cliente::whereNotNull('email_verified_at')->orderBy('name')->get();
        $carros   = Carro::where('status', 'disponivel')->orderBy('marca')->get();

        return view('adm.admGerPed', compact('pedidos', 'kpis', 'clientes', 'carros'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cliente_id'      => ['required', 'exists:clientes,id'],
            'carro_id'        => ['required', 'exists:carros,id'],
            'status'          => ['required', 'in:em_separacao,a_caminho,entregue,finalizado'],
            'pagamento'       => ['required', 'in:credito,debito,pix,boleto'],
            'valor'           => ['required', 'numeric', 'min:0'],
            'cartao_nome'     => ['nullable', 'string', 'max:255'],
            'cartao_ultimos4' => ['nullable', 'digits:4'],
            'parcelas'        => ['nullable', 'integer', 'min:1', 'max:12'],
        ]);

        Pedido::create($data);

        Carro::find($data['carro_id'])?->update(['status' => 'reservado']);

        return redirect()->route('adm.pedidos.index')->with('success', 'Pedido criado com sucesso.');
    }

    public function update(Request $request, Pedido $pedido)
    {
        $data = $request->validate([
            'cliente_id' => ['required', 'exists:clientes,id'],
            'carro_id'   => ['required', 'exists:carros,id'],
            'status'     => ['required', 'in:em_separacao,a_caminho,entregue,finalizado'],
            'pagamento'  => ['required', 'in:credito,debito,pix,boleto'],
            'valor'      => ['required', 'numeric', 'min:0'],
        ]);

        $pedido->update($data);

        if ($data['status'] === 'finalizado') {
            $pedido->carro?->update(['status' => 'vendido']);
        }

        return redirect()->route('adm.pedidos.index')->with('success', 'Pedido atualizado com sucesso.');
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->delete();

        return redirect()->route('adm.pedidos.index')->with('success', 'Pedido excluído com sucesso.');
    }
}