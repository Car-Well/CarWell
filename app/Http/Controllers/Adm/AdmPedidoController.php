<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Carro;
use App\Models\Cliente;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdmPedidoController extends Controller
{
    public function index(Request $request)
    {
        $query = Pedido::query()->orderByDesc('id');

        if ($request->filled('q')) {
            $q = trim((string) $request->get('q'));
            $query->where(function ($sub) use ($q) {
                $sub->where('numero', 'like', '%' . $q . '%')
                    ->orWhere('cliente_nome', 'like', '%' . $q . '%')
                    ->orWhere('veiculo_nome', 'like', '%' . $q . '%');
            });
        }

        if ($request->filled('status') && $request->get('status') !== 'all') {
            $query->where('status', $request->get('status'));
        }

        $pedidos = $query->get();

        $kpis = [
            'total' => (int) Pedido::count(),
            'em_separacao' => (int) Pedido::where('status', 'em_separacao')->count(),
            'a_caminho' => (int) Pedido::where('status', 'a_caminho')->count(),
            'entregue' => (int) Pedido::where('status', 'entregue')->count(),
            'finalizado' => (int) Pedido::where('status', 'finalizado')->count(),
        ];

        return view('adm.admGerPed', compact('pedidos', 'kpis'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cliente' => ['required', 'string', 'max:255'],
            'veiculo' => ['required', 'string', 'max:255'],
            'valor' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:em_separacao,a_caminho,entregue,finalizado'],
            'pagamento' => ['required', 'in:credito,debito,pix,boleto'],

            // opcionais do cartão (não persistir dados sensíveis)
            'cartao_numero' => ['nullable', 'string', 'max:19'],
            'cartao_nome' => ['nullable', 'string', 'max:255'],
            'cartao_validade' => ['nullable', 'string', 'max:5'],
            'parcelas' => ['nullable', 'integer', 'min:1', 'max:24'],
        ]);

        $pedido = new Pedido();
        $pedido->numero = $this->proximoNumero();

        $pedido->cliente_nome = $data['cliente'];
        $pedido->veiculo_nome = $data['veiculo'];

        $cliente = Cliente::where('name', $data['cliente'])->orderByDesc('id')->first();
        $carro = Carro::whereRaw("TRIM(CONCAT(marca,' ',modelo)) = ?", [$data['veiculo']])->orderByDesc('id')->first();

        $pedido->cliente_id = $cliente?->id;
        $pedido->carro_id = $carro?->id;

        $pedido->valor = $data['valor'];
        $pedido->status = $data['status'];
        $pedido->pagamento = $data['pagamento'];

        if (!empty($data['cartao_numero'])) {
            $digits = preg_replace('/\D+/', '', (string) $data['cartao_numero']);
            if (is_string($digits) && strlen($digits) >= 4) {
                $pedido->cartao_ultimos4 = substr($digits, -4);
            }
        }

        $pedido->cartao_nome = $data['cartao_nome'] ?? null;
        $pedido->cartao_validade = $data['cartao_validade'] ?? null;
        $pedido->parcelas = $data['parcelas'] ?? null;

        $pedido->save();

        return redirect()->route('adm.pedidos.index')->with('success', 'Pedido criado com sucesso.');
    }

    public function update(Request $request, Pedido $pedido)
    {
        $data = $request->validate([
            'cliente' => ['required', 'string', 'max:255'],
            'veiculo' => ['required', 'string', 'max:255'],
            'valor' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:em_separacao,a_caminho,entregue,finalizado'],
            'pagamento' => ['required', 'in:credito,debito,pix,boleto'],
        ]);

        $pedido->cliente_nome = $data['cliente'];
        $pedido->veiculo_nome = $data['veiculo'];
        $pedido->valor = $data['valor'];
        $pedido->status = $data['status'];
        $pedido->pagamento = $data['pagamento'];

        $cliente = Cliente::where('name', $data['cliente'])->orderByDesc('id')->first();
        $carro = Carro::whereRaw("TRIM(CONCAT(marca,' ',modelo)) = ?", [$data['veiculo']])->orderByDesc('id')->first();

        $pedido->cliente_id = $cliente?->id;
        $pedido->carro_id = $carro?->id;

        $pedido->save();

        return redirect()->route('adm.pedidos.index')->with('success', 'Pedido atualizado com sucesso.');
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
        return redirect()->route('adm.pedidos.index')->with('success', 'Pedido excluído com sucesso.');
    }

    private function proximoNumero(): string
    {
        $ultimo = Pedido::query()->orderByDesc('id')->value('numero');
        $n = 0;

        if (is_string($ultimo)) {
            $digits = preg_replace('/\D+/', '', $ultimo);
            if (is_string($digits) && $digits !== '') {
                $n = (int) $digits;
            }
        }

        $n++;
        return '#' . str_pad((string) $n, 4, '0', STR_PAD_LEFT);
    }
}

