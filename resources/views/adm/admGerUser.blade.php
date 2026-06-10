<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CarWell — {{ __('adm.usr_titulo') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/adm/admGerUser.css') }}">
</head>
<body>

    <nav class="main-nav">
        <div class="nav-left">
            <img src="{{ asset('img/logo.png') }}" alt="logo" class="nav-logo">
        </div>
        <div class="nav-center">
            <div class="nav-links">
                <a href="{{ route('adm.dashboard') }}" class="nav-hover-btn">{{ __('adm.dashboard') }}</a>
                <a href="{{ route('adm.carros.index') }}" class="nav-hover-btn">{{ __('adm.carros') }}</a>
                <a href="{{ route('adm.pedidos.index') }}" class="nav-hover-btn">{{ __('adm.pedidos') }}</a>
                <a href="{{ route('adm.usuarios.index') }}" class="nav-active nav-hover-btn">{{ __('adm.clientes') }}</a>
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
                <strong>{{ __('adm.usr_erro_salvar') }}</strong>
                <ul style="margin:8px 0 0 18px;">
                    @foreach($errors->all() as $msg)<li>{{ $msg }}</li>@endforeach
                </ul>
            </div>
            <script>window.addEventListener('DOMContentLoaded',()=>openModal('create'));</script>
        @endif

        <div class="page-header">
            <div>
                <h1 class="page-title">{{ __('adm.usr_titulo') }}</h1>
                <p class="page-subtitle">{{ __('adm.usr_subtitulo') }}</p>
            </div>
            <button class="btn btn-primary" onclick="openModal('create')">
                <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                {{ __('adm.usr_add') }}
            </button>
        </div>

        <div class="kpi-grid">
            <div class="kpi-card">
                <div class="kpi-label">Total</div>
                <div class="kpi-value">{{ $kpis['total'] ?? 0 }}</div>
                <div class="kpi-foot">usuários cadastrados</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-label">Admins</div>
                <div class="kpi-value green">{{ $kpis['admin'] ?? 0 }}</div>
                <div class="kpi-foot">com acesso total</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-label">Clientes</div>
                <div class="kpi-value blue">{{ $kpis['cliente'] ?? 0 }}</div>
                <div class="kpi-foot">contas ativas</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-label">Inativos</div>
                <div class="kpi-value amber">{{ $kpis['inativo'] ?? 0 }}</div>
                <div class="kpi-foot">sem acesso</div>
            </div>
        </div>

        <form class="toolbar" method="GET" action="{{ route('adm.usuarios.index') }}">
            @if($perfil && $perfil !== 'all')
                <input type="hidden" name="perfil" value="{{ $perfil }}">
            @endif
            <div class="search-wrap">
                <svg class="search-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input type="text" class="search-input" name="q" value="{{ $q }}" placeholder="Buscar nome, email ou perfil...">
            </div>
            <div class="filter-group">
                <a href="{{ route('adm.usuarios.index', array_filter(['q' => $q])) }}" class="filter-btn {{ $perfil === 'all' ? 'active' : '' }}" style="text-decoration:none;">Todos</a>
                <a href="{{ route('adm.usuarios.index', array_filter(['perfil' => 'admin', 'q' => $q])) }}" class="filter-btn {{ $perfil === 'admin' ? 'active' : '' }}" style="text-decoration:none;">Admins</a>
                <a href="{{ route('adm.usuarios.index', array_filter(['perfil' => 'cliente', 'q' => $q])) }}" class="filter-btn {{ $perfil === 'cliente' ? 'active' : '' }}" style="text-decoration:none;">Clientes</a>
                <a href="{{ route('adm.usuarios.index', array_filter(['perfil' => 'inativo', 'q' => $q])) }}" class="filter-btn {{ $perfil === 'inativo' ? 'active' : '' }}" style="text-decoration:none;">Inativos</a>
            </div>
        </form>

        <div class="table-card">
            <table class="data-table">
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
                        $perfilClass = ['admin'=>'badge-green','cliente'=>'badge-blue','inativo'=>'badge-amber'];
                        $perfilLabel = ['admin'=>'Admin','cliente'=>'Cliente','inativo'=>'Inativo'];
                    @endphp

                    @forelse($clientes as $u)
                    @php
                        $parts    = preg_split('/\s+/', trim($u->name ?? '')) ?: [];
                        $initials = strtoupper(substr($parts[0]??'',0,1).substr($parts[1]??'',0,1));
                        $nascBr   = $u->nascimento ? $u->nascimento->format('d/m/Y') : '';
                    @endphp
                    <tr>
                        <td>
                            <div class="user-cell">
                                @if($u->foto)
                                    <img src="{{ storage_url($u->foto) }}" style="width:32px;height:32px;border-radius:50%;object-fit:cover;">
                                @else
                                    <div class="user-initials">{{ $initials ?: '—' }}</div>
                                @endif
                                <span class="user-name">{{ $u->name }}</span>
                            </div>
                        </td>
                        <td class="text-muted">{{ $u->email }}</td>
                        <td><span class="badge {{ $perfilClass[$u->perfil ?? 'cliente'] ?? 'badge-blue' }}">{{ $perfilLabel[$u->perfil ?? 'cliente'] ?? $u->perfil }}</span></td>
                        <td class="text-muted">{{ $nascBr ?: '—' }}</td>
                        <td class="text-muted">{{ $u->endereco ?: '—' }}</td>
                        <td>
                            <div class="row-actions">
                                <button class="btn btn-secondary btn-sm"
                                    data-user="{{ json_encode(['id'=>$u->id,'nome'=>$u->name??'','email'=>$u->email??'','perfil'=>$u->perfil??'cliente','nascimento'=>$nascBr,'telefone'=>$u->telefone??'','cep'=>$u->cep??'','rua'=>$u->rua??'','bairro'=>$u->bairro??'','cidade'=>$u->cidade??'','estado'=>$u->estado??'','numero'=>$u->numero??'','complemento'=>$u->complemento??'','ponto_referencia'=>$u->ponto_referencia??'']) }}"
                                    onclick="openEdit(this)">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    Editar
                                </button>
                                <button class="btn btn-danger btn-sm"
                                    onclick="openDelete({{ $u->id }}, '{{ addslashes($u->name ?? '') }}')">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/></svg>
                                    Excluir
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align:center;color:#9EA19C;padding:2rem;">
                            @if($q || $perfil !== 'all')
                                Nenhum resultado. <a href="{{ route('adm.usuarios.index') }}" style="color:#0F6E56;">Limpar filtros</a>
                            @else
                                Nenhum usuário cadastrado
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

    </main>

    <div class="modal-overlay" id="modal-create" onclick="closeOnBackdrop(event,'create')">
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
                <form action="{{ route('adm.usuarios.store') }}" method="POST" id="formCreate" enctype="multipart/form-data">
                    @csrf

                    <div class="avatar-upload">
                        <div class="avatar-preview" id="avatarPreviewCreate">
                            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </div>
                        <div class="avatar-upload-info">
                            <div class="avatar-upload-label">Foto de perfil</div>
                            <div class="avatar-upload-hint">JPG ou PNG, máx. 2MB</div>
                            <label class="btn btn-secondary btn-sm" style="cursor:pointer;">
                                Escolher foto
                                <input type="file" name="foto" accept="image/*" style="display:none;" onchange="previewAvatar(event,'avatarPreviewCreate')">
                            </label>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Nome completo *</label>
                            <input type="text" name="name" class="form-control" placeholder="ex: João Silva" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email *</label>
                            <input type="email" name="email" class="form-control" placeholder="ex: joao@email.com" value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Telefone</label>
                            <input type="text" name="telefone" class="form-control" placeholder="(11) 99999-9999" value="{{ old('telefone') }}" oninput="maskTelefone(this)">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Data de nascimento</label>
                            <input type="date" name="nascimento" class="form-control" value="{{ old('nascimento') }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Senha *</label>
                            <input type="password" name="password" class="form-control" placeholder="••••••••">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Confirmar senha *</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Perfil</label>
                            <select name="perfil" class="form-control">
                                <option value="cliente" {{ old('perfil','cliente')=='cliente'?'selected':'' }}>Cliente</option>
                                <option value="admin"   {{ old('perfil')=='admin'?'selected':'' }}>Admin</option>
                                <option value="inativo" {{ old('perfil')=='inativo'?'selected':'' }}>Inativo</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Endereço</label>
                            <input type="text" name="endereco" class="form-control" placeholder="Rua, nº — Cidade, UF" value="{{ old('endereco') }}">
                        </div>
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

    <div class="modal-overlay" id="modal-edit" onclick="closeOnBackdrop(event,'edit')">
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

                    <div class="avatar-upload">
                        <div class="avatar-preview" id="avatarPreviewEdit">
                            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </div>
                        <div class="avatar-upload-info">
                            <div class="avatar-upload-label">Foto de perfil</div>
                            <div class="avatar-upload-hint">JPG ou PNG, máx. 2MB</div>
                            <label class="btn btn-secondary btn-sm" style="cursor:pointer;">
                                Trocar foto
                                <input type="file" name="foto" accept="image/*" style="display:none;" onchange="previewAvatar(event,'avatarPreviewEdit')">
                            </label>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Nome completo *</label>
                            <input type="text" name="name" id="editNome" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email *</label>
                            <input type="email" name="email" id="editEmail" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Telefone</label>
                            <input type="text" name="telefone" id="editTelefone" class="form-control" placeholder="(11) 99999-9999" oninput="maskTelefone(this)">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Data de nascimento</label>
                            <input type="date" name="nascimento" id="editNascimento" class="form-control">
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
                            <label class="form-label">Perfil</label>
                            <select name="perfil" id="editPerfil" class="form-control">
                                <option value="cliente">Cliente</option>
                                <option value="admin">Admin</option>
                                <option value="inativo">Inativo</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">CEP</label>
                            <input type="text" name="cep" id="editCep" class="form-control" maxlength="9" placeholder="00000-000">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group" style="flex:2">
                            <label class="form-label">Rua / Avenida</label>
                            <input type="text" name="rua" id="editRua" class="form-control">
                        </div>
                        <div class="form-group" style="flex:1">
                            <label class="form-label">Número</label>
                            <input type="text" name="numero" id="editNumero" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Bairro</label>
                            <input type="text" name="bairro" id="editBairro" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Cidade</label>
                            <input type="text" name="cidade" id="editCidade" class="form-control">
                        </div>
                        <div class="form-group" style="max-width:80px">
                            <label class="form-label">UF</label>
                            <input type="text" name="estado" id="editEstado" class="form-control" maxlength="2">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Complemento</label>
                            <input type="text" name="complemento" id="editComplemento" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Ponto de Referência</label>
                            <input type="text" name="ponto_referencia" id="editPontoRef" class="form-control">
                        </div>
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

    <div class="modal-overlay" id="modal-delete" onclick="closeOnBackdrop(event,'delete')">
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
        function maskTelefone(input) {
            let v = input.value.replace(/\D/g, '').slice(0, 11);
            if (v.length > 10) {
                v = '(' + v.slice(0,2) + ') ' + v.slice(2,7) + '-' + v.slice(7);
            } else if (v.length > 6) {
                v = '(' + v.slice(0,2) + ') ' + v.slice(2,6) + '-' + v.slice(6);
            } else if (v.length > 2) {
                v = '(' + v.slice(0,2) + ') ' + v.slice(2);
            } else if (v.length > 0) {
                v = '(' + v;
            }
            input.value = v;
        }

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

        function openEdit(btn) {
            const u = JSON.parse(btn.dataset.user);
            document.getElementById('editNome').value        = u.nome        || '';
            document.getElementById('editEmail').value       = u.email       || '';
            document.getElementById('editPerfil').value      = u.perfil      || 'cliente';
            document.getElementById('editTelefone').value    = u.telefone    || '';
            document.getElementById('editCep').value         = u.cep         || '';
            document.getElementById('editRua').value         = u.rua         || '';
            document.getElementById('editNumero').value      = u.numero      || '';
            document.getElementById('editBairro').value      = u.bairro      || '';
            document.getElementById('editCidade').value      = u.cidade      || '';
            document.getElementById('editEstado').value      = u.estado      || '';
            document.getElementById('editComplemento').value = u.complemento || '';
            document.getElementById('editPontoRef').value    = u.ponto_referencia || '';
            document.getElementById('editSubtitle').textContent = u.nome;
            const parts = (u.nascimento || '').split('/');
            if(parts.length===3) document.getElementById('editNascimento').value = parts[2]+'-'+parts[1]+'-'+parts[0];
            document.getElementById('formEdit').action = "{{ url('/adm/usuarios') }}/" + u.id;
            openModal('edit');
        }

        function openDelete(id, nome) {
            document.getElementById('deleteNome').textContent = nome;
            document.getElementById('formDelete').action = "{{ url('/adm/usuarios') }}/" + id;
            openModal('delete');
        }

        function previewAvatar(event, previewId) {
            const file = event.target.files[0];
            if(!file) return;
            const reader = new FileReader();
            reader.onload = e => {
                const wrap = document.getElementById(previewId);
                wrap.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
            };
            reader.readAsDataURL(file);
        }

        document.addEventListener('keydown',e=>{ if(e.key==='Escape'){['create','edit','delete'].forEach(closeModal);document.body.style.overflow='';} });
    </script>
</body>
</html>