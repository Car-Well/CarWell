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
<script src="{{ asset('js/adm/admDashboard.js') }}"></script>

</body>
</html>