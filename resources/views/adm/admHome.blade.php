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
        <img src="{{ asset('img/logo.png') }}" alt="logo" class="nav-logo" />
    </div>

    <div class="nav-center">
        <div class="nav-links">
            <a href="{{ route('admHome') }}" class="nav-active  nav-hover-btn">Dashboard</a>
            <a href="{{ route('admGerCar') }}" class="nav-hover-btn">Carros</a>
            <a href="{{ route('admGerPed') }}" class="nav-hover-btn">Pedidos</a>
            <a href="{{ route('admGerUser') }}" class="nav-hover-btn">Clientes</a>
        </div>
    </div>

    <div class="nav-right-spacer"></div>
</nav>

<main class="main">
    <div class="page-header">
        <div>
            <h1 class="page-title">Dashboard <span>Administrativo</span></h1>
            <p class="page-subtitle">Visão completa do desempenho da CarWell</p>
        </div>
        <div class="header-meta">
            <span class="last-update">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                Atualizado agora
            </span>
        </div>
    </div>

    <div class="kpi-grid">
        <div class="kpi-card kpi-card--accent">
            <div class="kpi-icon kpi-icon--green">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            </div>
            <div class="kpi-body">
                <div class="kpi-label">Lucro total</div>
                <div class="kpi-value">R$ 4,2M</div>
                <div class="kpi-trend up">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="18 15 12 9 6 15"/></svg>
                    +18,4% vs mês anterior
                </div>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon kpi-icon--blue">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99z"/></svg>
            </div>
            <div class="kpi-body">
                <div class="kpi-label">Carros vendidos</div>
                <div class="kpi-value">142</div>
                <div class="kpi-trend up">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="18 15 12 9 6 15"/></svg>
                    +12 este mês
                </div>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon kpi-icon--purple">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <div class="kpi-body">
                <div class="kpi-label">Clientes ativos</div>
                <div class="kpi-value">348</div>
                <div class="kpi-trend up">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="18 15 12 9 6 15"/></svg>
                    +24 novos
                </div>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon kpi-icon--amber">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
            </div>
            <div class="kpi-body">
                <div class="kpi-label">Estoque atual</div>
                <div class="kpi-value">38</div>
                <div class="kpi-trend down">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="18 9 12 15 6 9"/></svg>
                    -6 esta semana
                </div>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon kpi-icon--red">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
            </div>
            <div class="kpi-body">
                <div class="kpi-label">Pedidos ativos</div>
                <div class="kpi-value">27</div>
                <div class="kpi-trend up">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="18 15 12 9 6 15"/></svg>
                    +5 hoje
                </div>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon kpi-icon--teal">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
            </div>
            <div class="kpi-body">
                <div class="kpi-label">Ticket médio</div>
                <div class="kpi-value">R$ 295k</div>
                <div class="kpi-trend up">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="18 15 12 9 6 15"/></svg>
                    +R$ 12k
                </div>
            </div>
        </div>
    </div>

    <div class="charts-row">
        <div class="panel panel--lg">
            <div class="panel-head">
                <div>
                    <div class="panel-title">Receita mensal</div>
                    <div class="panel-subtitle">Comparativo dos últimos 12 meses</div>
                </div>
                <div class="panel-actions">
                    <button class="panel-action active">Receita</button>
                    <button class="panel-action">Lucro</button>
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
                    <div class="panel-subtitle">Top marcas do estoque</div>
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
                    <div class="panel-subtitle">Heatmap por dia da semana e hora</div>
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
                <div class="panel-title">Top vendas recentes</div>
                <button class="panel-action">Ver tudo</button>
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
                            $vendas = [
                                ['veiculo'=>'BMW M8 Competition', 'initials'=>'LI', 'cliente'=>'Lorem Ipsum', 'valor'=>'R$ 980.900', 'status'=>'entregue'],
                                ['veiculo'=>'Mercedes AMG C63', 'initials'=>'DS', 'cliente'=>'Dolor Sit', 'valor'=>'R$ 650.000', 'status'=>'a_caminho'],
                                ['veiculo'=>'Ford Mustang GT', 'initials'=>'CE', 'cliente'=>'Consectetur Elit', 'valor'=>'R$ 860.000', 'status'=>'entregue'],
                                ['veiculo'=>'Honda Civic G12', 'initials'=>'AT', 'cliente'=>'Adipiscing Tem.', 'valor'=>'R$ 108.900', 'status'=>'finalizado'],
                                ['veiculo'=>'Volkswagen Golf GTI', 'initials'=>'SE', 'cliente'=>'Sed Do Eiusmod', 'valor'=>'R$ 215.000', 'status'=>'em_separacao'],
                            ];
                            $stClass = ['entregue'=>'badge-green', 'a_caminho'=>'badge-amber', 'finalizado'=>'badge-gray', 'em_separacao'=>'badge-blue'];
                            $stLabel = ['entregue'=>'Entregue', 'a_caminho'=>'A caminho', 'finalizado'=>'Finalizado', 'em_separacao'=>'Em separação'];
                        @endphp
                        @foreach($vendas as $v)
                            <tr>
                                <td class="td-veiculo">{{ $v['veiculo'] }}</td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-initials">{{ $v['initials'] }}</div>
                                        <span>{{ $v['cliente'] }}</span>
                                    </div>
                                </td>
                                <td class="text-bold">{{ $v['valor'] }}</td>
                                <td><span class="badge {{ $stClass[$v['status']] }}">{{ $stLabel[$v['status']] }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel">
            <div class="panel-head">
                <div class="panel-title">Estoque — destaques</div>
                <button class="panel-action">Gerenciar</button>
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
                            $estoque = [
                                ['veiculo'=>'Porsche 911 GT3', 'ano'=>2024, 'valor'=>'R$ 1,2M', 'status'=>'disponivel'],
                                ['veiculo'=>'Ferrari Roma', 'ano'=>2023, 'valor'=>'R$ 2,8M', 'status'=>'reservado'],
                                ['veiculo'=>'Audi RS6 Avant', 'ano'=>2024, 'valor'=>'R$ 680k', 'status'=>'disponivel'],
                                ['veiculo'=>'Lamborghini Urus', 'ano'=>2023, 'valor'=>'R$ 1,9M', 'status'=>'reservado'],
                                ['veiculo'=>'Range Rover Sport', 'ano'=>2025, 'valor'=>'R$ 480k', 'status'=>'disponivel'],
                            ];
                            $esClass = ['disponivel'=>'badge-green','reservado'=>'badge-amber'];
                            $esLabel = ['disponivel'=>'Disponível','reservado'=>'Reservado'];
                        @endphp
                        @foreach($estoque as $e)
                            <tr>
                                <td class="td-veiculo">{{ $e['veiculo'] }}</td>
                                <td class="text-muted">{{ $e['ano'] }}</td>
                                <td class="text-bold">{{ $e['valor'] }}</td>
                                <td><span class="badge {{ $esClass[$e['status']] }}">{{ $esLabel[$e['status']] }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

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
    extraCssText: 'box-shadow:0 4px 16px rgba(0,0,0,0.10); border-radius:10px; padding:10px 14px;'
};

const chartReceita = echarts.init(document.getElementById('chart-receita'));
chartReceita.setOption({
    tooltip: { ...tooltip, trigger: 'axis' },
    grid: { left: 40, right: 16, top: 16, bottom: 32 },
    xAxis: {
        type: 'category',
        data: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        axisLine: { lineStyle: { color: 'rgba(0,0,0,0.08)' } },
        axisTick: { show: false },
        axisLabel: { color: MUTED, fontFamily: 'DM Sans', fontSize: 11 }
    },
    yAxis: {
        type: 'value',
        axisLabel: { color: MUTED, fontFamily: 'DM Sans', fontSize: 11, formatter: v => 'R$' + (v/1000) + 'k' },
        splitLine: { lineStyle: { color: 'rgba(0,0,0,0.05)' } }
    },
    series: [{
        name: 'Receita',
        type: 'line',
        smooth: true,
        data: [520000, 320000, 290000, 410000, 380000, 280000, 490000, 610000, 580000, 650000, 720000, 840000],
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
chartMarcas.setOption({
    tooltip: { ...tooltip, trigger: 'axis', axisPointer: { type: 'none' } },
    grid: { left: 70, right: 20, top: 10, bottom: 10 },
    xAxis: { type: 'value', axisLabel: { show: false }, splitLine: { lineStyle: { color: 'rgba(0,0,0,0.05)' } } },
    yAxis: {
        type: 'category',
        data: ['Outros', 'Audi', 'Ford', 'Mercedes', 'BMW', 'Toyota', 'Honda', 'VW'],
        axisLine: { show: false },
        axisTick: { show: false },
        axisLabel: { color: TEXT, fontFamily: 'DM Sans', fontSize: 12 }
    },
    series: [{
        type: 'bar',
        data: [4, 6, 8, 10, 14, 18, 24, 28],
        barMaxWidth: 18,
        itemStyle: {
            borderRadius: [0, 6, 6, 0],
            color: params => {
                const colors = [MUTED, '#94A3B8', AMBER, RED, BLUE, TEAL, GREEN_LIGHT, GREEN];
                return colors[params.dataIndex];
            }
        },
        label: { show: true, position: 'right', color: MUTED, fontFamily: 'DM Sans', fontSize: 11 }
    }]
});

const chartEstoque = echarts.init(document.getElementById('chart-estoque'));
chartEstoque.setOption({
    tooltip: { ...tooltip, trigger: 'item' },
    legend: {
        bottom: 0, left: 'center',
        textStyle: { color: TEXT, fontFamily: 'DM Sans', fontSize: 11 },
        itemWidth: 10, itemHeight: 10,
        icon: 'circle'
    },
    series: [{
        type: 'pie',
        radius: '65%',
        center: ['50%', '50%'],
        avoidLabelOverlap: false,
        label: { show: false },
        emphasis: { label: { show: true, fontSize: 14, fontWeight: 700, fontFamily: 'Syne' } },
        data: [
            { value: 18, name: 'Disponível', itemStyle: { color: GREEN } },
            { value: 4,  name: 'Reservado',  itemStyle: { color: AMBER } },
            { value: 2,  name: 'Vendido',    itemStyle: { color: RED } },
            { value: 14, name: 'Em análise', itemStyle: { color: BLUE } },
        ]
    }]
});

const chartPagamento = echarts.init(document.getElementById('chart-pagamento'));
chartPagamento.setOption({
    tooltip: { ...tooltip, trigger: 'item' },
    legend: {
        bottom: 0, left: 'center',
        textStyle: { color: TEXT, fontFamily: 'DM Sans', fontSize: 11 },
        itemWidth: 10, itemHeight: 10,
        icon: 'circle'
    },
    series: [{
        type: 'pie',
        radius: ['48%', '72%'],
        center: ['50%', '44%'],
        avoidLabelOverlap: false,
        label: { show: false },
        emphasis: { label: { show: true, fontSize: 14, fontWeight: 700, fontFamily: 'Syne' } },
        data: [
            { value: 48, name: 'Crédito', itemStyle: { color: BLUE } },
            { value: 28, name: 'PIX', itemStyle: { color: GREEN } },
            { value: 14, name: 'Débito',  itemStyle: { color: TEAL } },
            { value: 10, name: 'Boleto',  itemStyle: { color: AMBER } },
        ]
    }]
});

const chartClientes = echarts.init(document.getElementById('chart-clientes'));
chartClientes.setOption({
    tooltip: { ...tooltip, trigger: 'axis' },
    grid: { left: 30, right: 10, top: 10, bottom: 30 },
    xAxis: {
        type: 'category',
        data: ['S1', 'S2', 'S3', 'S4', 'S5', 'S6', 'S7', 'S8'],
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
        data: [8, 14, 11, 19, 16, 22, 18, 24],
        barMaxWidth: 22,
        itemStyle: {
            borderRadius: [6,6,0,0],
            color: { type: 'linear', x: 0, y: 0, x2: 0, y2: 1,
                colorStops: [
                    { offset: 0, color: GREEN },
                    { offset: 1, color: GREEN_LIGHT }
                ]
            }
        }
    }]
});

const days   = ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'];
const hours  = ['8h', '9h', '10h', '11h', '12h', '13h', '14h', '15h', '16h', '17h', '18h', '19h', '20h'];
const heatData = [];
for (let d = 0; d < 7; d++) {
    for (let h = 0; h < 13; h++) {
        const base = (d >= 1 && d <= 5) ? 60 : 20;
        const peak = (h >= 2 && h <= 5) ? 40 : 0;
        heatData.push([h, d, Math.round(Math.random() * base + peak)]);
    }
}

const chartHeatmap = echarts.init(document.getElementById('chart-heatmap'));
chartHeatmap.setOption({
    tooltip: {
        ...tooltip,
        formatter: p => `${days[p.data[1]]} às ${hours[p.data[0]]}<br><b>${p.data[2]} vendas</b>`
    },
    grid: { left: 40, right: 60, top: 10, bottom: 30 },
    xAxis: {
        type: 'category',
        data: hours,
        axisLine: { show: false },
        axisTick: { show: false },
        axisLabel: { color: MUTED, fontFamily: 'DM Sans', fontSize: 11 }
    },
    yAxis: {
        type: 'category',
        data: days,
        axisLine: { show: false },
        axisTick: { show: false },
        axisLabel: { color: MUTED, fontFamily: 'DM Sans', fontSize: 11 }
    },
    visualMap: {
        min: 0, max: 100,
        calculable: false,
        orient: 'vertical',
        right: 0, top: 'center',
        inRange: { color: ['#E1F5EE', GREEN_LIGHT, GREEN, GREEN_DARK] },
        textStyle: { color: MUTED, fontSize: 10, fontFamily: 'DM Sans' }
    },
    series: [{
        type: 'heatmap',
        data: heatData,
        itemStyle: { borderRadius: 4, borderWidth: 2, borderColor: BG }
    }]
});

const chartFunil = echarts.init(document.getElementById('chart-funil'));
chartFunil.setOption({
    tooltip: { ...tooltip, trigger: 'item' },
    series: [{
        type: 'funnel',
        left: '5%', width: '90%',
        top: 10, bottom: 10,
        sort: 'descending',
        gap: 4,
        label: {
            show: true, position: 'inside',
            formatter: '{b}\n{c}',
            color: '#fff',
            fontFamily: 'DM Sans',
            fontSize: 12,
            fontWeight: 600
        },
        itemStyle: { borderWidth: 0 },
        data: [
            { value: 1200, name: 'Visitantes', itemStyle: { color: BLUE } },
            { value: 480, name: 'Interessados', itemStyle: { color: PURPLE } },
            { value: 210, name: 'Test drive', itemStyle: { color: TEAL } },
            { value: 142, name: 'Vendas', itemStyle: { color: GREEN } },
        ]
    }]
});

window.addEventListener('resize', () => {
    [chartReceita, chartMarcas, chartEstoque, chartPagamento, chartClientes, chartHeatmap, chartFunil]
        .forEach(c => c.resize());
});

document.querySelectorAll('.period-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.period-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
    });
});
</script>

</body>
</html>