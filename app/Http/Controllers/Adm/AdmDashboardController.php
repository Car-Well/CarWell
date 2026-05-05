<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Carro;
use App\Models\Pedido;
use App\Models\Cliente;
use Carbon\Carbon;

class AdmDashboardController extends Controller
{
    public function index()
    {
        $lucroTotal     = (float)  Pedido::whereIn('status', ['entregue', 'finalizado'])->sum('valor');
        $carrosVendidos = (int)    Pedido::whereIn('status', ['entregue', 'finalizado'])->count();
        $clientesAtivos = (int)    Cliente::whereNotNull('email_verified_at')->count();
        $estoqueAtual   = (int)    Carro::where('status', 'disponivel')->count();
        $pedidosAtivos  = (int)    Pedido::whereNotIn('status', ['finalizado'])->count();
        $ticketMedio    = $carrosVendidos > 0 ? $lucroTotal / $carrosVendidos : 0;

        $kpis = compact(
            'lucroTotal', 'carrosVendidos', 'clientesAtivos',
            'estoqueAtual', 'pedidosAtivos', 'ticketMedio'
        );

        $receitaRaw = Pedido::whereIn('status', ['entregue', 'finalizado'])
            ->where('created_at', '>=', now()->subMonths(12))
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as mes, SUM(valor) as total")
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('total', 'mes');

        $receitaLabels = collect();
        $receitaData   = collect();
        for ($i = 11; $i >= 0; $i--) {
            $key = now()->subMonths($i)->format('Y-m');
            $receitaLabels->push(Carbon::parse($key . '-01')->translatedFormat('M/y'));
            $receitaData->push((float) ($receitaRaw[$key] ?? 0));
        }

        $vendasPorMarca = Carro::join('pedidos', 'carros.id', '=', 'pedidos.carro_id')
            ->whereIn('pedidos.status', ['entregue', 'finalizado'])
            ->selectRaw('carros.marca, COUNT(*) as total')
            ->groupBy('carros.marca')
            ->orderBy('total', 'desc')
            ->limit(8)
            ->get();

        $statusEstoque = [
            'Disponível' => (int) Carro::where('status', 'disponivel')->count(),
            'Reservado'  => (int) Carro::where('status', 'reservado')->count(),
            'Vendido'    => (int) Carro::where('status', 'vendido')->count(),
        ];

        $pagamentos = Pedido::selectRaw('pagamento, COUNT(*) as total')
            ->groupBy('pagamento')
            ->pluck('total', 'pagamento');

        $clientesSemanaLabels = collect();
        $clientesSemanaData   = collect();
        for ($i = 7; $i >= 0; $i--) {
            $inicio = now()->subWeeks($i)->startOfWeek();
            $fim    = now()->subWeeks($i)->endOfWeek();
            $clientesSemanaLabels->push('S' . (8 - $i));
            $clientesSemanaData->push(
                (int) Cliente::whereBetween('created_at', [$inicio, $fim])->count()
            );
        }

        $funil = [
            ['name' => 'Visitantes',   'value' => 1200],
            ['name' => 'Cadastrados',  'value' => (int) Cliente::count()],
            ['name' => 'Com pedido',   'value' => (int) Pedido::distinct('cliente_id')->count('cliente_id')],
            ['name' => 'Convertidos',  'value' => $carrosVendidos],
        ];

        $heatmapData = Pedido::whereIn('status', ['entregue', 'finalizado'])
            ->selectRaw('DAYOFWEEK(created_at) - 1 as dia, HOUR(created_at) as hora, COUNT(*) as total')
            ->groupBy('dia', 'hora')
            ->get()
            ->map(fn($r) => [$r->hora, $r->dia, $r->total]);

        $vendasRecentes = Pedido::with(['cliente', 'carro'])
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();
        
        $estoqueDestaques = Carro::whereIn('status', ['disponivel', 'reservado'])
            ->orderBy('preco', 'desc')
            ->limit(5)
            ->get();

        return view('adm.admDashboard', compact(
            'kpis',
            'receitaLabels', 'receitaData',
            'vendasPorMarca',
            'statusEstoque',
            'pagamentos',
            'clientesSemanaLabels', 'clientesSemanaData',
            'funil',
            'heatmapData',
            'vendasRecentes',
            'estoqueDestaques'
        ));
    }
}