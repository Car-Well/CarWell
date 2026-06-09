<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>CarWell — {{ __('adm.car_titulo') }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/adm/admGerCar.css') }}">
    </head>
<body>

    <nav class="main-nav">
        <div class="nav-left">
            <img src="{{ asset('img/logo.png') }}" alt="logo" class="nav-logo">
        </div>
        <div class="nav-center">
            <div class="nav-links">
                <a href="{{ route('adm.dashboard') }}" class="nav-hover-btn">{{ __('adm.dashboard') }}</a>
                <a href="{{ route('adm.carros.index') }}" class="nav-active nav-hover-btn">{{ __('adm.carros') }}</a>
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

        @if(session('success'))
            <div class="alert alert-success" style="margin-bottom:14px;">{{ session('success') }}</div>
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
            <script>window.addEventListener('DOMContentLoaded', () => openModal('create'));</script>
        @endif

        <div class="page-header">
            <div>
                <h1 class="page-title">{{ __('adm.car_titulo') }}</h1>
                <p class="page-subtitle">{{ __('adm.car_subtitulo') }}</p>
            </div>
            <div style="display:flex; gap:10px; flex-wrap:wrap; align-items:center;">
                <details class="marcas-dropdown">
                    <summary class="btn btn-secondary">
                        Marcas
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="width:14px;height:14px;margin-left:4px;"><polyline points="6 9 12 15 18 9"/></svg>
                    </summary>
                    <div class="marcas-dropdown-menu">
                        <button onclick="openModal('marca')" class="marcas-dropdown-item">
                            <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="width:14px;height:14px;"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                            Adicionar marca
                        </button>
                        <button onclick="openModal('logo')" class="marcas-dropdown-item marcas-dropdown-item--border">
                            <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="width:14px;height:14px;"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                            Adicionar logo
                        </button>
                    </div>
                </details>
                <button class="btn btn-primary" onclick="openModal('create')">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Adicionar carro
                </button>
            </div>
        </div>

        <div class="kpi-grid">
            <div class="kpi-card">
                <div class="kpi-label">Total</div>
                <div class="kpi-value">{{ $kpis['total'] ?? 0 }}</div>
                <div class="kpi-foot">no estoque</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-label">Disponíveis</div>
                <div class="kpi-value green">{{ $kpis['disponivel'] ?? 0 }}</div>
                <div class="kpi-foot">prontos para venda</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-label">Reservados</div>
                <div class="kpi-value amber">{{ $kpis['reservado'] ?? 0 }}</div>
                <div class="kpi-foot">em negociação</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-label">Vendidos</div>
                <div class="kpi-value red">{{ $kpis['vendido'] ?? 0 }}</div>
                <div class="kpi-foot">este mês</div>
            </div>
        </div>

        <div class="toolbar">
            <div class="search-wrap">
                <svg class="search-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input type="text" class="search-input" id="searchInput" placeholder="Buscar marca, modelo ou ano..." oninput="filterCards()">
            </div>
            <div class="filter-group">
                <button class="filter-btn active" data-filter="all" onclick="setFilter(this)">Todos</button>
                <button class="filter-btn" data-filter="disponivel" onclick="setFilter(this)">Disponíveis</button>
                <button class="filter-btn" data-filter="reservado" onclick="setFilter(this)">Reservados</button>
                <button class="filter-btn" data-filter="vendido" onclick="setFilter(this)">Vendidos</button>
            </div>
        </div>

        <div class="cars-grid" id="carsGrid">
            @php
                $badgeClass = ['disponivel'=>'badge-success','reservado'=>'badge-warning','vendido'=>'badge-danger'];
                $badgeLabel = ['disponivel'=>'Disponível','reservado'=>'Reservado','vendido'=>'Vendido'];
            @endphp

            @forelse($carros as $i => $carro)
            <div class="car-card"
                data-status="{{ $carro->status }}"
                data-search="{{ strtolower($carro->marca.' '.$carro->modelo.' '.$carro->ano) }}"
                style="animation-delay:{{ $i * 0.06 }}s">
                <div class="car-thumb">
                    @if($carro->capa_path)
                        <img class="car-photo" src="{{ storage_url($carro->capa_path) }}" alt="{{ $carro->modelo }}">
                    @endif
                    <div class="car-thumb-inner">
                        <svg viewBox="0 0 24 24"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/></svg>
                    </div>
                    <span class="badge {{ $badgeClass[$carro->status] ?? 'badge-success' }}">{{ $badgeLabel[$carro->status] ?? $carro->status }}</span>
                    @if($carro->destacado)
                    <span class="badge-destaque">⭐ Destaque</span>
                    @endif
                </div>
                <div class="car-body">
                    <div class="car-meta">
                        <span class="car-brand">{{ $carro->marca }}</span>
                        <span class="car-year">{{ $carro->ano }}</span>
                    </div>
                    <div class="car-model">{{ $carro->modelo }}</div>
                    <div class="car-info">{{ $carro->km ? number_format($carro->km, 0, ',', '.') . ' km' : '—' }} · {{ $carro->tipo }}</div>
                    <div class="car-price">R$ {{ number_format((float)$carro->preco, 2, ',', '.') }}</div>
                    <div class="car-actions">
                        <button class="btn btn-secondary btn-sm"
                            data-id="{{ $carro->id }}"
                            data-marca="{{ addslashes($carro->marca) }}"
                            data-modelo="{{ addslashes($carro->modelo) }}"
                            data-ano="{{ (int)$carro->ano }}"
                            data-preco="{{ $carro->preco }}"
                            data-status="{{ $carro->status }}"
                            data-km="{{ $carro->km ?? '' }}"
                            data-cor="{{ addslashes($carro->cor ?? '') }}"
                            data-combustivel="{{ $carro->combustivel ?? '' }}"
                            data-cambio="{{ $carro->cambio ?? '' }}"
                            data-descricao="{{ addslashes(str_replace(["\r","\n","'"], ['',' ',''], $carro->descricao ?? '')) }}"
                            data-categoria="{{ $carro->categoria ?? '' }}"
                            data-capa="{{ $carro->capa_path ? storage_url($carro->capa_path) : '' }}"
                            data-galeria="{{ e(json_encode($carro->fotos->where('is_capa', false)->map(fn($f) => storage_url($f->path))->values())) }}"
                            onclick="openEditFromBtn(this)">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            Editar
                        </button>
                        <button class="btn btn-danger btn-sm"
                            onclick="openDelete({{ $carro->id }}, '{{ addslashes($carro->marca.' '.$carro->modelo) }}')">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/></svg>
                            Excluir
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-state" style="display:block; grid-column:1/-1;">
                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <h3>Nenhum carro cadastrado</h3>
                <p>Adicione o primeiro veículo ao estoque.</p>
                <button class="btn btn-primary" onclick="openModal('create')">Adicionar carro</button>
            </div>
            @endforelse

            <div class="empty-state" id="emptyState" style="display:none; grid-column:1/-1;">
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
                    <div class="modal-title">Novo carro</div>
                    <div class="modal-subtitle">Preencha os dados do veículo</div>
                </div>
                <button class="modal-close" onclick="closeModal('create')">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('adm.carros.store') }}" method="POST" id="formCreate" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Marca *</label>
                            @if($marcas->count())
                            <select name="marca" class="form-control" required>
                                <option value="">Selecionar...</option>
                                @foreach($marcas as $m)
                                <option value="{{ $m->nome }}" {{ old('marca') == $m->nome ? 'selected' : '' }}>{{ $m->nome }}</option>
                                @endforeach
                            </select>
                            @else
                            <input type="text" name="marca" class="form-control" value="{{ old('marca') }}" placeholder="ex: Honda">
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-label">Modelo *</label>
                            <input type="text" name="modelo" class="form-control" value="{{ old('modelo') }}" placeholder="ex: Civic G12">
                        </div>
                    </div>
                    <div class="form-row form-row-3">
                        <div class="form-group">
                            <label class="form-label">Ano *</label>
                            <input type="number" name="ano" class="form-control" value="{{ old('ano') }}" placeholder="2024" min="1990" max="{{ date('Y') + 1 }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Cor</label>
                            <input type="text" name="cor" class="form-control" value="{{ old('cor') }}" placeholder="ex: Preto">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Quilometragem</label>
                            <input type="number" name="km" class="form-control" value="{{ old('km') }}" placeholder="18400">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Valor de venda *</label>
                            <input type="number" name="preco" class="form-control" value="{{ old('preco') }}" placeholder="0.00" step="0.01">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Combustível</label>
                            <select name="combustivel" class="form-control">
                                <option value="">Selecionar...</option>
                                <option value="flex" {{ old('combustivel') == 'flex'     ? 'selected' : '' }}>Flex</option>
                                <option value="gasolina" {{ old('combustivel') == 'gasolina' ? 'selected' : '' }}>Gasolina</option>
                                <option value="diesel" {{ old('combustivel') == 'diesel'   ? 'selected' : '' }}>Diesel</option>
                                <option value="eletrico" {{ old('combustivel') == 'eletrico' ? 'selected' : '' }}>Elétrico</option>
                                <option value="hibrido" {{ old('combustivel') == 'hibrido'  ? 'selected' : '' }}>Híbrido</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Câmbio</label>
                            <select name="cambio" class="form-control">
                                <option value="">Selecionar...</option>
                                <option value="manual" {{ old('cambio') == 'manual' ? 'selected' : '' }}>Manual</option>
                                <option value="automatico" {{ old('cambio') == 'automatico' ? 'selected' : '' }}>Automático</option>
                                <option value="cvt" {{ old('cambio') == 'cvt' ? 'selected' : '' }}>CVT</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="disponivel" {{ old('status','disponivel') == 'disponivel' ? 'selected' : '' }}>Disponível</option>
                                <option value="reservado" {{ old('status') == 'reservado' ? 'selected' : '' }}>Reservado</option>
                                <option value="vendido" {{ old('status') == 'vendido' ? 'selected' : '' }}>Vendido</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Categoria</label>
                            <select name="categoria" class="form-control">
                                <option value="">Sem categoria</option>
                                <option value="esportivo"   {{ old('categoria') == 'esportivo'   ? 'selected' : '' }}>Esportivo</option>
                                <option value="suv"         {{ old('categoria') == 'suv'         ? 'selected' : '' }}>SUV</option>
                                <option value="sedan"       {{ old('categoria') == 'sedan'       ? 'selected' : '' }}>Sedã</option>
                                <option value="hatchback"   {{ old('categoria') == 'hatchback'   ? 'selected' : '' }}>Hatchback</option>
                                <option value="pickup"      {{ old('categoria') == 'pickup'      ? 'selected' : '' }}>Pickup</option>
                                <option value="offroad"     {{ old('categoria') == 'offroad'     ? 'selected' : '' }}>Off-road</option>
                                <option value="vintage"     {{ old('categoria') == 'vintage'     ? 'selected' : '' }}>Vintage</option>
                                <option value="luxo"        {{ old('categoria') == 'luxo'        ? 'selected' : '' }}>Luxo</option>
                                <option value="eletrico"    {{ old('categoria') == 'eletrico'    ? 'selected' : '' }}>Elétrico</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Descrição</label>
                        <textarea name="descricao" class="form-control" rows="3" placeholder="Destaque os pontos do veículo...">{{ old('descricao') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Foto de capa</label>
                        <div class="upload-area">
                            <input type="file" name="capa" accept="image/*" onchange="previewPhoto(event, 'previewCreate', 'uploadCreateContent')">
                            <div class="upload-content" id="uploadCreateContent">
                                <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><polyline points="16 16 12 12 8 16"/><line x1="12" y1="12" x2="12" y2="21"/><path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"/></svg>
                                <span>Clique ou arraste a foto</span>
                            </div>
                            <img id="previewCreate" class="upload-preview" style="display:none;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Mais fotos (galeria)</label>
                        <div class="upload-area">
                            <input type="file" name="fotos[]" accept="image/*" multiple onchange="previewGallery(event, 'galleryCreate', 'galleryCreateContent')">
                            <div class="upload-content" id="galleryCreateContent">
                                <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><polyline points="16 16 12 12 8 16"/><line x1="12" y1="12" x2="12" y2="21"/><path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"/></svg>
                                <span>Mais fotos (galeria)</span>
                            </div>
                            <div id="galleryCreate" class="gallery-preview-container"></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div style="display:flex; gap:8px; align-items:center;">
                    <button class="btn btn-secondary" onclick="closeModal('create')">Cancelar</button>
                    <button class="btn btn-destacar" type="submit" name="destacado" value="1" form="formCreate">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        Destacar na home
                    </button>
                </div>
                <button class="btn btn-primary" onclick="document.getElementById('formCreate').submit()">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                    Salvar carro
                </button>
            </div>
        </div>
    </div>

    <div class="modal-overlay" id="modal-edit" onclick="closeOnBackdrop(event,'edit')">
        <div class="modal">
            <div class="modal-header">
                <div>
                    <div class="modal-title">Editar carro</div>
                    <div class="modal-subtitle" id="editSubtitle">Atualize os dados do veículo</div>
                </div>
                <button class="modal-close" onclick="closeModal('edit')">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="formEdit" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="editId">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Marca *</label>
                            @if($marcas->count())
                            <select name="marca" id="editMarca" class="form-control">
                                <option value="">Selecionar...</option>
                                @foreach($marcas as $m)
                                <option value="{{ $m->nome }}">{{ $m->nome }}</option>
                                @endforeach
                            </select>
                            @else
                            <input type="text" name="marca" id="editMarca" class="form-control">
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-label">Modelo *</label>
                            <input type="text" name="modelo" id="editModelo" class="form-control">
                        </div>
                    </div>
                    <div class="form-row form-row-3">
                        <div class="form-group">
                            <label class="form-label">Ano *</label>
                            <input type="number" name="ano" id="editAno" class="form-control" min="1990" max="{{ date('Y') + 1 }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Cor</label>
                            <input type="text" name="cor" id="editCor" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Quilometragem</label>
                            <input type="number" name="km" id="editKm" class="form-control" min="0">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Valor de venda *</label>
                            <input type="number" name="preco" id="editPreco" class="form-control" min="0" step="0.01">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Combustível</label>
                            <select name="combustivel" id="editCombustivel" class="form-control">
                                <option value="flex">Flex</option>
                                <option value="gasolina">Gasolina</option>
                                <option value="diesel">Diesel</option>
                                <option value="eletrico">Elétrico</option>
                                <option value="hibrido">Híbrido</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Câmbio</label>
                            <select name="cambio" id="editCambio" class="form-control">
                                <option value="manual">Manual</option>
                                <option value="automatico">Automático</option>
                                <option value="cvt">CVT</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select name="status" id="editStatus" class="form-control">
                                <option value="disponivel">Disponível</option>
                                <option value="reservado">Reservado</option>
                                <option value="vendido">Vendido</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Categoria</label>
                            <select name="categoria" id="editCategoria" class="form-control">
                                <option value="">Sem categoria</option>
                                <option value="esportivo">Esportivo</option>
                                <option value="suv">SUV</option>
                                <option value="sedan">Sedã</option>
                                <option value="hatchback">Hatchback</option>
                                <option value="pickup">Pickup</option>
                                <option value="offroad">Off-road</option>
                                <option value="vintage">Vintage</option>
                                <option value="luxo">Luxo</option>
                                <option value="eletrico">Elétrico</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Descrição</label>
                        <textarea name="descricao" id="editDescricao" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Foto de capa atual</label>
                        <div id="editCapaAtual" style="display:none; margin-bottom:8px;">
                            <img id="editCapaAtualImg" src="" style="width:100%; max-height:160px; object-fit:cover; border-radius:8px; border:1px solid #e5e7eb;">
                        </div>
                        <label class="form-label" style="font-size:0.7rem; color:#9EA19C;">Trocar foto de capa</label>
                        <div class="upload-area">
                            <input type="file" name="capa" accept="image/*" onchange="previewPhoto(event, 'previewEdit', 'uploadEditContent')">
                            <div class="upload-content" id="uploadEditContent">
                                <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><polyline points="16 16 12 12 8 16"/><line x1="12" y1="12" x2="12" y2="21"/><path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"/></svg>
                                <span>Clique ou arraste a nova foto</span>
                            </div>
                            <img id="previewEdit" class="upload-preview" style="display:none;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Fotos da galeria atuais</label>
                        <div id="editGaleriaAtual" class="gallery-preview-container" style="margin-bottom:8px;"></div>
                        <label class="form-label" style="font-size:0.7rem; color:#9EA19C;">Adicionar mais fotos</label>
                        <div class="upload-area">
                            <input type="file" name="fotos[]" accept="image/*" multiple onchange="previewGallery(event, 'galleryEdit', 'galleryEditContent')">
                            <div class="upload-content" id="galleryEditContent">
                                <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><polyline points="16 16 12 12 8 16"/><line x1="12" y1="12" x2="12" y2="21"/><path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"/></svg>
                                <span>Mais fotos (galeria)</span>
                            </div>
                            <div id="galleryEdit" class="gallery-preview-container"></div>
                        </div>
                    </div>
                </form>
            </div>
            {{-- form oculto para destacar via POST --}}
            <form id="formDestacar" action="#" method="POST" style="display:none;">
                @csrf
            </form>

            <div class="modal-footer">
                <div style="display:flex; gap:8px; align-items:center;">
                    <button class="btn btn-secondary" onclick="closeModal('edit')">Cancelar</button>
                    <button class="btn btn-destacar" type="button" onclick="document.getElementById('formDestacar').submit()">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        Destacar na home
                    </button>
                </div>
                <button class="btn btn-primary" onclick="document.getElementById('formEdit').submit()">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                    Salvar alterações
                </button>
            </div>
        </div>
    </div>

    {{-- MODAL: Adicionar Marca --}}
    <div class="modal-overlay" id="modal-marca" onclick="closeOnBackdrop(event,'marca')">
        <div class="modal modal-sm">
            <div class="modal-header">
                <div>
                    <div class="modal-title">Adicionar marca</div>
                    <div class="modal-subtitle">Nome que aparecerá no select de carros</div>
                </div>
                <button class="modal-close" onclick="closeModal('marca')">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('adm.marcas.store') }}" method="POST" id="formMarca">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Nome da marca *</label>
                        <input type="text" name="nome" class="form-control" placeholder="ex: Toyota" required>
                    </div>
                </form>

                @if($marcas->count())
                <div style="margin-top:16px;">
                    <p class="form-label" style="margin-bottom:8px;">Marcas cadastradas</p>
                    <div style="display:flex; flex-wrap:wrap; gap:8px;">
                        @foreach($marcas as $m)
                        <div style="display:flex; align-items:center; gap:6px; background:#f4f5f3; border-radius:20px; padding:4px 12px; font-size:0.75rem; font-weight:700;">
                            {{ $m->nome }}
                            <form action="{{ route('adm.marcas.destroy', $m->id) }}" method="POST" style="margin:0;">
                                @csrf @method('DELETE')
                                <button type="submit" style="background:none;border:none;cursor:pointer;color:#e53e3e;font-size:0.9rem;line-height:1;padding:0;" title="Remover">&#x2715;</button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeModal('marca')">Cancelar</button>
                <button class="btn btn-primary" onclick="document.getElementById('formMarca').submit()">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                    Salvar marca
                </button>
            </div>
        </div>
    </div>

    {{-- MODAL: Adicionar Logo --}}
    <div class="modal-overlay" id="modal-logo" onclick="closeOnBackdrop(event,'logo')">
        <div class="modal modal-sm">
            <div class="modal-header">
                <div>
                    <div class="modal-title">Adicionar logo</div>
                    <div class="modal-subtitle">Logo que aparecerá na home do cliente</div>
                </div>
                <button class="modal-close" onclick="closeModal('logo')">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-body">
                @if($marcas->count())
                <form action="#" method="POST" id="formLogo" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Selecionar marca *</label>
                        <select name="marca_id" id="logoMarcaSelect" class="form-control" onchange="updateLogoAction(this)">
                            <option value="">Escolha a marca...</option>
                            @foreach($marcas as $m)
                            <option value="{{ $m->id }}" data-action="{{ route('adm.marcas.logo', $m->id) }}">
                                {{ $m->nome }}{{ $m->logo ? ' ✓' : '' }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Arquivo da logo (PNG, SVG, JPG)</label>
                        <div class="upload-area">
                            <input type="file" name="logo" accept="image/*" onchange="previewPhoto(event,'previewLogo','uploadLogoContent')">
                            <div class="upload-content" id="uploadLogoContent">
                                <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><polyline points="16 16 12 12 8 16"/><line x1="12" y1="12" x2="12" y2="21"/><path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"/></svg>
                                <span>Clique ou arraste a logo</span>
                            </div>
                            <img id="previewLogo" class="upload-preview" style="display:none; max-height:80px; object-fit:contain;">
                        </div>
                    </div>
                </form>
                @else
                <p style="color:#9EA19C; font-size:0.82rem;">Nenhuma marca cadastrada. Adicione uma marca primeiro.</p>
                @endif

                @if($marcas->where('logo','!=',null)->count())
                <div style="margin-top:16px;">
                    <p class="form-label" style="margin-bottom:8px;">Logos cadastradas</p>
                    <div style="display:flex; flex-wrap:wrap; gap:12px; align-items:center;">
                        @foreach($marcas->whereNotNull('logo') as $m)
                        <div style="text-align:center;">
                            <img src="{{ storage_url($m->logo) }}" alt="{{ $m->nome }}" style="height:32px; object-fit:contain; display:block; margin:0 auto 4px;">
                            <span style="font-size:0.65rem; color:#6B6E69;">{{ $m->nome }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeModal('logo')">Cancelar</button>
                <button class="btn btn-primary" onclick="document.getElementById('formLogo').submit()">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                    Salvar logo
                </button>
            </div>
        </div>
    </div>

    <div class="modal-overlay" id="modal-delete" onclick="closeOnBackdrop(event,'delete')">
        <div class="modal modal-sm">
            <div class="modal-header">
                <div>
                    <div class="modal-title">Excluir carro</div>
                    <div class="modal-subtitle">Esta ação não pode ser desfeita</div>
                </div>
                <button class="modal-close" onclick="closeModal('delete')">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="delete-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/></svg>
                </div>
                <p class="delete-msg">Tem certeza que deseja excluir <strong id="deleteNome"></strong>?</p>
                <p class="delete-hint">O veículo será removido permanentemente do estoque.</p>
                <form action="#" method="POST" id="formDelete">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeModal('delete')">Cancelar</button>
                <button class="btn btn-delete" onclick="document.getElementById('formDelete').submit()">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                    Sim, excluir
                </button>
            </div>
        </div>
    </div>

    <script>
        function openModal(name) { 
            document.getElementById('modal-'+name).classList.add('open'); 
            document.body.style.overflow='hidden'; 
        }

        function closeModal(name) { 
            document.getElementById('modal-'+name).classList.remove('open'); 
            document.body.style.overflow=''; 
        }

        function closeOnBackdrop(e,name) { 
            if(e.target===e.currentTarget) closeModal(name); 
        }

        function openEditFromBtn(btn) {
            const d = btn.dataset;
            let galeria = [];
            try { galeria = JSON.parse(d.galeria || '[]'); } catch(err) { console.error('galeria parse error:', err, d.galeria); }
            openEdit(
                d.id, d.marca, d.modelo, d.ano, d.preco, d.status,
                d.km, d.cor, d.combustivel, d.cambio, d.descricao,
                d.categoria, d.capa, galeria
            );
        }

        function openEdit(id,marca,modelo,ano,preco,status,km,cor,combustivel,cambio,descricao,categoria,capaUrl,galeriaUrls) {
            document.getElementById('editId').value = id;
            document.getElementById('editMarca').value = marca;
            document.getElementById('editModelo').value = modelo;
            document.getElementById('editAno').value = ano;
            document.getElementById('editPreco').value = preco;
            document.getElementById('editStatus').value = status;
            document.getElementById('editKm').value = km;
            document.getElementById('editCor').value = cor || '';
            document.getElementById('editCombustivel').value = combustivel || '';
            document.getElementById('editCambio').value = cambio || '';
            document.getElementById('editDescricao').value = descricao || '';
            document.getElementById('editCategoria').value = categoria || '';
            document.getElementById('editSubtitle').textContent = marca + ' ' + modelo;
            document.getElementById('formEdit').action = "{{ url('/adm/carros') }}/" + id;
            document.getElementById('formDestacar').action = "{{ url('/adm/carros') }}/" + id + "/destacar";

            // Foto de capa atual
            const capaAtual = document.getElementById('editCapaAtual');
            const capaAtualImg = document.getElementById('editCapaAtualImg');
            if (capaUrl) {
                capaAtualImg.src = capaUrl;
                capaAtual.style.display = 'block';
            } else {
                capaAtual.style.display = 'none';
            }
            // Limpa preview de nova capa
            document.getElementById('previewEdit').style.display = 'none';
            document.getElementById('uploadEditContent').style.display = 'flex';

            // Fotos da galeria atuais
            const galeriaAtual = document.getElementById('editGaleriaAtual');
            galeriaAtual.innerHTML = '';
            if (galeriaUrls && galeriaUrls.length) {
                galeriaUrls.forEach(url => {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'gallery-item-wrapper';
                    const img = document.createElement('img');
                    img.src = url;
                    img.className = 'gallery-preview-item';
                    wrapper.appendChild(img);
                    galeriaAtual.appendChild(wrapper);
                });
            }
            // Limpa preview de novas fotos
            document.getElementById('galleryEdit').innerHTML = '';
            document.getElementById('galleryEditContent').style.display = 'flex';

            openModal('edit');
        }

        function openDelete(id, nome) {
            document.getElementById('deleteNome').textContent = nome;
            document.getElementById('formDelete').action = "{{ url('/adm/carros') }}/" + id;
            openModal('delete');
        }

        function previewPhoto(event, previewId, contentId) {
            const file = event.target.files[0];
            if(!file) return;
            const reader = new FileReader();
            reader.onload = e => {
                const img = document.getElementById(previewId);
                img.src = e.target.result;
                img.style.display = 'block';
                document.getElementById(contentId).style.display = 'none';
            };
            reader.readAsDataURL(file);
        }

        function previewGallery(event, containerId, contentId) {
            const files = event.target.files;
            if(!files || !files.length) return;
            const container = document.getElementById(containerId);
            const content   = document.getElementById(contentId);
            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = e => {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'gallery-item-wrapper';
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'gallery-preview-item';
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'gallery-remove-btn';
                    btn.innerHTML = '&times;';
                    btn.onclick = () => { wrapper.remove(); if(!container.children.length) content.style.display='flex'; };
                    wrapper.appendChild(img);
                    wrapper.appendChild(btn);
                    container.appendChild(wrapper);
                };
                reader.readAsDataURL(file);
            });
            content.style.display = 'none';
        }

        let currentFilter = 'all';
        function setFilter(el) {
            currentFilter = el.dataset.filter;
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            el.classList.add('active');
            applyFilters();
        }
        function filterCards() { applyFilters(); }
        function applyFilters() {
            const q = document.getElementById('searchInput').value.toLowerCase().trim();
            const cards = document.querySelectorAll('.car-card');
            let visible = 0;
            cards.forEach(card => {
                const ok = (currentFilter==='all'||card.dataset.status===currentFilter) && (!q||card.dataset.search.includes(q));
                card.style.display = ok ? '' : 'none';
                if(ok) visible++;
            });
            document.getElementById('emptyState').style.display = visible===0 ? '' : 'none';
        }
        function clearFilters() {
            document.getElementById('searchInput').value='';
            currentFilter='all';
            document.querySelectorAll('.filter-btn').forEach(b=>b.classList.remove('active'));
            document.querySelector('[data-filter="all"]').classList.add('active');
            applyFilters();
        }
        function updateLogoAction(select) {
            const opt = select.options[select.selectedIndex];
            document.getElementById('formLogo').action = opt.dataset.action || '#';
        }

        document.addEventListener('keydown',e=>{ if(e.key==='Escape'){
            ['create','edit','delete','marca','logo'].forEach(closeModal);document.body.style.overflow='';
        }});
        </script>
    </body>
</html>