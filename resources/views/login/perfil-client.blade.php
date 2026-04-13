<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Carwell – Perfil</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --bg: #d6e4f0;
      --card-bg: #dce8f3;
      --dark-navy: #1a2e4a;
      --red: #b91c1c;
      --green: #166534;
      --blue: #1e4d8c;
      --input-bg: #c8daea;
      --input-border: #b0c8de;
      --text-muted: #4a6280;
      --font-main: 'Montserrat', sans-serif;
      --font-body: 'Open Sans', sans-serif;
    }
    body {
      min-height: 100vh;
      background: var(--bg);
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: var(--font-body);
      padding: 24px;
    }
    .card {
      background: var(--card-bg);
      border-radius: 20px;
      padding: 32px 36px 28px;
      width: 100%;
      max-width: 480px;
      box-shadow: 0 8px 40px rgba(30,77,140,0.10);
    }
    .top-row {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      margin-bottom: 8px;
    }
    .logo {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .logo svg { width: 48px; height: 33px; }
    .logo-text {
      font-family: var(--font-main);
      font-size: 1.5rem;
      font-weight: 800;
      color: var(--dark-navy);
    }
 
    /* PHOTO */
    .photo-section {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-bottom: 24px;
    }
    .add-photo-label {
      font-family: var(--font-main);
      font-size: 0.7rem;
      font-weight: 700;
      color: var(--dark-navy);
      text-transform: uppercase;
      letter-spacing: 0.08em;
      margin-bottom: 10px;
    }
    .photo-circle {
      width: 90px; height: 90px;
      border-radius: 50%;
      background: var(--input-bg);
      border: 2px dashed var(--input-border);
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      overflow: hidden;
      transition: border-color 0.2s, background 0.2s;
      position: relative;
    }
    .photo-circle:hover { border-color: var(--blue); background: #b8d4e8; }
    .photo-circle img {
      width: 100%; height: 100%;
      object-fit: cover;
      display: none;
      position: absolute;
    }
    .plus-icon {
      font-size: 2.2rem;
      font-weight: 300;
      color: var(--dark-navy);
      line-height: 1;
      user-select: none;
    }
    #photo-input { display: none; }
 
    /* FIELDS */
    .field-group {
      margin-bottom: 14px;
    }
    .field-box {
      background: var(--input-bg);
      border: 1.5px solid var(--input-border);
      border-radius: 12px;
      padding: 14px 18px;
      font-family: var(--font-main);
      font-size: 0.8rem;
      font-weight: 700;
      color: var(--dark-navy);
      text-transform: uppercase;
      letter-spacing: 0.06em;
      width: 100%;
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
      cursor: default;
    }
    .field-box.editable {
      cursor: text;
    }
    .field-box.editable:focus {
      border-color: var(--blue);
      box-shadow: 0 0 0 3px rgba(30,77,140,0.12);
      cursor: text;
    }
    .field-box::placeholder { color: var(--dark-navy); opacity: 0.6; }
 
    /* Address has smaller text */
    .field-box.address {
      font-size: 0.72rem;
      line-height: 1.5;
    }
 
    /* BUTTONS */
    .btn-row {
      display: flex;
      gap: 16px;
      margin-top: 24px;
    }
    .btn {
      flex: 1;
      padding: 14px 10px;
      border: none;
      border-radius: 30px;
      font-family: var(--font-main);
      font-size: 0.88rem;
      font-weight: 800;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      cursor: pointer;
      transition: filter 0.18s, transform 0.15s;
    }
    .btn:hover { filter: brightness(1.1); transform: translateY(-1px); }
    .btn:active { transform: translateY(0); }
    .btn-back { background: var(--red); color: #fff; }
    .btn-edit { background: #166534; color: #fff; }
 
    /* Toast */
    .toast {
      position: fixed;
      bottom: 28px; left: 50%;
      transform: translateX(-50%) translateY(20px);
      background: #166534;
      color: white;
      font-family: var(--font-main);
      font-size: 0.8rem;
      font-weight: 700;
      padding: 12px 28px;
      border-radius: 30px;
      opacity: 0;
      transition: opacity 0.3s, transform 0.3s;
      pointer-events: none;
      z-index: 999;
    }
    .toast.show { opacity: 1; transform: translateX(-50%) translateY(0); }
 
    @media (max-width: 480px) {
      .card { padding: 24px 18px 22px; }
    }
  </style>
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