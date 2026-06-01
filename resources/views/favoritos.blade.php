<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Meus Favoritos — CarWell</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home/home.css') }}">
    <style>
      .fav-main       { max-width: 1200px; margin: 0 auto; padding: 56px 32px 80px; }
      .fav-header     { margin-bottom: 36px; }
      .fav-title      { font-family:'Syne',sans-serif; font-size:1.9rem; font-weight:800; color:#1a2e4a; }
      .fav-title span { color:#0F6E56; }
      .fav-sub        { font-size:0.82rem; color:#9EA19C; margin-top:4px; }
      #fav-grid       { display:grid; grid-template-columns:repeat(auto-fill,minmax(300px,1fr)); gap:24px; }
      .fav-empty      { text-align:center; padding:80px 0; color:#9EA19C; }
      .fav-empty svg  { width:56px; height:56px; margin-bottom:16px; display:block; margin-left:auto; margin-right:auto; }
      .fav-empty h3   { font-family:'Syne',sans-serif; font-size:0.9rem; font-weight:800; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:8px; color:#6b7280; }
      .fav-empty p    { font-size:0.82rem; }
      .fav-empty a    { display:inline-block; margin-top:20px; background:#0F6E56; color:#fff; font-family:'Syne',sans-serif; font-size:0.78rem; font-weight:800; text-transform:uppercase; letter-spacing:0.06em; padding:10px 24px; border-radius:8px; text-decoration:none; }
      .fav-loading    { text-align:center; padding:60px 0; font-size:0.85rem; color:#9EA19C; }
    </style>
  </head>
  <body>

    <nav class="main-nav">
      <div class="nav-left">
        <img src="{{ asset('img/logo.png') }}" alt="logo" class="nav-logo" />
      </div>
      <div class="nav-center">
        <div class="nav-links">
          <a href="{{ route('home') }}" class="nav-hover-btn">HOME</a>
          <a href="{{ route('home') }}#marcas" class="nav-hover-btn">COMPRAR CARRO</a>
          <a href="{{ route('home') }}#por-que" class="nav-hover-btn">SOBRE NÓS</a>
          <a href="{{ route('carrinho') }}" class="nav-hover-btn">CARRINHO</a>
          <a href="{{ route('favoritos') }}" class="nav-active nav-hover-btn">FAVORITOS <span id="fav-badge" style="display:none; background:#0F6E56; color:#fff; border-radius:999px; font-size:0.6rem; font-weight:800; padding:1px 6px; vertical-align:middle; margin-left:2px;"></span></a>
        </div>
      </div>
      <div class="nav-right-spacer"></div>
      <div class="nav-right">
        <span class="nav-flag">🇧🇷</span>
        @auth('cliente')
          <a href="{{ route('perfil') }}" class="nav-login">
            {{ explode(' ', Auth::guard('cliente')->user()->name)[0] }}
          </a>
        @else
          <a href="{{ route('login-cliente') }}" class="nav-login">LOGIN</a>
        @endauth
        <a href="{{ route('perfil') }}" class="nav-profile">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0F6E56" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
          </svg>
        </a>
        <div class="hamburger" onclick="toggleMenu()">
          <span></span><span></span><span></span>
        </div>
      </div>
    </nav>

    <main class="fav-main">
      <div class="fav-header">
        <h1 class="fav-title">Meus <span>Favoritos</span></h1>
        <p class="fav-sub">Veículos que você curtiu</p>
      </div>

      <div id="fav-loading" class="fav-loading">Carregando...</div>

      <div id="fav-empty" class="fav-empty" style="display:none;">
        <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
          <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
        </svg>
        <h3>Nenhum favorito ainda</h3>
        <p>Clique no coração dos carros que você curtir e eles aparecerão aqui.</p>
        <a href="{{ route('home') }}">Ver carros disponíveis</a>
      </div>

      <div id="fav-grid" style="display:none;"></div>
    </main>

    <script>
      const FAV_KEY    = 'carwell_favs';
      const STORAGE_URL = '{{ asset("storage/") }}';
      const POR_IDS_URL = '{{ route("carros.por-ids") }}';

      function getFavs()         { return JSON.parse(localStorage.getItem(FAV_KEY) || '[]'); }
      function saveFavs(favs)    { localStorage.setItem(FAV_KEY, JSON.stringify(favs)); }

      function toggleHeart(el, carroId) {
        el.classList.toggle('liked');
        let favs = getFavs();
        if (el.classList.contains('liked')) {
          if (!favs.includes(carroId)) favs.push(carroId);
        } else {
          favs = favs.filter(id => id !== carroId);
          // remove card from grid with animation
          const card = document.querySelector(`[data-fav-id="${carroId}"]`);
          if (card) {
            card.style.transition = 'opacity 0.25s, transform 0.25s';
            card.style.opacity = '0';
            card.style.transform = 'scale(0.95)';
            setTimeout(() => {
              card.remove();
              if (!document.querySelectorAll('#fav-grid .car-card').length) showEmpty();
            }, 260);
          }
        }
        saveFavs(favs);
        updateFavBadge();
      }

      function updateFavBadge() {
        const badge = document.getElementById('fav-badge');
        if (!badge) return;
        const count = getFavs().length;
        badge.textContent = count;
        badge.style.display = count ? 'inline-block' : 'none';
      }

      function showEmpty() {
        document.getElementById('fav-grid').style.display  = 'none';
        document.getElementById('fav-empty').style.display = 'block';
        updateFavBadge();
      }

      function fmtPreco(preco) {
        return 'R$ ' + parseFloat(preco).toLocaleString('pt-BR', {minimumFractionDigits:0, maximumFractionDigits:0});
      }

      function buildCard(c) {
        const nome = (c.nome || '').toUpperCase();
        const spec = [c.ano, c.combustivel ? c.combustivel.toUpperCase() : null, c.cambio ? c.cambio.toUpperCase() : null].filter(Boolean).join(' · ');
        const imgTag = c.capa_path
          ? `<img src="${STORAGE_URL}${c.capa_path}" alt="${nome}" class="car-img" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">`
          : '';
        const placeholderStyle = c.capa_path ? ' style="display:none"' : '';
        const placeholder = `<div class="car-img-placeholder"${placeholderStyle}><svg viewBox="0 0 120 70" fill="none"><path d="M15 45 Q30 18 60 18 Q90 18 105 45" stroke="#1e4d8c" stroke-width="3" fill="none" stroke-linecap="round"/><rect x="10" y="43" width="100" height="16" rx="8" fill="#1a2e4a" opacity="0.7"/><circle cx="28" cy="60" r="9" fill="#1a2e4a" opacity="0.7"/><circle cx="28" cy="60" r="5" fill="#c8daea"/><circle cx="92" cy="60" r="9" fill="#1a2e4a" opacity="0.7"/><circle cx="92" cy="60" r="5" fill="#c8daea"/></svg></div>`;
        const precoHtml = c.preco ? `<p class="car-price">${fmtPreco(c.preco)}</p>` : '';

        return `<a href="${c.url}" class="car-card" data-fav-id="${c.id}">
          ${imgTag}${placeholder}
          <div class="car-heart liked" data-id="${c.id}" onclick="event.preventDefault(); toggleHeart(this, ${c.id})">
            <svg viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
          </div>
          <div class="car-info">
            <p class="car-name">${nome}</p>
            <p class="car-spec">${spec}</p>
            ${precoHtml}
          </div>
          <div class="car-arrow">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
          </div>
        </a>`;
      }

      async function loadFavoritos() {
        const favs = getFavs();
        const loading = document.getElementById('fav-loading');
        const empty   = document.getElementById('fav-empty');
        const grid    = document.getElementById('fav-grid');

        if (!favs.length) {
          loading.style.display = 'none';
          empty.style.display   = 'block';
          updateFavBadge();
          return;
        }

        try {
          const params = favs.map(id => `ids[]=${id}`).join('&');
          const res    = await fetch(`${POR_IDS_URL}?${params}`);
          const carros = await res.json();

          loading.style.display = 'none';

          if (!carros.length) {
            empty.style.display = 'block';
            return;
          }

          // render in the same order as localStorage
          const map = Object.fromEntries(carros.map(c => [c.id, c]));
          grid.innerHTML = favs.filter(id => map[id]).map(id => buildCard(map[id])).join('');
          grid.style.display = 'grid';
          updateFavBadge();
        } catch(e) {
          loading.textContent = 'Erro ao carregar favoritos.';
        }
      }

      document.addEventListener('DOMContentLoaded', loadFavoritos);

      function toggleMenu() {
        const links = document.querySelector('.nav-links');
        if (links.style.display === 'flex') {
          links.style.display = 'none';
        } else {
          links.style.cssText = 'display:flex; flex-direction:column; position:absolute; top:60px; left:0; right:0; background:#fff; padding:20px 32px; gap:18px; box-shadow:0 8px 24px rgba(30,77,140,0.1); z-index:99;';
        }
      }
    </script>
  </body>
</html>
