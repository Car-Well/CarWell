<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}"/>
      <title>CarWell — {{ __('adm.dashboard') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/adm/admHome.css') }}">
</head>
<body>

<nav class="main-nav">
    <div class="nav-left">
        <img src="{{ asset('img/logo.png') }}" alt="logo" class="nav-logo">
    </div>
    <div class="nav-center">
        <div class="nav-links">
            <a href="{{ route('adm.dashboard') }}" class="nav-active nav-hover-btn">{{ __('adm.dashboard') }}</a>
            <a href="{{ route('adm.carros.index') }}" class="nav-hover-btn">{{ __('adm.carros') }}</a>
            <a href="{{ route('adm.pedidos.index') }}" class="nav-hover-btn">{{ __('adm.pedidos') }}</a>
            <a href="{{ route('adm.usuarios.index') }}" class="nav-hover-btn">{{ __('adm.clientes') }}</a>
        </div>
    </div>
    <div class="nav-right">
        <form action="{{ route('adm.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout nav-hover-btn">{{ __('adm.sair') }}</button>
        </form>
    </div>
</nav>

<main class="main">

    <div class="page-header">
        <div>
            <h1 class="page-title">{{ __('adm.dash_titulo') }}</h1>
            <p class="page-subtitle">{{ __('adm.dash_subtitulo') }}</p>
        </div>
        <span class="last-update">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            {{ __('adm.dash_atualizado') }}
        </span>
    </div>

    <div class="kpi-grid">
        <div class="kpi-card kpi-card--accent">
            <div class="kpi-icon kpi-icon--green">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            </div>
            <div class="kpi-body">
                <div class="kpi-label">{{ __('adm.dash_lucro') }}</div>
                <div class="kpi-value">R$ {{ number_format($kpis['lucroTotal'], 0, ',', '.') }}</div>
                <div class="kpi-trend up">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="18 15 12 9 6 15"/></svg>
                    {{ __('adm.dash_lucro_sub') }}
                </div>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon kpi-icon--blue">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99z"/></svg>
            </div>
            <div class="kpi-body">
                <div class="kpi-label">{{ __('adm.dash_vendidos') }}</div>
                <div class="kpi-value">{{ $kpis['carrosVendidos'] }}</div>
                <div class="kpi-trend up">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="18 15 12 9 6 15"/></svg>
                    {{ __('adm.dash_vendidos_sub') }}
                </div>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon kpi-icon--purple">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <div class="kpi-body">
                <div class="kpi-label">{{ __('adm.dash_clientes') }}</div>
                <div class="kpi-value">{{ $kpis['clientesAtivos'] }}</div>
                <div class="kpi-trend up">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="18 15 12 9 6 15"/></svg>
                    {{ __('adm.dash_clientes_sub') }}
                </div>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon kpi-icon--amber">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
            </div>
            <div class="kpi-body">
                <div class="kpi-label">{{ __('adm.dash_estoque') }}</div>
                <div class="kpi-value">{{ $kpis['estoqueAtual'] }}</div>
                <div class="kpi-trend down">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="18 9 12 15 6 9"/></svg>
                    {{ __('adm.dash_estoque_sub') }}
                </div>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon kpi-icon--red">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
            </div>
            <div class="kpi-body">
                <div class="kpi-label">{{ __('adm.dash_ativos') }}</div>
                <div class="kpi-value">{{ $kpis['pedidosAtivos'] }}</div>
                <div class="kpi-trend up">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="18 15 12 9 6 15"/></svg>
                    {{ __('adm.dash_ativos_sub') }}
                </div>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon kpi-icon--teal">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
            </div>
            <div class="kpi-body">
                <div class="kpi-label">{{ __('adm.dash_ticket') }}</div>
                <div class="kpi-value">R$ {{ number_format($kpis['ticketMedio'], 0, ',', '.') }}</div>
                <div class="kpi-trend up">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="18 15 12 9 6 15"/></svg>
                    {{ __('adm.dash_ticket_sub') }}
                </div>
            </div>
        </div>
    </div>

    <div class="charts-row">
        <div class="panel panel--lg">
            <div class="panel-head">
                <div>
                    <div class="panel-title">{{ __('adm.dash_receita') }}</div>
                    <div class="panel-subtitle">{{ __('adm.dash_receita_sub') }}</div>
                </div>
            </div>
            <div class="panel-body">
                <div id="chart-receita" class="chart-container" style="height:280px;"></div>
            </div>
        </div>
        <div class="panel">
            <div class="panel-head">
                <div>
                    <div class="panel-title">{{ __('adm.dash_vendas_marca') }}</div>
                    <div class="panel-subtitle">{{ __('adm.dash_vendas_marca_sub') }}</div>
                </div>
            </div>
            <div class="panel-body">
                <div id="chart-marcas" class="chart-container" style="height:280px;"></div>
            </div>
        </div>
    </div>

    <div class="charts-row">
        <div class="panel">
            <div class="panel-head">
                <div>
                    <div class="panel-title">{{ __('adm.dash_status_est') }}</div>
                    <div class="panel-subtitle">{{ __('adm.dash_status_est_sub') }}</div>
                </div>
            </div>
            <div class="panel-body">
                <div id="chart-estoque" class="chart-container" style="height:260px;"></div>
            </div>
        </div>
        <div class="panel">
            <div class="panel-head">
                <div>
                    <div class="panel-title">{{ __('adm.dash_pagamentos') }}</div>
                    <div class="panel-subtitle">{{ __('adm.dash_pagamentos_sub') }}</div>
                </div>
            </div>
            <div class="panel-body">
                <div id="chart-pagamento" class="chart-container" style="height:260px;"></div>
            </div>
        </div>
        <div class="panel">
            <div class="panel-head">
                <div>
                    <div class="panel-title">{{ __('adm.dash_novos_cli') }}</div>
                    <div class="panel-subtitle">{{ __('adm.dash_novos_cli_sub') }}</div>
                </div>
            </div>
            <div class="panel-body">
                <div id="chart-clientes" class="chart-container" style="height:260px;"></div>
            </div>
        </div>
    </div>

    <div class="charts-row">
        <div class="panel panel--lg">
            <div class="panel-head">
                <div>
                    <div class="panel-title">{{ __('adm.dash_atividade') }}</div>
                    <div class="panel-subtitle">{{ __('adm.dash_atividade_sub') }}</div>
                </div>
            </div>
            <div class="panel-body">
                <div id="chart-heatmap" class="chart-container" style="height:220px;"></div>
            </div>
        </div>
        <div class="panel">
            <div class="panel-head">
                <div>
                    <div class="panel-title">{{ __('adm.dash_funil') }}</div>
                    <div class="panel-subtitle">{{ __('adm.dash_funil_sub') }}</div>
                </div>
            </div>
            <div class="panel-body">
                <div id="chart-funil" class="chart-container" style="height:220px;"></div>
            </div>
        </div>
    </div>

    <div class="tables-row">
        <div class="panel">
            <div class="panel-head">
                <div class="panel-title">{{ __('adm.dash_recentes') }}</div>
                <a href="{{ route('adm.pedidos.index') }}" class="panel-action">{{ __('adm.dash_ver_tudo') }}</a>
            </div>
            <div class="panel-body" style="padding:0;">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>{{ __('adm.dash_veiculo') }}</th>
                            <th>{{ __('adm.dash_cliente') }}</th>
                            <th>{{ __('adm.dash_valor') }}</th>
                            <th>{{ __('adm.dash_status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $stClass = ['entregue'=>'badge-green','a_caminho'=>'badge-amber','finalizado'=>'badge-gray','em_separacao'=>'badge-blue'];
                            $stLabel = ['entregue'=>__('adm.status_entregue'),'a_caminho'=>__('adm.status_a_caminho'),'finalizado'=>__('adm.status_finalizado'),'em_separacao'=>__('adm.status_em_separacao')];
                        @endphp
                        @forelse($vendasRecentes as $venda)
                        @php
                            $nomeCliente = $venda->cliente->name ?? '—';
                            $parts = preg_split('/\s+/', trim($nomeCliente));
                            $initials = strtoupper(substr($parts[0] ?? '', 0, 1) . substr($parts[1] ?? '', 0, 1));
                        @endphp
                        <tr>
                            <td class="td-veiculo">{{ $venda->carro->marca ?? '' }} {{ $venda->carro->modelo ?? '—' }}</td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-initials">{{ $initials ?: '—' }}</div>
                                    <span>{{ $nomeCliente }}</span>
                                </div>
                            </td>
                            <td class="text-bold">R$ {{ number_format((float)$venda->valor, 2, ',', '.') }}</td>
                            <td><span class="badge {{ $stClass[$venda->status] ?? 'badge-gray' }}">{{ $stLabel[$venda->status] ?? $venda->status }}</span></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align:center; color:#9EA19C; padding:2rem;">{{ __('adm.dash_nenhuma_venda') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel">
            <div class="panel-head">
                <div class="panel-title">{{ __('adm.dash_estoque_dest') }}</div>
                <a href="{{ route('adm.carros.index') }}" class="panel-action">{{ __('adm.dash_gerenciar') }}</a>
            </div>
            <div class="panel-body" style="padding:0;">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>{{ __('adm.dash_veiculo') }}</th>
                            <th>{{ __('adm.dash_ano') }}</th>
                            <th>{{ __('adm.dash_valor') }}</th>
                            <th>{{ __('adm.dash_status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $esClass = ['disponivel'=>'badge-green','reservado'=>'badge-amber'];
                            $esLabel = ['disponivel'=>__('adm.dash_disponivel'),'reservado'=>__('adm.dash_reservado')];
                        @endphp
                        @forelse($estoqueDestaques as $carro)
                        <tr>
                            <td class="td-veiculo">{{ $carro->marca }} {{ $carro->modelo }}</td>
                            <td class="text-muted">{{ $carro->ano }}</td>
                            <td class="text-bold">R$ {{ number_format((float)$carro->preco, 0, ',', '.') }}</td>
                            <td><span class="badge {{ $esClass[$carro->status] ?? 'badge-gray' }}">{{ $esLabel[$carro->status] ?? $carro->status }}</span></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align:center; color:#9EA19C; padding:2rem;">{{ __('adm.dash_nenhum_carro') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</main>

<script>
    const receitaLabels = @json($receitaLabels);
    const receitaData = @json($receitaData);
    const marcasLabels = @json($vendasPorMarca->pluck('marca')->values());
    const marcasData = @json($vendasPorMarca->pluck('total')->values());
    const statusEstoque = @json($statusEstoque);
    const pagamentos = @json($pagamentos);
    const clientesLabels = @json($clientesSemanaLabels);
    const clientesData = @json($clientesSemanaData);
    const funilData = @json($funil);
    const heatmapData = @json($heatmapData);
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.4.3/echarts.min.js"></script>
<script>
    const GREEN = '#1D9E75';
    const GREEN_LIGHT = '#5DCAA5';
    const GREEN_DARK = '#0F6E56';
    const BLUE = '#3B82F6';
    const AMBER = '#F59E0B';
    const RED = '#EF4444';
    const PURPLE = '#8B5CF6';
    const TEAL = '#14B8A6';
    const MUTED = '#9EA19C';
    const TEXT = '#1A1C19';
    const BG = '#F4F5F3';

    const tooltip = {
        backgroundColor: '#fff',
        borderColor: 'rgba(0,0,0,0.08)',
        borderWidth: 1,
        textStyle: { color: TEXT, fontFamily: 'DM Sans', fontSize: 12 },
        extraCssText: 'box-shadow:0 4px 16px rgba(0,0,0,0.10);border-radius:10px;padding:10px 14px;'
    };

    const chartReceita = echarts.init(document.getElementById('chart-receita'));
    chartReceita.setOption({
        tooltip: { ...tooltip, trigger: 'axis' },
        grid: { left: 56, right: 16, top: 16, bottom: 32 },
        xAxis: {
            type: 'category',
            data: receitaLabels,
            axisLine: { lineStyle: { color: 'rgba(0,0,0,0.08)' } },
            axisTick: { show: false },
            axisLabel: { color: MUTED, fontFamily: 'DM Sans', fontSize: 11 }
        },
        yAxis: {
            type: 'value',
            axisLabel: { color: MUTED, fontFamily: 'DM Sans', fontSize: 11, formatter: v => 'R$' + (v >= 1000 ? (v/1000).toFixed(0) + 'k' : v) },
            splitLine: { lineStyle: { color: 'rgba(0,0,0,0.05)' } }
        },
        series: [{
            name: 'Receita',
            type: 'line',
            smooth: true,
            data: receitaData,
            lineStyle: { color: GREEN, width: 2.5 },
            itemStyle: { color: GREEN },
            symbol: 'circle',
            symbolSize: 6,
            areaStyle: {
                color: { type: 'linear', x: 0, y: 0, x2: 0, y2: 1,
                    colorStops: [
                        { offset: 0, color: 'rgba(29,158,117,0.18)' },
                        { offset: 1, color: 'rgba(29,158,117,0)' }
                    ]
                }
            }
        }]
    });

    const chartMarcas = echarts.init(document.getElementById('chart-marcas'));
    const barColors = [MUTED,'#94A3B8',AMBER,RED,BLUE,TEAL,GREEN_LIGHT,GREEN];
    chartMarcas.setOption({
        tooltip: { ...tooltip, trigger: 'axis', axisPointer: { type: 'none' } },
        grid: { left: 80, right: 30, top: 10, bottom: 10 },
        xAxis: { type: 'value', axisLabel: { show: false }, splitLine: { lineStyle: { color: 'rgba(0,0,0,0.05)' } } },
        yAxis: {
            type: 'category',
            data: marcasLabels,
            axisLine: { show: false },
            axisTick: { show: false },
            axisLabel: { color: TEXT, fontFamily: 'DM Sans', fontSize: 12 }
        },
        series: [{
            type: 'bar',
            data: marcasData,
            barMaxWidth: 18,
            itemStyle: {
                borderRadius: [0, 6, 6, 0],
                color: params => barColors[params.dataIndex % barColors.length]
            },
            label: { show: true, position: 'right', color: MUTED, fontFamily: 'DM Sans', fontSize: 11 }
        }]
    });

    const chartEstoque = echarts.init(document.getElementById('chart-estoque'));
    const estoqueColors = { 'Disponível': GREEN, 'Reservado': AMBER, 'Vendido': RED };
    chartEstoque.setOption({
        tooltip: { ...tooltip, trigger: 'item' },
        legend: { bottom: 0, left: 'center', textStyle: { color: TEXT, fontFamily: 'DM Sans', fontSize: 11 }, itemWidth: 10, itemHeight: 10, icon: 'circle' },
        series: [{
            type: 'pie',
            radius: ['48%', '72%'],
            center: ['50%', '44%'],
            avoidLabelOverlap: false,
            label: { show: false },
            emphasis: { label: { show: true, fontSize: 14, fontWeight: 700, fontFamily: 'Syne' } },
            data: Object.entries(statusEstoque).map(([name, value]) => ({
                name, value, itemStyle: { color: estoqueColors[name] || MUTED }
            }))
        }]
    });

    const chartPagamento = echarts.init(document.getElementById('chart-pagamento'));
    const pagColors = { credito: BLUE, pix: GREEN, debito: TEAL, boleto: AMBER };
    const pagNomes  = { credito: 'Crédito', pix: 'PIX', debito: 'Débito', boleto: 'Boleto' };
    chartPagamento.setOption({
        tooltip: { ...tooltip, trigger: 'item' },
        legend: { bottom: 0, left: 'center', textStyle: { color: TEXT, fontFamily: 'DM Sans', fontSize: 11 }, itemWidth: 10, itemHeight: 10, icon: 'circle' },
        series: [{
            type: 'pie',
            radius: ['48%', '72%'],
            center: ['50%', '44%'],
            avoidLabelOverlap: false,
            label: { show: false },
            emphasis: { label: { show: true, fontSize: 14, fontWeight: 700, fontFamily: 'Syne' } },
            data: Object.entries(pagamentos).map(([key, value]) => ({
                name: pagNomes[key] || key,
                value,
                itemStyle: { color: pagColors[key] || MUTED }
            }))
        }]
    });

    const chartClientes = echarts.init(document.getElementById('chart-clientes'));
    chartClientes.setOption({
        tooltip: { ...tooltip, trigger: 'axis' },
        grid: { left: 30, right: 10, top: 10, bottom: 30 },
        xAxis: {
            type: 'category',
            data: clientesLabels,
            axisLine: { lineStyle: { color: 'rgba(0,0,0,0.08)' } },
            axisTick: { show: false },
            axisLabel: { color: MUTED, fontFamily: 'DM Sans', fontSize: 11 }
        },
        yAxis: {
            type: 'value',
            axisLabel: { color: MUTED, fontFamily: 'DM Sans', fontSize: 11 },
            splitLine: { lineStyle: { color: 'rgba(0,0,0,0.05)' } }
        },
        series: [{
            type: 'bar',
            data: clientesData,
            barMaxWidth: 22,
            itemStyle: {
                borderRadius: [6,6,0,0],
                color: { type: 'linear', x: 0, y: 0, x2: 0, y2: 1,
                    colorStops: [{ offset: 0, color: GREEN }, { offset: 1, color: GREEN_LIGHT }]
                }
            }
        }]
    });

    const days  = ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb'];
    const hours = ['8h','9h','10h','11h','12h','13h','14h','15h','16h','17h','18h','19h','20h'];
    const chartHeatmap = echarts.init(document.getElementById('chart-heatmap'));
    chartHeatmap.setOption({
        tooltip: { ...tooltip, formatter: p => `${days[p.data[1]]} às ${hours[p.data[0]]}<br><b>${p.data[2]} pedidos</b>` },
        grid: { left: 40, right: 60, top: 10, bottom: 30 },
        xAxis: { type: 'category', data: hours, axisLine: { show: false }, axisTick: { show: false }, axisLabel: { color: MUTED, fontFamily: 'DM Sans', fontSize: 11 } },
        yAxis: { type: 'category', data: days, axisLine: { show: false }, axisTick: { show: false }, axisLabel: { color: MUTED, fontFamily: 'DM Sans', fontSize: 11 } },
        visualMap: { min: 0, max: 20, calculable: false, orient: 'vertical', right: 0, top: 'center', inRange: { color: ['#E1F5EE', GREEN_LIGHT, GREEN, GREEN_DARK] }, textStyle: { color: MUTED, fontSize: 10, fontFamily: 'DM Sans' } },
        series: [{ type: 'heatmap', data: heatmapData, itemStyle: { borderRadius: 4, borderWidth: 2, borderColor: BG } }]
    });

    const chartFunil = echarts.init(document.getElementById('chart-funil'));
    const funilColors = [BLUE, PURPLE, TEAL, GREEN];
    chartFunil.setOption({
        tooltip: { ...tooltip, trigger: 'item' },
        series: [{
            type: 'funnel',
            left: '5%', width: '90%',
            top: 10, bottom: 10,
            sort: 'descending',
            gap: 4,
            label: { show: true, position: 'inside', formatter: '{b}\n{c}', color: '#fff', fontFamily: 'DM Sans', fontSize: 12, fontWeight: 600 },
            itemStyle: { borderWidth: 0 },
            data: funilData.map((item, i) => ({ ...item, itemStyle: { color: funilColors[i % funilColors.length] } }))
        }]
    });

    window.addEventListener('resize', () => {
        [chartReceita, chartMarcas, chartEstoque, chartPagamento, chartClientes, chartHeatmap, chartFunil]
            .forEach(c => c.resize());
    });
</script>

</body>
</html>