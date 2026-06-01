<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>{{ __('home.titulo') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home/home.css') }}">
  </head>
<body>

  <!-- NAV-BAR -->
  <nav class="main-nav">
    <div class="nav-left">
      <img src="{{ asset('img/logo.png') }}" alt="logo" class="nav-logo" />
    </div>

    <div class="nav-center">
      <div class="nav-links">
          <a href="{{ route('home') }}" class="nav-active nav-hover-btn">{{ __('nav.home') }}</a>
          <a href="#marcas" class="nav-hover-btn">{{ __('nav.comprar') }}</a>
          <a href="#por-que" class="nav-hover-btn">{{ __('nav.sobre') }}</a>

          <a href="{{ route('carrinho') }}" class="nav-hover-btn">{{ __('nav.carrinho') }}</a>
          <a href="{{ route('favoritos') }}" class="nav-hover-btn" id="nav-favoritos">FAVORITOS <span id="fav-badge" style="display:none; background:#0F6E56; color:#fff; border-radius:999px; font-size:0.6rem; font-weight:800; padding:1px 6px; vertical-align:middle; margin-left:2px;"></span></a>
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
        <a href="{{ route('login-cliente') }}" class="nav-login">{{ __('nav.login') }}</a>
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

  <!-- HERO -->
  <section class="hero">
    <div class="hero-content">
      <h1 class="hero-title">{{ __('home.hero_titulo') }}<br><span>{{ __('home.hero_titulo_span') }}</span></h1>
      <p class="hero-desc">{{ __('home.hero_desc') }}</p>
      <div class="hero-search">
        <input type="text" placeholder="{{ __('home.hero_busca') }}"/>
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
      </div>
    </div>
    <div class="hero-car">
      <button class="carousel-btn left">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
      </button>
      <a href="{{ route('info-carro') }}" class="hero-car-placeholder">
        <svg width="160" height="80" viewBox="0 0 200 90" fill="none">
          <path d="M20 60 Q40 25 100 25 Q160 25 180 60" stroke="rgba(255,255,255,0.7)" stroke-width="4" fill="none" stroke-linecap="round"/>
          <rect x="10" y="57" width="180" height="22" rx="11" fill="rgba(255,255,255,0.7)"/>
          <circle cx="45" cy="82" r="14" fill="rgba(255,255,255,0.5)"/><circle cx="45" cy="82" r="8" fill="rgba(255,255,255,0.8)"/>
          <circle cx="155" cy="82" r="14" fill="rgba(255,255,255,0.5)"/><circle cx="155" cy="82" r="8" fill="rgba(255,255,255,0.8)"/>
          <rect x="60" y="30" width="80" height="28" rx="6" fill="rgba(255,255,255,0.15)"/>
        </svg>
      </a>
      <button class="carousel-btn right">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
      </button>
    </div>
  </section>

  <!-- WHY CARWELL -->
  <section class="section" id="por-que">
    <h2 class="section-title">{{ __('home.por_que') }}</h2>
    <div class="features-grid">
      <div class="feature-card">
        <div class="feature-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
          </svg>
        </div>
        <p class="feature-title">{{ __('home.garantia_titulo') }}</p>
        <p class="feature-desc">{{ __('home.garantia_desc') }}</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
          </svg>
        </div>
        <p class="feature-title">{{ __('home.test_drive_titulo') }}</p>
        <p class="feature-desc">{{ __('home.test_drive_desc') }}</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
          </svg>
        </div>
        <p class="feature-title">{{ __('home.financiamento_titulo') }}</p>
        <p class="feature-desc">{{ __('home.financiamento_desc') }}</p>
      </div>
    </div>
  </section>

  <!-- BRANDS -->
  <div class="brands-section" id="marcas">
    <h2 class="section-title">{{ __('home.marcas') }}</h2>
    <div style="display:flex; align-items:center; gap:10px;">
      <div class="brands-row" id="brands-row">
        @forelse($marcas as $marca)
        <div class="brand-item" title="{{ $marca->nome }}">
          <img src="{{ asset("storage/{$marca->logo}") }}" alt="{{ $marca->nome }}" style="max-height:36px; max-width:72px; object-fit:contain;">
        </div>
        @empty
        <div class="brand-item" style="font-size:0.75rem; font-weight:700; color:#9EA19C;">Nenhuma marca cadastrada</div>
        @endforelse
      </div>
      <div class="brands-arrow">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#1a2e4a" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
      </div>
    </div>
  </div>

  <!-- FILTER BAR -->
  <div class="filter-bar">
    <div class="filter-search">
      <input type="text" placeholder="{{ __('home.busca_modelo') }}"/>
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
      </svg>
    </div>
    <button class="filter-btn">
      {{ __('home.filtrar') }}
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
      </svg>
    </button>
  </div>

  <!-- CAR CARDS -->
  <div class="cars-grid">

    @forelse($carros as $carro)
    <a href="{{ route('carro.show', $carro->id) }}" class="car-card">

      @if($carro->capa_path)
        <img src="{{ asset('storage/' . $carro->capa_path) }}"
             alt="{{ $carro->veiculo_nome }}"
             class="car-img"
             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
        <div class="car-img-placeholder" style="display:none">
          <svg viewBox="0 0 120 70" fill="none"><path d="M15 45 Q30 18 60 18 Q90 18 105 45" stroke="#1e4d8c" stroke-width="3" fill="none" stroke-linecap="round"/><rect x="10" y="43" width="100" height="16" rx="8" fill="#1a2e4a" opacity="0.7"/><circle cx="28" cy="60" r="9" fill="#1a2e4a" opacity="0.7"/><circle cx="28" cy="60" r="5" fill="#c8daea"/><circle cx="92" cy="60" r="9" fill="#1a2e4a" opacity="0.7"/><circle cx="92" cy="60" r="5" fill="#c8daea"/></svg>
        </div>
      @else
        <div class="car-img-placeholder">
          <svg viewBox="0 0 120 70" fill="none"><path d="M15 45 Q30 18 60 18 Q90 18 105 45" stroke="#1e4d8c" stroke-width="3" fill="none" stroke-linecap="round"/><rect x="10" y="43" width="100" height="16" rx="8" fill="#1a2e4a" opacity="0.7"/><circle cx="28" cy="60" r="9" fill="#1a2e4a" opacity="0.7"/><circle cx="28" cy="60" r="5" fill="#c8daea"/><circle cx="92" cy="60" r="9" fill="#1a2e4a" opacity="0.7"/><circle cx="92" cy="60" r="5" fill="#c8daea"/></svg>
        </div>
      @endif

      <div class="car-heart" data-id="{{ $carro->id }}" onclick="event.preventDefault(); toggleHeart(this, {{ $carro->id }})">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
        </svg>
      </div>
      <div class="car-info">
        <p class="car-name">{{ strtoupper($carro->veiculo_nome) }}</p>
        <p class="car-spec">
          {{ $carro->ano }}{{ $carro->combustivel ? ' · ' . strtoupper($carro->combustivel) : '' }}{{ $carro->cambio ? ' · ' . strtoupper($carro->cambio) : '' }}
        </p>
        @if($carro->preco)
          <p class="car-price">R$ {{ number_format($carro->preco, 0, ',', '.') }}</p>
        @endif
      </div>
      <div class="car-arrow">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
      </div>
    </a>
    @empty
    <div style="grid-column: 1/-1; text-align:center; padding: 60px 0; color: #9EA19C;">
      <p style="font-family:'Syne',sans-serif; font-size:0.9rem; font-weight:800; text-transform:uppercase; letter-spacing:0.06em;">Nenhum veículo disponível no momento</p>
    </div>
    @endforelse

  </div>

  <script>
    const FAV_KEY = 'carwell_favs';

    function getFavs() {
      return JSON.parse(localStorage.getItem(FAV_KEY) || '[]');
    }
    function saveFavs(favs) {
      localStorage.setItem(FAV_KEY, JSON.stringify(favs));
    }

    function toggleHeart(el, carroId) {
      el.classList.toggle('liked');
      let favs = getFavs();
      if (el.classList.contains('liked')) {
        if (!favs.includes(carroId)) favs.push(carroId);
      } else {
        favs = favs.filter(id => id !== carroId);
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

    document.addEventListener('DOMContentLoaded', () => {
      const favs = getFavs();
      document.querySelectorAll('.car-heart[data-id]').forEach(el => {
        if (favs.includes(parseInt(el.dataset.id))) el.classList.add('liked');
      });
      updateFavBadge();
    });

    function toggleMenu() {
      // mobile menu toggle placeholder
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
