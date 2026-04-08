<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADM | Home</title>
    <link rel="stylesheet" href="{{ asset('css/admHome.css') }}">
</head>
<body>
    <main class="content">
        <nav class="nav-lateral">
            <img class="nav-img" src="{{ asset('img/imgTeste.jpg') }}" alt="Lorem">
            <div class="nav-container">
                <a class="nav-link" href="#">Lorem</a>
                <a class="nav-link" href="#">Ipsum</a>
                <a class="nav-link" href="#">Dolor</a>
                <a class="nav-link" href="#">Sit</a>
            </div>
        </nav>

        <section class="dashboard" aria-label="Dashboard administrativo">
            <header class="dashboard-topbar">
                <div class="topbar-left">
                    <h1 class="dashboard-title">Dashboard</h1>
                    <p class="dashboard-subtitle">Visão geral (placeholders prontos para dados reais).</p>
                </div>

                <div class="topbar-right">
                    <div class="topbar-search" role="search">
                        <input class="topbar-search-input" type="search" placeholder="Pesquisar (lorem)..." aria-label="Pesquisar">
                    </div>
                    <button class="topbar-action" type="button">Ação</button>
                </div>
            </header>

            <section class="kpi-grid" aria-label="Indicadores principais">
                <article class="kpi-card">
                    <div class="kpi-head">
                        <span class="kpi-label">Lorem KPI</span>
                        <span class="kpi-badge">Hoje</span>
                    </div>
                    <div class="kpi-value">1.234</div>
                    <div class="kpi-foot">Ipsum dolor sit amet</div>
                </article>

                <article class="kpi-card">
                    <div class="kpi-head">
                        <span class="kpi-label">Ipsum KPI</span>
                        <span class="kpi-badge kpi-badge--alt">7d</span>
                    </div>
                    <div class="kpi-value">56,7%</div>
                    <div class="kpi-foot">Consectetur adipiscing</div>
                </article>

                <article class="kpi-card">
                    <div class="kpi-head">
                        <span class="kpi-label">Dolor KPI</span>
                        <span class="kpi-badge">Mês</span>
                    </div>
                    <div class="kpi-value">R$ 9.999</div>
                    <div class="kpi-foot">Sed do eiusmod tempor</div>
                </article>

                <article class="kpi-card">
                    <div class="kpi-head">
                        <span class="kpi-label">Sit KPI</span>
                        <span class="kpi-badge kpi-badge--warn">Meta</span>
                    </div>
                    <div class="kpi-value">Lorem</div>
                    <div class="kpi-foot">Ut labore et dolore</div>
                </article>
            </section>

            <section class="charts-grid" aria-label="Gráficos (containers vazios)">
                <article class="panel panel--lg">
                    <header class="panel-head">
                        <h2 class="panel-title">Gráfico de linha</h2>
                        <div class="panel-actions">
                            <button class="panel-action" type="button">Filtro</button>
                        </div>
                    </header>
                    <div class="panel-body">
                        <div id="chart-line" class="chart-surface" aria-label="Container do gráfico de linha"></div>
                    </div>
                </article>

                <article class="panel">
                    <header class="panel-head">
                        <h2 class="panel-title">Gráfico de pizza</h2>
                        <div class="panel-actions">
                            <button class="panel-action" type="button">Opções</button>
                        </div>
                    </header>
                    <div class="panel-body">
                        <div id="chart-pie" class="chart-surface chart-surface--square" aria-label="Container do gráfico de pizza"></div>
                    </div>
                </article>

                <article class="panel">
                    <header class="panel-head">
                        <h2 class="panel-title">Gráfico de colunas</h2>
                        <div class="panel-actions">
                            <button class="panel-action" type="button">Opções</button>
                        </div>
                    </header>
                    <div class="panel-body">
                        <div id="chart-bar" class="chart-surface" aria-label="Container do gráfico de colunas"></div>
                    </div>
                </article>
            </section>

            <section class="table-grid" aria-label="Listas (placeholder)">
                <article class="panel panel--full">
                    <header class="panel-head">
                        <h2 class="panel-title">Atividades recentes</h2>
                        <div class="panel-actions">
                            <button class="panel-action" type="button">Ver tudo</button>
                        </div>
                    </header>
                    <div class="panel-body">
                        <div class="table-placeholder" role="table" aria-label="Tabela placeholder">
                            <div class="table-row table-row--head">
                                <div class="table-cell">Lorem</div>
                                <div class="table-cell">Ipsum</div>
                                <div class="table-cell">Dolor</div>
                                <div class="table-cell table-cell--right">Sit</div>
                            </div>
                            <div class="table-row">
                                <div class="table-cell">Lorem item</div>
                                <div class="table-cell">Ipsum</div>
                                <div class="table-cell">Dolor</div>
                                <div class="table-cell table-cell--right">—</div>
                            </div>
                            <div class="table-row">
                                <div class="table-cell">Amet</div>
                                <div class="table-cell">Consectetur</div>
                                <div class="table-cell">Adipiscing</div>
                                <div class="table-cell table-cell--right">—</div>
                            </div>
                            <div class="table-row">
                                <div class="table-cell">Elit</div>
                                <div class="table-cell">Sed</div>
                                <div class="table-cell">Eiusmod</div>
                                <div class="table-cell table-cell--right">—</div>
                            </div>
                        </div>
                    </div>
                </article>
            </section>
        </section>
    </main> 
</body>
</html> 