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
                    <a href="{{ route('admHome') }}" class="nav-active nav-hover-btn">Dashboard</a>
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
                    <h1 class="page-title">Visão <span>Geral</span></h1>
                    <p class="page-subtitle">Resumo do desempenho da plataforma</p>
                </div>
                <div class="header-right">
                    <div class="search-wrap">
                        <svg class="search-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        <input type="text" class="search-input" placeholder="Pesquisar...">
                    </div>
                    <button class="btn btn-primary">Nova ação</button>
                </div>
            </div>

            <div class="kpi-grid">
                <div class="kpi-card">
                    <div class="kpi-head">
                        <span class="kpi-label">Receita total</span>
                        <span class="kpi-badge kpi-badge--green">Mês</span>
                    </div>
                    <div class="kpi-value">R$ 9.999</div>
                    <div class="kpi-foot">Ipsum dolor sit amet</div>
                </div>
                <div class="kpi-card">
                    <div class="kpi-head">
                        <span class="kpi-label">Veículos vendidos</span>
                        <span class="kpi-badge kpi-badge--blue">7d</span>
                    </div>
                    <div class="kpi-value">1.234</div>
                    <div class="kpi-foot">Consectetur adipiscing</div>
                </div>
                <div class="kpi-card">
                    <div class="kpi-head">
                        <span class="kpi-label">Taxa de conversão</span>
                        <span class="kpi-badge kpi-badge--amber">Meta</span>
                    </div>
                    <div class="kpi-value">56,7%</div>
                    <div class="kpi-foot">Sed do eiusmod tempor</div>
                </div>
                <div class="kpi-card">
                    <div class="kpi-head">
                        <span class="kpi-label">Clientes ativos</span>
                        <span class="kpi-badge kpi-badge--green">Hoje</span>
                    </div>
                    <div class="kpi-value">348</div>
                    <div class="kpi-foot">Ut labore et dolore</div>
                </div>
            </div>

            <div class="charts-grid">
                <div class="panel panel--lg">
                    <div class="panel-head">
                        <span class="panel-title">Vendas ao longo do tempo</span>
                        <div class="panel-actions">
                            <button class="panel-action">7d</button>
                            <button class="panel-action">30d</button>
                            <button class="panel-action">90d</button>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="chart-surface"></div>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-head">
                        <span class="panel-title">Distribuição por status</span>
                        <button class="panel-action">Opções</button>
                    </div>
                    <div class="panel-body">
                        <div class="chart-surface"></div>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-head">
                        <span class="panel-title">Receita por marca</span>
                        <button class="panel-action">Opções</button>
                    </div>
                    <div class="panel-body">
                        <div class="chart-surface"></div>
                    </div>
                </div>
            </div>

            <div class="table-section">
                <div class="panel panel--full">
                    <div class="panel-head">
                        <span class="panel-title">Atividades recentes</span>
                        <button class="panel-action">Ver tudo</button>
                    </div>
                    <div class="panel-body">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Veículo</th>
                                    <th>Cliente</th>
                                    <th>Data</th>
                                    <th>Valor</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Honda Civic G12</td>
                                    <td>Lorem Ipsum</td>
                                    <td>08/04/2026</td>
                                    <td>R$ 108.900</td>
                                    <td><span class="badge badge-success">Vendido</span></td>
                                </tr>
                                <tr>
                                    <td>BMW M8 Competition</td>
                                    <td>Dolor Sit</td>
                                    <td>07/04/2026</td>
                                    <td>R$ 980.900</td>
                                    <td><span class="badge badge-warning">Reservado</span></td>
                                </tr>
                                <tr>
                                    <td>Ford Mustang GT</td>
                                    <td>Amet Consectetur</td>
                                    <td>06/04/2026</td>
                                    <td>R$ 860.000</td>
                                    <td><span class="badge badge-success">Vendido</span></td>
                                </tr>
                                <tr>
                                    <td>Toyota Corolla XEi</td>
                                    <td>Adipiscing Elit</td>
                                    <td>05/04/2026</td>
                                    <td>R$ 179.990</td>
                                    <td><span class="badge badge-info">Disponível</span></td>
                                </tr>
                                <tr>
                                    <td>Volkswagen Golf GTI</td>
                                    <td>Sed Do Eiusmod</td>
                                    <td>04/04/2026</td>
                                    <td>R$ 215.000</td>
                                    <td><span class="badge badge-info">Disponível</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </main>

    </body>
</html>