<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>ADM - CarWell - Gerenciar Carros</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/adm/admGerCar.css') }}">
    </head>
    <body>

        <nav class="main-nav">
            <div class="nav-left">
                <img src="{{ asset('img/logo.png') }}" alt="logo" class="nav-logo" />
            </div>

            <div class="nav-center">
                <div class="nav-links">
                    <a href="{{ route('admHome') }}" class="nav-hover-btn">Dashboard</a>
                    <a href="{{ route('admGerCar') }}" class="nav-active nav-hover-btn">Carros</a>
                    <a href="#" class="nav-hover-btn">Pedidos</a>
                    <a href="{{ route('admGerUser') }}" class="nav-hover-btn">Clientes</a>
                </div>
            </div>

            <div class="nav-right-spacer"></div>
        </nav>

        <main class="main">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Gerenciar <span>Carros</span></h1>
                    <p class="page-subtitle">Gerencie todo o estoque de veículos</p>
                </div>
                <button class="btn btn-primary" onclick="openModal('create')">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Adicionar carro
                </button>
            </div>

            <div class="kpi-grid">
                <div class="kpi-card">
                    <div class="kpi-label">Total</div>
                    <div class="kpi-value">24</div>
                    <div class="kpi-foot">no estoque</div>
                </div>
                <div class="kpi-card">
                    <div class="kpi-label">Disponíveis</div>
                    <div class="kpi-value green">18</div>
                    <div class="kpi-foot">prontos para venda</div>
                </div>
                <div class="kpi-card">
                    <div class="kpi-label">Reservados</div>
                    <div class="kpi-value amber">4</div>
                    <div class="kpi-foot">em negociação</div>
                </div>
                <div class="kpi-card">
                    <div class="kpi-label">Vendidos</div>
                    <div class="kpi-value red">2</div>
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
                $carros = [
                    ['id'=>1,'marca'=>'Honda', 'modelo'=>'Civic G8 EXS', 'ano'=>2009, 'preco'=>'R$ 56.000', 'status'=>'reservado', 'km'=>'140.000 km'],
                    ['id'=>2,'marca'=>'Honda', 'modelo'=>'WR-V', 'ano'=>2021, 'preco'=>'R$ 84.400', 'status'=>'reservado', 'km'=>'110.200 km'],
                    ['id'=>3,'marca'=>'Fiat', 'modelo'=>'Toro', 'ano'=>2018, 'preco'=>'R$ 81.590', 'status'=>'reservado', 'km'=>'128.000 km'],
                    ['id'=>4,'marca'=>'Gurgel', 'modelo'=>'BR-800', 'ano'=>1993, 'preco'=>'R$ 21.500', 'status'=>'disponivel', 'km'=>'240.700 km'],
                    ['id'=>5,'marca'=>'Mercedes', 'modelo'=>'AMG C63', 'ano'=>2024, 'preco'=>'R$ 650.000', 'status'=>'vendido', 'km'=>'8.100 km'],
                    ['id'=>6,'marca'=>'Volkswagen', 'modelo'=>'Golf GTI', 'ano'=>2023, 'preco'=>'R$ 215.000', 'status'=>'disponivel', 'km'=>'12.300 km'],
                ];
                $badgeClass = ['disponivel'=>'badge-success','reservado'=>'badge-warning','vendido'=>'badge-danger'];
                $badgeLabel = ['disponivel'=>'Disponível','reservado'=>'Reservado','vendido'=>'Vendido'];
                @endphp

                @foreach($carros as $i => $carro)
                <div class="car-card" data-status="{{ $carro['status'] }}" data-search="{{ strtolower($carro['marca'].' '.$carro['modelo'].' '.$carro['ano']) }}" style="animation-delay:{{ $i * 0.06 }}s">
                    <div class="car-thumb">
                        <div class="car-thumb-inner">
                            <svg viewBox="0 0 24 24"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/></svg>
                        </div>
                        <span class="badge {{ $badgeClass[$carro['status']] }}">{{ $badgeLabel[$carro['status']] }}</span>
                    </div>
                    <div class="car-body">
                        <div class="car-meta">
                            <span class="car-brand">{{ $carro['marca'] }}</span>
                            <span class="car-year">{{ $carro['ano'] }}</span>
                        </div>
                        <div class="car-model">{{ $carro['modelo'] }}</div>
                        <div class="car-info">{{ $carro['km'] }} · Seminovo</div>
                        <div class="car-price">{{ $carro['preco'] }}</div>
                        <div class="car-actions">
                            <button class="btn btn-secondary btn-sm" onclick="openEdit({{ $carro['id'] }}, '{{ $carro['marca'] }}', '{{ $carro['modelo'] }}', {{ $carro['ano'] }}, '{{ $carro['preco'] }}', '{{ $carro['status'] }}', '{{ $carro['km'] }}')">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                Editar
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="openDelete({{ $carro['id'] }}, '{{ $carro['marca'] }} {{ $carro['modelo'] }}')">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/></svg>
                                Excluir
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="empty-state" id="emptyState" style="display:none;">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <h3>Nenhum resultado</h3>
                    <p>Tente outro termo ou limpe os filtros.</p>
                    <button class="btn btn-secondary" onclick="clearFilters()">Limpar filtros</button>
                </div>
            </div>
        </main>

        <div class="modal-overlay" id="modal-create" onclick="closeOnBackdrop(event, 'create')">
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
                    <form action="#" method="POST" id="formCreate">
                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Marca *</label>
                                <input type="text" name="marca" class="form-control" placeholder="ex: Honda">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Modelo *</label>
                                <input type="text" name="modelo" class="form-control" placeholder="ex: Civic G12">
                            </div>
                        </div>
                        <div class="form-row form-row-3">
                            <div class="form-group">
                                <label class="form-label">Ano *</label>
                                <input type="number" name="ano" class="form-control" placeholder="2024" min="1990" max="{{ date('Y') + 1 }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Cor</label>
                                <input type="text" name="cor" class="form-control" placeholder="ex: Preto">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Quilometragem</label>
                                <input type="number" name="km" class="form-control" placeholder="18400">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Valor de venda *</label>
                                <input type="number" name="preco" class="form-control" placeholder="0.00" step="0.01">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Combustível</label>
                                <select name="combustivel" class="form-control">
                                    <option value="">Selecionar...</option>
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
                                <select name="cambio" class="form-control">
                                    <option value="">Selecionar...</option>
                                    <option value="manual">Manual</option>
                                    <option value="automatico">Automático</option>
                                    <option value="cvt">CVT</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option value="disponivel">Disponível</option>
                                    <option value="reservado">Reservado</option>
                                    <option value="vendido">Vendido</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Descrição</label>
                            <textarea name="descricao" class="form-control" rows="3" placeholder="Destaque os pontos do veículo..."></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Foto</label>
                            <div class="upload-area" id="uploadCreate">
                                <input type="file" name="foto" accept="image/*" onchange="previewPhoto(event, 'previewCreate')">
                                <div class="upload-content" id="uploadCreateContent">
                                    <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><polyline points="16 16 12 12 8 16"/><line x1="12" y1="12" x2="12" y2="21"/><path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"/></svg>
                                    <span>Clique ou arraste a foto</span>
                                </div>
                                <img id="previewCreate" class="upload-preview" style="display:none;">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" onclick="closeModal('create')">Cancelar</button>
                    <button class="btn btn-primary" onclick="document.getElementById('formCreate').submit()">
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                        Salvar carro
                    </button>
                </div>
            </div>
        </div>

        <div class="modal-overlay" id="modal-edit" onclick="closeOnBackdrop(event, 'edit')">
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
                    <form action="#" method="POST" id="formEdit">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="editId">
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Marca *</label>
                                <input type="text" name="marca" id="editMarca" class="form-control">
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
                                <input type="text" name="km" id="editKm" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Valor de venda *</label>
                                <input type="text" name="preco" id="editPreco" class="form-control">
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
                        <div class="form-group">
                            <label class="form-label">Descrição</label>
                            <textarea name="descricao" id="editDescricao" class="form-control" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" onclick="closeModal('edit')">Cancelar</button>
                    <button class="btn btn-primary" onclick="document.getElementById('formEdit').submit()">
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                        Salvar alterações
                    </button>
                </div>
            </div>
        </div>

        <div class="modal-overlay" id="modal-delete" onclick="closeOnBackdrop(event, 'delete')">
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
                        <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                    </div>
                    <p class="delete-msg">Tem certeza que deseja excluir<strong id="deleteNome"></strong>?</p>
                    <p class="delete-hint">O veículo será removido permanentemente do estoque.</p>

                    <form action="#" method="POST" id="formDelete">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" id="deleteId">
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
            document.getElementById('modal-' + name).classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(name) {
            document.getElementById('modal-' + name).classList.remove('open');
            document.body.style.overflow = '';
        }

        function closeOnBackdrop(e, name) {
            if (e.target === e.currentTarget) closeModal(name);
        }

        function openEdit(id, marca, modelo, ano, preco, status, km) {
            document.getElementById('editId').value = id;
            document.getElementById('editMarca').value = marca;
            document.getElementById('editModelo').value = modelo;
            document.getElementById('editAno').value = ano;
            document.getElementById('editPreco').value = preco;
            document.getElementById('editStatus').value = status;
            document.getElementById('editKm').value = km;
            document.getElementById('editSubtitle').textContent = marca + ' ' + modelo;
            openModal('edit');
        }

        function openDelete(id, nome) {
            document.getElementById('deleteId').value = id;
            document.getElementById('deleteNome').textContent = nome;
            openModal('delete');
        }

        function previewPhoto(event, previewId) {
            const file = event.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = e => {
                const img = document.getElementById(previewId);
                img.src = e.target.result;
                img.style.display = 'block';
                document.getElementById('uploadCreateContent').style.display = 'none';
            };
            reader.readAsDataURL(file);
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
                const matchFilter = currentFilter === 'all' || card.dataset.status === currentFilter;
                const matchSearch = !q || card.dataset.search.includes(q);
                const show = matchFilter && matchSearch;
                card.style.display = show ? '' : 'none';
                if (show) visible++;
            });
            document.getElementById('emptyState').style.display = visible === 0 ? '' : 'none';
        }

        function clearFilters() {
            document.getElementById('searchInput').value = '';
            currentFilter = 'all';
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            document.querySelector('[data-filter="all"]').classList.add('active');
            applyFilters();
        }

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') {
                ['create','edit','delete'].forEach(closeModal);
                document.body.style.overflow = '';
            }
        });
        </script>
    </body>
</html>