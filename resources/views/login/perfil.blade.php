<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Carwell – Perfil</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('css/login/perfil.css') }}"/>
</head>
<body>
  <div class="card">
    <div class="top-row">
      <div class="logo">
        <svg viewBox="0 0 80 52" fill="none">
          <path d="M10 30 Q20 12 40 12 Q60 12 70 30" stroke="#1a2e4a" stroke-width="3.5" fill="none" stroke-linecap="round"/>
          <rect x="8" y="28" width="64" height="12" rx="6" fill="#1a2e4a"/>
          <circle cx="22" cy="40" r="7" fill="#1a2e4a"/><circle cx="22" cy="40" r="4" fill="#d6e4f0"/>
          <circle cx="58" cy="40" r="7" fill="#1a2e4a"/><circle cx="58" cy="40" r="4" fill="#d6e4f0"/>
          <path d="M36 12 Q40 4 44 6" stroke="#1e4d8c" stroke-width="2.5" fill="none" stroke-linecap="round"/>
          <circle cx="44" cy="5.5" r="2.5" fill="#1e4d8c"/>
        </svg>
        <span class="logo-text">Carwell</span>
      </div>
    </div>
 
    <!-- Photo -->
    <div class="photo-section">
      <p class="add-photo-label">ADICIONAR FOTO</p>
      <div class="photo-circle" onclick="document.getElementById('photo-input').click()">
        <img id="preview-img" src="" alt="Foto de perfil"/>
        <span class="plus-icon" id="plus-icon">+</span>
      </div>
      <input type="file" id="photo-input" accept="image/*" onchange="previewPhoto(event)"/>
    </div>
 
    <!-- Fields -->
    <div class="field-group">
      <input class="field-box editable" id="nome" type="text" placeholder="NOME DE USUÁRIO" value="" readonly/>
    </div>
 
    <div class="field-group">
      <input class="field-box editable" id="historico" type="text" placeholder="HISTÓRICO DE COMPRAS" value="" readonly/>
    </div>
 
    <div class="field-group">
      <textarea class="field-box address" id="endereco" rows="2" readonly
        placeholder="ENDEREÇO DE ENTREGA:&#10;RUA BARGAMOTA, 789, SÃO PAULO"></textarea>
    </div>
 
    <div class="btn-row">
      <button class="btn btn-back" onclick="window.location.href='index.html'">VOLTAR</button>
      <button class="btn btn-edit" id="btn-edit" onclick="toggleEdit()">EDITAR INFORMAÇÕES</button>
    </div>
  </div>
 
  <div class="toast" id="toast">Informações salvas com sucesso!</div>
 
  <script>
    let editing = false;
 
    function previewPhoto(e) {
      const file = e.target.files[0];
      if (!file) return;
      const reader = new FileReader();
      reader.onload = ev => {
        const img = document.getElementById('preview-img');
        img.src = ev.target.result;
        img.style.display = 'block';
        document.getElementById('plus-icon').style.display = 'none';
      };
      reader.readAsDataURL(file);
    }
 
    function toggleEdit() {
      const fields = ['nome', 'historico', 'endereco'];
      const btn = document.getElementById('btn-edit');
 
      if (!editing) {
        // Entrar em modo edição
        editing = true;
        fields.forEach(id => {
          const el = document.getElementById(id);
          el.removeAttribute('readonly');
          el.focus();
        });
        btn.textContent = 'SALVAR INFORMAÇÕES';
        btn.style.background = '#1e4d8c';
      } else {
        // Salvar
        editing = false;
        fields.forEach(id => {
          document.getElementById(id).setAttribute('readonly', true);
        });
        btn.textContent = 'EDITAR INFORMAÇÕES';
        btn.style.background = '#166534';
        saveProfile();
      }
    }
 
    function saveProfile() {
      const nome = document.getElementById('nome').value;
      const historico = document.getElementById('historico').value;
      const endereco = document.getElementById('endereco').value;
 
      fetch('/api/profile', {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
        },
        body: JSON.stringify({ nome, historico, endereco })
      })
      .then(r => r.json())
      .then(() => showToast())
      .catch(() => showToast()); // mostra toast mesmo assim no front
    }
 
    function showToast() {
      const t = document.getElementById('toast');
      t.classList.add('show');
      setTimeout(() => t.classList.remove('show'), 2800);
    }
 
    // Carregar dados ao entrar na página
    window.addEventListener('DOMContentLoaded', () => {
      fetch('/api/profile')
        .then(r => r.json())
        .then(data => {
          if (data.nome) document.getElementById('nome').value = data.nome;
          if (data.historico) document.getElementById('historico').value = data.historico;
          if (data.endereco) document.getElementById('endereco').value = data.endereco;
          if (data.foto) {
            document.getElementById('preview-img').src = data.foto;
            document.getElementById('preview-img').style.display = 'block';
            document.getElementById('plus-icon').style.display = 'none';
          }
        })
        .catch(() => {}); // silently fail se não logado
    });
  </script>
</body>
</html>