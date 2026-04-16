<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>CarWell — Gerenciar Usuários</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/adm/admGerUser.css') }}">
    </head>
    <body>
        <nav class="navbar">
            <div class="navbar-brand">
                <div class="navbar-logo">
                    <svg viewBox="0 0 24 24"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/></svg>
                </div>
                <span>Car<strong>Well</strong></span>
            </div>
            <ul class="navbar-nav">
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Carros</a></li>
                <li><a href="#">Pedidos</a></li>
                <li><a href="#" class="active">Usuários</a></li>
            </ul>
            <div class="navbar-right">
                <button class="icon-btn">
                    <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                </button>
                <div class="avatar">AD</div>
            </div>
        </nav>

        <main class="main">

            <div class="page-header">
                <div>
                    <h1 class="page-title">Gerenciar <span>Usuários</span></h1>
                    <p class="page-subtitle">Gerencie os usuários da plataforma</p>
                </div>
                <button class="btn btn-primary" onclick="openModal('create')">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Adicionar usuário
                </button>
            </div>

            <div class="kpi-grid">
                <div class="kpi-card">
                    <div class="kpi-label">Total</div>
                    <div class="kpi-value">128</div>
                    <div class="kpi-foot">usuários cadastrados</div>
                </div>
                <div class="kpi-card">
                    <div class="kpi-label">Admins</div>
                    <div class="kpi-value green">4</div>
                    <div class="kpi-foot">com acesso total</div>
                </div>
                <div class="kpi-card">
                    <div class="kpi-label">Clientes</div>
                    <div class="kpi-value blue">120</div>
                    <div class="kpi-foot">contas ativas</div>
                </div>
                <div class="kpi-card">
                    <div class="kpi-label">Inativos</div>
                    <div class="kpi-value amber">4</div>
                    <div class="kpi-foot">sem acesso</div>
                </div>
            </div>

            <div class="toolbar">
                <div class="search-wrap">
                    <svg class="search-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <input type="text" class="search-input" id="searchInput" placeholder="Buscar nome, email ou perfil..." oninput="filterRows()">
                </div>
                <div class="filter-group">
                    <button class="filter-btn active" data-filter="all" onclick="setFilter(this)">Todos</button>
                    <button class="filter-btn" data-filter="admin" onclick="setFilter(this)">Admins</button>
                    <button class="filter-btn" data-filter="cliente" onclick="setFilter(this)">Clientes</button>
                    <button class="filter-btn" data-filter="inativo" onclick="setFilter(this)">Inativos</button>
                </div>
            </div>

            <div class="table-card">
                <table class="data-table" id="usersTable">
                    <thead>
                        <tr>
                            <th>Usuário</th>
                            <th>Email</th>
                            <th>Perfil</th>
                            <th>Nascimento</th>
                            <th>Endereço</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">

                        @php
                        $usuarios = [
                            ['id'=>1, 'nome'=>'Lorem Ipsum', 'email'=>'lorem@carwell.com', 'perfil'=>'admin', 'nascimento'=>'12/03/1990', 'endereco'=>'Rua Lorem, 123 — SP', 'initials'=>'LI'],
                            ['id'=>2, 'nome'=>'Dolor Sit Amet', 'email'=>'dolor@carwell.com', 'perfil'=>'cliente', 'nascimento'=>'05/07/1995', 'endereco'=>'Av. Ipsum, 456 — RJ', 'initials'=>'DS'],
                            ['id'=>3, 'nome'=>'Consectetur Elit', 'email'=>'consec@carwell.com', 'perfil'=>'cliente', 'nascimento'=>'22/11/1988', 'endereco'=>'Rua Dolor, 789 — MG', 'initials'=>'CE'],
                            ['id'=>4, 'nome'=>'Adipiscing Tempor', 'email'=>'adip@carwell.com', 'perfil'=>'inativo', 'nascimento'=>'30/01/2000', 'endereco'=>'Rua Sit, 321 — RS', 'initials'=>'AT'],
                            ['id'=>5, 'nome'=>'Sed Do Eiusmod', 'email'=>'sed@carwell.com', 'perfil'=>'admin', 'nascimento'=>'14/06/1985', 'endereco'=>'Av. Amet, 654 — BA', 'initials'=>'SE'],
                            ['id'=>6, 'nome'=>'Ut Labore Dolore', 'email'=>'utlab@carwell.com', 'perfil'=>'cliente', 'nascimento'=>'09/09/1997', 'endereco'=>'Rua Elit, 987 — PR', 'initials'=>'UL'],
                        ];

                        $perfilClass = ['admin'=>'badge-green', 'cliente'=>'badge-blue', 'inativo'=>'badge-amber'];
                        $perfilLabel = ['admin'=>'Admin', 'cliente'=>'Cliente', 'inativo'=>'Inativo'];
                        @endphp

                        @foreach($usuarios as $u)
                        <tr data-perfil="{{ $u['perfil'] }}" data-search="{{ strtolower($u['nome'].' '.$u['email'].' '.$u['perfil']) }}">
                            <td>
                                <div class="user-cell">
                                    <div class="user-initials">{{ $u['initials'] }}</div>
                                    <span class="user-name">{{ $u['nome'] }}</span>
                                </div>
                            </td>
                            <td class="text-muted">{{ $u['email'] }}</td>
                            <td><span class="badge {{ $perfilClass[$u['perfil']] }}">{{ $perfilLabel[$u['perfil']] }}</span></td>
                            <td class="text-muted">{{ $u['nascimento'] }}</td>
                            <td class="text-muted">{{ $u['endereco'] }}</td>
                            <td>
                                <div class="row-actions">
                                    <button class="btn btn-secondary btn-sm" onclick="openEdit({{ $u['id'] }}, '{{ $u['nome'] }}', '{{ $u['email'] }}', '{{ $u['perfil'] }}', '{{ $u['nascimento'] }}', '{{ $u['endereco'] }}')">
                                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                        Editar
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="openDelete({{ $u['id'] }}, '{{ $u['nome'] }}')">
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

        <div class="modal-overlay" id="modal-create" onclick="closeOnBackdrop(event, 'create')">
            <div class="modal">
                <div class="modal-header">
                    <div>
                        <div class="modal-title">Novo usuário</div>
                        <div class="modal-subtitle">Preencha os dados do usuário</div>
                    </div>
                    <button class="modal-close" onclick="closeModal('create')">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="formCreate" enctype="multipart/form-data">
                        @csrf

                        <div class="avatar-upload" id="avatarUploadCreate">
                            <div class="avatar-preview" id="avatarPreviewCreate">
                                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            </div>
                            <div class="avatar-upload-info">
                                <div class="avatar-upload-label">Foto de perfil</div>
                                <div class="avatar-upload-hint">JPG ou PNG, máx. 2MB</div>
                                <label class="btn btn-secondary btn-sm" style="cursor:pointer;">
                                    Escolher foto
                                    <input type="file" name="foto" accept="image/*" style="display:none;" onchange="previewAvatar(event, 'avatarPreviewCreate')">
                                </label>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Nome completo *</label>
                                <input type="text" name="nome" class="form-control" placeholder="ex: João Silva">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email *</label>
                                <input type="email" name="email" class="form-control" placeholder="ex: joao@email.com">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Senha *</label>
                                <input type="password" name="senha" class="form-control" placeholder="••••••••">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Confirmar senha *</label>
                                <input type="password" name="senha_confirmation" class="form-control" placeholder="••••••••">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Data de nascimento</label>
                                <input type="date" name="nascimento" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Perfil</label>
                                <select name="perfil" class="form-control">
                                    <option value="cliente">Cliente</option>
                                    <option value="admin">Admin</option>
                                    <option value="inativo">Inativo</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Endereço</label>
                            <input type="text" name="endereco" class="form-control" placeholder="ex: Rua Lorem, 123 — São Paulo, SP">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" onclick="closeModal('create')">Cancelar</button>
                    <button class="btn btn-primary" onclick="document.getElementById('formCreate').submit()">
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                        Salvar usuário
                    </button>
                </div>
            </div>
        </div>

        <div class="modal-overlay" id="modal-edit" onclick="closeOnBackdrop(event, 'edit')">
            <div class="modal">
                <div class="modal-header">
                    <div>
                        <div class="modal-title">Editar usuário</div>
                        <div class="modal-subtitle" id="editSubtitle">Atualize os dados</div>
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

                        <div class="avatar-upload">
                            <div class="avatar-preview" id="avatarPreviewEdit">
                                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            </div>
                            <div class="avatar-upload-info">
                                <div class="avatar-upload-label">Foto de perfil</div>
                                <div class="avatar-upload-hint">JPG ou PNG, máx. 2MB</div>
                                <label class="btn btn-secondary btn-sm" style="cursor:pointer;">
                                    Trocar foto
                                    <input type="file" name="foto" accept="image/*" style="display:none;" onchange="previewAvatar(event, 'avatarPreviewEdit')">
                                </label>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Nome completo *</label>
                                <input type="text" name="nome" id="editNome" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email *</label>
                                <input type="email" name="email" id="editEmail" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Nova senha</label>
                                <input type="password" name="senha" class="form-control" placeholder="Deixe em branco para manter">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Confirmar nova senha</label>
                                <input type="password" name="senha_confirmation" class="form-control" placeholder="Deixe em branco para manter">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Data de nascimento</label>
                                <input type="date" name="nascimento" id="editNascimento" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Perfil</label>
                                <select name="perfil" id="editPerfil" class="form-control">
                                    <option value="cliente">Cliente</option>
                                    <option value="admin">Admin</option>
                                    <option value="inativo">Inativo</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Endereço</label>
                            <input type="text" name="endereco" id="editEndereco" class="form-control">
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
                        <div class="modal-title">Excluir usuário</div>
                        <div class="modal-subtitle">Esta ação não pode ser desfeita</div>
                    </div>
                    <button class="modal-close" onclick="closeModal('delete')">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="delete-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>
                    <p class="delete-msg">Tem certeza que deseja excluir <strong id="deleteNome"></strong>?</p>
                    <p class="delete-hint">O usuário será removido permanentemente da plataforma.</p>
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

            function openEdit(id, nome, email, perfil, nascimento, endereco) {
                document.getElementById('editId').value = id;
                document.getElementById('editNome').value = nome;
                document.getElementById('editEmail').value = email;
                document.getElementById('editPerfil').value = perfil;
                document.getElementById('editEndereco').value = endereco;
                document.getElementById('editSubtitle').textContent = nome;

                const parts = nascimento.split('/');
                if (parts.length === 3) {
                    document.getElementById('editNascimento').value = parts[2] + '-' + parts[1] + '-' + parts[0];
                }

                openModal('edit');
            }

            function openDelete(id, nome) {
                document.getElementById('deleteId').value = id;
                document.getElementById('deleteNome').textContent = nome;
                openModal('delete');
            }

            function previewAvatar(event, previewId) {
                const file = event.target.files[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = e => {
                    const wrap = document.getElementById(previewId);
                    wrap.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
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

            function filterRows() { applyFilters(); }

            function applyFilters() {
                const q = document.getElementById('searchInput').value.toLowerCase().trim();
                const rows = document.querySelectorAll('#tableBody tr');
                let visible = 0;

                rows.forEach(row => {
                    const matchFilter = currentFilter === 'all' || row.dataset.perfil === currentFilter;
                    const matchSearch = !q || row.dataset.search.includes(q);
                    const show = matchFilter && matchSearch;
                    row.style.display = show ? '' : 'none';
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
                    ['create', 'edit', 'delete'].forEach(closeModal);
                    document.body.style.overflow = '';
                }
            });
        </script>
    </body>
</html>