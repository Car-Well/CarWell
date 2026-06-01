<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarWell — Dashboard</title>
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
            <a href="{{ route('adm.dashboard') }}" class="nav-active nav-hover-btn">Dashboard</a>
            <a href="{{ route('adm.carros.index') }}" class="nav-hover-btn">Carros</a>
            <a href="{{ route('adm.pedidos.index') }}" class="nav-hover-btn">Pedidos</a>
            <a href="{{ route('adm.usuarios.index') }}" class="nav-hover-btn">Clientes</a>
        </div>
    </div>
    <div class="nav-right">
        <form action="{{ route('adm.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout nav-hover-btn">Sair</button>
        </form>
    </div>
</nav>

<main class="main">

    <div class="page-header">
        <div>
            <h1 class="page-title">Dashboard <span>Administrativo</span></h1>
            <p class="page-subtitle">Visão completa do desempenho da CarWell</p>
        </div>
        <span class="last-update">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            Atualizado agora
        </span>
    </div>

    <div class="kpi-grid">
        <div class="kpi-card kpi-card--accent">
            <div class="kpi-icon kpi-icon--green">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            </div>
            <div class="kpi-body">
                <div class="kpi-label">Lucro total</div>
                <div class="kpi-value">R$ {{ number_format($kpis['lucroTotal'], 0, ',', '.') }}</div>
                <div class="kpi-trend up">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="18 15 12 9 6 15"/></svg>
                    pedidos entregues + finalizados
                </div>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon kpi-icon--blue">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99z"/></svg>
            </div>
            <div class="kpi-body">
                <div class="kpi-label">Carros vendidos</div>
                <div class="kpi-value">{{ $kpis['carrosVendidos'] }}</div>
                <div class="kpi-trend up">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="18 15 12 9 6 15"/></svg>
                    pedidos concluídos
                </div>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon kpi-icon--purple">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <div class="kpi-body">
                <div class="kpi-label">Clientes ativos</div>
                <div class="kpi-value">{{ $kpis['clientesAtivos'] }}</div>
                <div class="kpi-trend up">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="18 15 12 9 6 15"/></svg>
                    e-mails verificados
                </div>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon kpi-icon--amber">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
            </div>
            <div class="kpi-body">
                <div class="kpi-label">Estoque atual</div>
                <div class="kpi-value">{{ $kpis['estoqueAtual'] }}</div>
                <div class="kpi-trend down">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="18 9 12 15 6 9"/></svg>
                    carros disponíveis
                </div>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon kpi-icon--red">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
            </div>
            <div class="kpi-body">
                <div class="kpi-label">Pedidos ativos</div>
                <div class="kpi-value">{{ $kpis['pedidosAtivos'] }}</div>
                <div class="kpi-trend up">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="18 15 12 9 6 15"/></svg>
                    em andamento
                </div>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon kpi-icon--teal">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
            </div>
            <div class="kpi-body">
                <div class="kpi-label">Ticket médio</div>
                <div class="kpi-value">R$ {{ number_format($kpis['ticketMedio'], 0, ',', '.') }}</div>
                <div class="kpi-trend up">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="18 15 12 9 6 15"/></svg>
                    por venda
                </div>
            </div>
        </div>
    </div>

    <div class="charts-row">
        <div class="panel panel--lg">
            <div class="panel-head">
                <div>
                    <div class="panel-title">Receita mensal</div>
                    <div class="panel-subtitle">Últimos 12 meses</div>
                </div>
            </div>
            <div class="panel-body">
                <div id="chart-receita" class="chart-container" style="height:280px;"></div>
            </div>
        </div>
        <div class="panel">
            <div class="panel-head">
                <div>
                    <div class="panel-title">Vendas por marca</div>
                    <div class="panel-subtitle">Top marcas</div>
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
                    <div class="panel-title">Status do estoque</div>
                    <div class="panel-subtitle">Distribuição atual</div>
                </div>
            </div>
            <div class="panel-body">
                <div id="chart-estoque" class="chart-container" style="height:260px;"></div>
            </div>
        </div>
        <div class="panel">
            <div class="panel-head">
                <div>
                    <div class="panel-title">Formas de pagamento</div>
                    <div class="panel-subtitle">Percentual de uso</div>
                </div>
            </div>
            <div class="panel-body">
                <div id="chart-pagamento" class="chart-container" style="height:260px;"></div>
            </div>
        </div>
        <div class="panel">
            <div class="panel-head">
                <div>
                    <div class="panel-title">Novos clientes</div>
                    <div class="panel-subtitle">Últimas 8 semanas</div>
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
                    <div class="panel-title">Atividade de vendas</div>
                    <div class="panel-subtitle">Heatmap por dia e hora</div>
                </div>
            </div>
            <div class="panel-body">
                <div id="chart-heatmap" class="chart-container" style="height:220px;"></div>
            </div>
        </div>
        <div class="panel">
            <div class="panel-head">
                <div>
                    <div class="panel-title">Funil de conversão</div>
                    <div class="panel-subtitle">Visitantes → Venda</div>
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
                <div class="panel-title">Vendas recentes</div>
                <a href="{{ route('adm.pedidos.index') }}" class="panel-action">Ver tudo</a>
            </div>
            <div class="panel-body" style="padding:0;">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Veículo</th>
                            <th>Cliente</th>
                            <th>Valor</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $stClass = ['entregue'=>'badge-green','a_caminho'=>'badge-amber','finalizado'=>'badge-gray','em_separacao'=>'badge-blue'];
                            $stLabel = ['entregue'=>'Entregue','a_caminho'=>'A caminho','finalizado'=>'Finalizado','em_separacao'=>'Em separação'];
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
                            <td colspan="4" style="text-align:center; color:#9EA19C; padding:2rem;">Nenhuma venda ainda</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel">
            <div class="panel-head">
                <div class="panel-title">Estoque — destaques</div>
                <a href="{{ route('adm.carros.index') }}" class="panel-action">Gerenciar</a>
            </div>
            <div class="panel-body" style="padding:0;">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Veículo</th>
                            <th>Ano</th>
                            <th>Valor</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $esClass = ['disponivel'=>'badge-green','reservado'=>'badge-amber'];
                            $esLabel = ['disponivel'=>'Disponível','reservado'=>'Reservado'];
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
                            <td colspan="4" style="text-align:center; color:#9EA19C; padding:2rem;">Nenhum carro no estoque</td>
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