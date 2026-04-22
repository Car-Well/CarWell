<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CarWell — Gerenciar Pedidos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/adm/admGerPed.css') }}">
</head>
<body>

    <nav class="main-nav">
        <div class="nav-left">
            <img src="{{ asset('img/logo.png') }}" alt="logo" class="nav-logo" />
        </div>
        <div class="nav-center">
            <div class="nav-links">
                <a href="{{ route('admHome') }}" class="nav-hover-btn">Dashboard</a>
                <a href="{{ route('admGerCar') }}" class="nav-hover-btn">Carros</a>
                <a href="{{ route('admGerPed') }}" class="nav-active nav-hover-btn">Pedidos</a>
                <a href="{{ route('admGerUser') }}" class="nav-hover-btn">Clientes</a>
            </div>
        </div>
        <div class="nav-right-spacer"></div>
    </nav>

    <main class="main">
        @if(session('success'))
            <div class="alert alert-success" style="margin-bottom:14px;">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger" style="margin-bottom:14px;">
                <strong>Não foi possível salvar.</strong>
                <ul style="margin:8px 0 0 18px;">
                    @foreach($errors->all() as $msg)
                        <li>{{ $msg }}</li>
                    @endforeach
                </ul>
            </div>
            <script>
                window.addEventListener('DOMContentLoaded', () => openPopUp('create'));
            </script>
        @endif

        <div class="page-header">
            <div>
                <h1 class="page-title">Gerenciar <span>Pedidos</span></h1>
                <p class="page-subtitle">Acompanhe e gerencie todos os pedidos</p>
            </div>
            <button class="btn btn-primary" onclick="openPopUp('create')">
                <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Novo pedido
            </button>
        </div>

        <div class="kpi-grid">
            <div class="kpi-card">
                <div class="kpi-label">Total</div>
                <div class="kpi-value">{{ $kpis['total'] ?? 0 }}</div>
                <div class="kpi-foot">pedidos realizados</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-label">Em separação</div>
                <div class="kpi-value blue">{{ $kpis['em_separacao'] ?? 0 }}</div>
                <div class="kpi-foot">sendo processados</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-label">A caminho</div>
                <div class="kpi-value amber">{{ $kpis['a_caminho'] ?? 0 }}</div>
                <div class="kpi-foot">em trânsito</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-label">Entregues</div>
                <div class="kpi-value green">{{ $kpis['entregue'] ?? 0 }}</div>
                <div class="kpi-foot">concluídos</div>
            </div>
        </div>

        <div class="toolbar">
            <div class="search-wrap">
                <svg class="search-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input type="text" class="search-input" id="searchInput" placeholder="Buscar cliente, carro ou nº do pedido..." oninput="filterRows()">
            </div>
            <div class="filter-group">
                <button class="filter-btn active" data-filter="all" onclick="setFilter(this)">Todos</button>
                <button class="filter-btn" data-filter="em_separacao" onclick="setFilter(this)">Em separação</button>
                <button class="filter-btn" data-filter="a_caminho" onclick="setFilter(this)">A caminho</button>
                <button class="filter-btn" data-filter="entregue" onclick="setFilter(this)">Entregues</button>
                <button class="filter-btn" data-filter="finalizado" onclick="setFilter(this)">Finalizados</button>
            </div>
        </div>

        <div class="table-card">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nº Pedido</th>
                        <th>Cliente</th>
                        <th>Veículo</th>
                        <th>Pagamento</th>
                        <th>Valor</th>
                        <th>Status</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @php
                        $statusClass = ['em_separacao'=>'badge-blue','a_caminho'=>'badge-amber','entregue'=>'badge-green','finalizado'=>'badge-gray'];
                        $statusLabel = ['em_separacao'=>'Em separação','a_caminho'=>'A caminho','entregue'=>'Entregue','finalizado'=>'Finalizado'];
                        $pagLabel = ['credito'=>'Crédito','debito'=>'Débito','pix'=>'PIX','boleto'=>'Boleto'];
                        $pagIcon = [
                            'credito'=>'<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>',
                            'debito' =>'<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>',
                            'pix' =>'<svg viewBox="0 0 24 24" fill="currentColor"><path d="M11.354 3.854a2 2 0 0 1 2.828 0l5.964 5.964a2 2 0 0 1 0 2.828l-5.964 5.964a2 2 0 0 1-2.828 0L5.39 12.646a2 2 0 0 1 0-2.828l5.964-5.964z"/></svg>',
                            'boleto' =>'<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="8" y1="13" x2="16" y2="13"/><line x1="8" y1="17" x2="16" y2="17"/></svg>',
                        ];
                    @endphp

                    @foreach(($pedidos ?? []) as $p)
                    @php
                        $nome = $p->cliente_nome ?? '';
                        $parts = preg_split('/\s+/', trim($nome)) ?: [];
                        $initials = strtoupper(substr($parts[0] ?? '', 0, 1) . substr($parts[1] ?? '', 0, 1));
                        $dataBr = $p->data_pedido ? $p->data_pedido->format('d/m/Y') : ($p->created_at?->format('d/m/Y') ?? '');
                    @endphp
                    <tr data-status="{{ $p->status }}" data-search="{{ strtolower(($p->numero ?? '').' '.($p->cliente_nome ?? '').' '.($p->veiculo_nome ?? '')) }}">
                        <td><span class="order-num">{{ $p->numero }}</span></td>
                        <td>
                            <div class="user-cell">
                                <div class="user-initials">{{ $initials ?: '—' }}</div>
                                <span class="user-name">{{ $p->cliente_nome }}</span>
                            </div>
                        </td>
                        <td class="text-muted">{{ $p->veiculo_nome }}</td>
                        <td>
                            <div class="pag-cell">
                                <span class="pag-icon">{!! $pagIcon[$p->pagamento] ?? '' !!}</span>
                                {{ $pagLabel[$p->pagamento] ?? $p->pagamento }}
                            </div>
                        </td>
                        <td class="text-bold">R$ {{ number_format((float) $p->valor, 2, ',', '.') }}</td>
                        <td><span class="badge {{ $statusClass[$p->status] ?? 'badge-gray' }}">{{ $statusLabel[$p->status] ?? $p->status }}</span></td>
                        <td class="text-muted">{{ $dataBr ?: '—' }}</td>
                        <td>
                            <div class="row-actions">
                                <button class="btn btn-secondary btn-sm" onclick="openEdit({{ $p->id }}, '{{ addslashes($p->cliente_nome) }}', '{{ addslashes($p->veiculo_nome) }}', '{{ $p->pagamento }}', '{{ $p->valor }}', '{{ $p->status }}', '{{ $p->numero }}')">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    Editar
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="openDelete({{ $p->id }}, '{{ $p->numero }}')">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/></svg>
                                    Excluir
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

            <div class="empty-state" id="emptyState" style="display:none;">
                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <h3>Nenhum resultado</h3>
                <p>Tente outro termo ou limpe os filtros.</p>
                <button class="btn btn-secondary" onclick="clearFilters()">Limpar filtros</button>
            </div>
        </div>

    </main>

    <div class="modal-overlay" id="modal-create" onclick="closeOnBackdrop(event,'create')">
        <div class="modal">
            <div class="modal-header">
                <div>
                    <div class="modal-title">Novo pedido</div>
                    <div class="modal-subtitle">Preencha os dados do pedido</div>
                </div>
                <button class="modal-close" onclick="closePopUp('create')">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('adm.pedidos.store') }}" method="POST" id="formCreate">
                    @csrf

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Cliente *</label>
                            <input type="text" name="cliente" class="form-control" placeholder="Nome do cliente">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Veículo *</label>
                            <input type="text" name="veiculo" class="form-control" placeholder="Marca e modelo">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Valor *</label>
                            <input type="number" name="valor" class="form-control" placeholder="0.00" step="0.01">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="em_separacao">Em separação</option>
                                <option value="a_caminho">A caminho</option>
                                <option value="entregue">Entregue</option>
                                <option value="finalizado">Finalizado</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Forma de pagamento *</label>
                        <div class="pag-options">
                            <label class="pag-opt" id="opt-credito">
                                <input type="radio" name="pagamento" value="credito" onchange="switchPag('credito')">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                                Crédito
                            </label>
                            <label class="pag-opt" id="opt-debito">
                                <input type="radio" name="pagamento" value="debito" onchange="switchPag('debito')">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                                Débito
                            </label>
                            <label class="pag-opt" id="opt-pix">
                                <input type="radio" name="pagamento" value="pix" onchange="switchPag('pix')">
                                <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M11.354 3.854a2 2 0 0 1 2.828 0l5.964 5.964a2 2 0 0 1 0 2.828l-5.964 5.964a2 2 0 0 1-2.828 0L5.39 12.646a2 2 0 0 1 0-2.828l5.964-5.964z"/></svg>
                                PIX
                            </label>
                            <label class="pag-opt" id="opt-boleto">
                                <input type="radio" name="pagamento" value="boleto" onchange="switchPag('boleto')">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                                Boleto
                            </label>
                        </div>
                    </div>

                    <div class="pag-fields" id="fields-card" style="display:none;">
                        <div class="pag-fields-title">Dados do cartão</div>
                        <div class="form-group">
                            <label class="form-label">Número do cartão</label>
                            <input type="text" name="cartao_numero" class="form-control" placeholder="0000 0000 0000 0000" maxlength="19" oninput="maskCard(this)">
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Nome no cartão</label>
                                <input type="text" name="cartao_nome" class="form-control" placeholder="NOME SOBRENOME">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Validade</label>
                                <input type="text" name="cartao_validade" class="form-control" placeholder="MM/AA" maxlength="5" oninput="maskValidade(this)">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">CVV</label>
                                <input type="text" name="cartao_cvv" class="form-control" placeholder="000" maxlength="4">
                            </div>
                            <div class="form-group" id="parcelas-wrap" style="display:none;">
                                <label class="form-label">Parcelas</label>
                                <select name="parcelas" class="form-control">
                                    <option value="1">1x sem juros</option>
                                    <option value="2">2x sem juros</option>
                                    <option value="3">3x sem juros</option>
                                    <option value="6">6x sem juros</option>
                                    <option value="12">12x com juros</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="pag-fields" id="fields-pix" style="display:none;">
                        <div class="pag-fields-title">Pagamento via PIX</div>
                        <div class="pix-box">
                            <div class="pix-qr">
                                <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="100" height="100" fill="white"/>
                                    <rect x="10" y="10" width="30" height="30" fill="#1A1C19"/>
                                    <rect x="15" y="15" width="20" height="20" fill="white"/>
                                    <rect x="18" y="18" width="14" height="14" fill="#1A1C19"/>
                                    <rect x="60" y="10" width="30" height="30" fill="#1A1C19"/>
                                    <rect x="65" y="15" width="20" height="20" fill="white"/>
                                    <rect x="68" y="18" width="14" height="14" fill="#1A1C19"/>
                                    <rect x="10" y="60" width="30" height="30" fill="#1A1C19"/>
                                    <rect x="15" y="65" width="20" height="20" fill="white"/>
                                    <rect x="18" y="68" width="14" height="14" fill="#1A1C19"/>
                                    <rect x="50" y="50" width="6" height="6" fill="#1A1C19"/>
                                    <rect x="60" y="50" width="6" height="6" fill="#1A1C19"/>
                                    <rect x="70" y="50" width="6" height="6" fill="#1A1C19"/>
                                    <rect x="80" y="50" width="6" height="6" fill="#1A1C19"/>
                                    <rect x="50" y="60" width="6" height="6" fill="#1A1C19"/>
                                    <rect x="70" y="60" width="6" height="6" fill="#1A1C19"/>
                                    <rect x="50" y="70" width="6" height="6" fill="#1A1C19"/>
                                    <rect x="60" y="70" width="6" height="6" fill="#1A1C19"/>
                                    <rect x="80" y="70" width="6" height="6" fill="#1A1C19"/>
                                    <rect x="60" y="80" width="6" height="6" fill="#1A1C19"/>
                                    <rect x="80" y="80" width="6" height="6" fill="#1A1C19"/>
                                </svg>
                            </div>
                            <div class="pix-info">
                                <div class="pix-label">Chave PIX</div>
                                <div class="pix-key">carwell@pagamentos.com</div>
                                <button type="button" class="btn btn-secondary btn-sm" onclick="copyPix()">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                                    <span id="copyPixBtn">Copiar chave</span>
                                </button>
                                <div class="pix-hint">O pagamento é confirmado em até 1 minuto após o envio.</div>
                            </div>
                        </div>
                    </div>

                    <div class="pag-fields" id="fields-boleto" style="display:none;">
                        <div class="pag-fields-title">Pagamento via Boleto</div>
                        <div class="boleto-box">
                            <div class="boleto-barras">
                                @for($i = 0; $i < 40; $i++)
                                    <div class="barra" style="width: {{ rand(1,3) }}px;"></div>
                                @endfor
                            </div>
                            <div class="boleto-codigo">34191.09008 12345.678901 23456.789012 3 10010000108900</div>
                            <button type="button" class="btn btn-secondary btn-sm" onclick="copyBoleto()">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                                <span id="copyBoletoBtn">Copiar código</span>
                            </button>
                            <div class="boleto-hint">Vencimento em 3 dias úteis. Pague em qualquer banco ou lotérica.</div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closePopUp('create')">Cancelar</button>
                <button class="btn btn-primary" onclick="document.getElementById('formCreate').submit()">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                    Salvar pedido
                </button>
            </div>
        </div>
    </div>

    <div class="modal-overlay" id="modal-edit" onclick="closeOnBackdrop(event,'edit')">
        <div class="modal">
            <div class="modal-header">
                <div>
                    <div class="modal-title">Editar pedido</div>
                    <div class="modal-subtitle" id="editSubtitle">Atualize os dados</div>
                </div>
                <button class="modal-close" onclick="closePopUp('edit')">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="formEdit">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="editId">

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Cliente *</label>
                            <input type="text" name="cliente" id="editCliente" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Veículo *</label>
                            <input type="text" name="veiculo" id="editVeiculo" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Valor *</label>
                            <input type="number" name="valor" id="editValor" class="form-control" min="0" step="0.01">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Forma de pagamento</label>
                            <select name="pagamento" id="editPagamento" class="form-control">
                                <option value="credito">Crédito</option>
                                <option value="debito">Débito</option>
                                <option value="pix">PIX</option>
                                <option value="boleto">Boleto</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status do pedido</label>
                        <div class="status-stepper">
                            <div class="step" data-step="em_separacao" onclick="selectStep(this)">
                                <div class="step-dot">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 7H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                                </div>
                                <div class="step-label">Em separação</div>
                            </div>
                            <div class="step-line"></div>
                            <div class="step" data-step="a_caminho" onclick="selectStep(this)">
                                <div class="step-dot">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="1" y="3" width="15" height="13" rx="1"/><path d="M16 8h4l3 3v5h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                                </div>
                                <div class="step-label">A caminho</div>
                            </div>
                            <div class="step-line"></div>
                            <div class="step" data-step="entregue" onclick="selectStep(this)">
                                <div class="step-dot">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                                </div>
                                <div class="step-label">Entregue</div>
                            </div>
                            <div class="step-line"></div>
                            <div class="step" data-step="finalizado" onclick="selectStep(this)">
                                <div class="step-dot">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                </div>
                                <div class="step-label">Finalizado</div>
                            </div>
                            <input type="hidden" name="status" id="editStatus">
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closePopUp('edit')">Cancelar</button>
                <button class="btn btn-primary" onclick="document.getElementById('formEdit').submit()">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                    Salvar alterações
                </button>
            </div>
        </div>
    </div>

    <div class="modal-overlay" id="modal-delete" onclick="closeOnBackdrop(event,'delete')">
        <div class="modal modal-sm">
            <div class="modal-header">
                <div>
                    <div class="modal-title">Excluir pedido</div>
                    <div class="modal-subtitle">Esta ação não pode ser desfeita</div>
                </div>
                <button class="modal-close" onclick="closePopUp('delete')">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="delete-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                </div>
                <p class="delete-msg">Tem certeza que deseja excluir o pedido <strong id="deleteNum"></strong>?</p>
                <p class="delete-hint">O pedido será removido permanentemente do sistema.</p>
                <form action="#" method="POST" id="formDelete">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" id="deleteId">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closePopUp('delete')">Cancelar</button>
                <button class="btn btn-delete" onclick="document.getElementById('formDelete').submit()">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                    Sim, excluir
                </button>
            </div>
        </div>
    </div>

    <script>
        function openPopUp(name) { 
            document.getElementById('modal-'+name).classList.add('open'); 
            document.body.style.overflow='hidden'; 
        }
        function closePopUp(name) { 
            document.getElementById('modal-'+name).classList.remove('open'); 
            document.body.style.overflow=''; 
        }
        function closeOnBackdrop(e,name) { 
            if(e.target===e.currentTarget) closePopUp(name); 
        }

        function openEdit(id, cliente, veiculo, pagamento, valor, status, num) {
            document.getElementById('editId').value       = id;
            document.getElementById('editCliente').value  = cliente;
            document.getElementById('editVeiculo').value  = veiculo;
            document.getElementById('editPagamento').value= pagamento;
            document.getElementById('editValor').value    = valor;
            document.getElementById('editSubtitle').textContent = 'Pedido ' + num;
            document.querySelectorAll('.step').forEach(s => s.classList.remove('active','done'));
            const steps = ['em_separacao','a_caminho','entregue','finalizado'];
            const idx = steps.indexOf(status);
            document.querySelectorAll('.step').forEach((s,i) => {
                if(i < idx) s.classList.add('done');
                if(i === idx) s.classList.add('active');
            });
            document.getElementById('editStatus').value = status;
            document.getElementById('formEdit').action = "{{ url('/adm/pedidos') }}/" + id;
            openPopUp('edit');
        }

        function selectStep(el) {
            const steps = Array.from(document.querySelectorAll('.step'));
            const idx = steps.indexOf(el);
            steps.forEach((s,i) => {
                s.classList.remove('active','done');
                if(i < idx) s.classList.add('done');
                if(i === idx) s.classList.add('active');
            });
            document.getElementById('editStatus').value = el.dataset.step;
        }

        function openDelete(id, num) {
            document.getElementById('deleteId').value = id;
            document.getElementById('deleteNum').textContent = num;
            document.getElementById('formDelete').action = "{{ url('/adm/pedidos') }}/" + id;
            openPopUp('delete');
        }

        function switchPag(tipo) {
            document.querySelectorAll('.pag-opt').forEach(o => o.classList.remove('selected'));
            document.getElementById('opt-'+tipo).classList.add('selected');
            document.querySelectorAll('.pag-fields').forEach(f => f.style.display='none');

            const parcelasWrap = document.getElementById('parcelas-wrap');

            if(tipo === 'credito') {
                document.getElementById('fields-card').style.display='block';
                parcelasWrap.style.display='block';
            } else if(tipo === 'debito') {
                document.getElementById('fields-card').style.display='block';
                parcelasWrap.style.display='none';
            } else if(tipo === 'pix') {
                document.getElementById('fields-pix').style.display='block';
            } else if(tipo === 'boleto') {
                document.getElementById('fields-boleto').style.display='block';
            }
        }

        function maskCard(el) {
            let v = el.value.replace(/\D/g,'').substring(0,16);
            el.value = v.replace(/(.{4})/g,'$1 ').trim();
        }

        function maskValidade(el) {
            let v = el.value.replace(/\D/g,'').substring(0,4);
            if(v.length >= 2) v = v.substring(0,2)+'/'+v.substring(2);
            el.value = v;
        }

        function copyPix() {
            navigator.clipboard.writeText('carwell@pagamentos.com');
            const btn = document.getElementById('copyPixBtn');
            btn.textContent = 'Copiado!';
            setTimeout(() => btn.textContent = 'Copiar chave', 2000);
        }

        function copyBoleto() {
            navigator.clipboard.writeText('34191.09008 12345.678901 23456.789012 3 10010000108900');
            const btn = document.getElementById('copyBoletoBtn');
            btn.textContent = 'Copiado!';
            setTimeout(() => btn.textContent = 'Copiar código', 2000);
        }

        let currentFilter = 'all';

        function setFilter(el) {
            currentFilter = el.dataset.filter;
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            el.classList.add('active');
            applyFilters();
        }

        function filterRows() { applyFilters(); }

        function applyFilters() {
            const q = document.getElementById('searchInput').value.toLowerCase().trim();
            const rows = document.querySelectorAll('#tableBody tr');
            let visible = 0;
            rows.forEach(row => {
                const matchFilter = currentFilter==='all' || row.dataset.status===currentFilter;
                const matchSearch = !q || row.dataset.search.includes(q);
                const show = matchFilter && matchSearch;
                row.style.display = show ? '' : 'none';
                if(show) visible++;
            });
            document.getElementById('emptyState').style.display = visible===0 ? '' : 'none';
        }

        function clearFilters() {
            document.getElementById('searchInput').value='';
            currentFilter='all';
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            document.querySelector('[data-filter="all"]').classList.add('active');
            applyFilters();
        }

        document.addEventListener('keydown', e => {
            if(e.key==='Escape') { ['create','edit','delete'].forEach(closePopUp); document.body.style.overflow=''; }
        });
    </script>

</body>
</html>