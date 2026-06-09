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

  @include('partials._nav')

  <!-- HERO -->
  <section class="hero">
    <div class="hero-content">
      <h1 class="hero-title">{{ __('home.hero_titulo') }}<br><span>{{ __('home.hero_titulo_span') }}</span></h1>
      <p class="hero-desc">{{ __('home.hero_desc') }}</p>
    </div>
    <div class="hero-car">
      @if($destacados->count())
        {{-- Carrossel de destaques --}}
        {{-- outer: position:relative, sem overflow hidden (para as setas aparecerem) --}}
        <div class="hero-destaque-outer">

          {{-- inner: overflow:hidden para clipar o slide --}}
          <div class="hero-destaque-wrapper">
            <div class="hero-destaque-track" id="heroTrack">
              @foreach($destacados as $d)
              <a href="{{ route('carro.show', $d->id) }}" class="hero-destaque-card" draggable="false">
                @if($d->capa_path)
                  <img src="{{ storage_url($d->capa_path) }}" alt="{{ $d->veiculo_nome }}" class="hero-destaque-img" draggable="false">
                @endif
                <div class="hero-destaque-info">
                  <span class="hero-car-badge">⭐ Destaque</span>
                  <p class="hero-car-nome">{{ strtoupper($d->veiculo_nome) }}</p>
                  <p class="hero-car-preco">R$ {{ number_format($d->preco, 0, ',', '.') }}</p>
                </div>
              </a>
              @endforeach
            </div>
          </div>

          {{-- setas fora do overflow:hidden, posicionadas sobre a imagem --}}
          @if($destacados->count() > 1)
          <button class="hero-arrow hero-arrow-left" onclick="heroSlide(-1)">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
          </button>
          <button class="hero-arrow hero-arrow-right" onclick="heroSlide(1)">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
          </button>
          <div class="hero-dots" id="heroDots">
            @foreach($destacados as $i => $d)
            <button class="hero-dot {{ $i === 0 ? 'active' : '' }}" onclick="heroGoTo({{ $i }})"></button>
            @endforeach
          </div>
          @endif

        </div>

      @else
        <div style="width:360px; height:200px; background:linear-gradient(135deg,#0a4a38 0%,#0F6E56 100%); border-radius:24px; display:flex; flex-direction:column; align-items:center; justify-content:center; gap:12px; text-align:center; padding:24px;">
          <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.45)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <rect x="1" y="3" width="15" height="13" rx="1"/><path d="M16 8h4l3 3v5h-7V8z"/>
            <circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>
          </svg>
          <p style="font-family:'Syne',sans-serif; font-size:0.72rem; font-weight:800; text-transform:uppercase; letter-spacing:0.08em; color:rgba(255,255,255,0.65); margin:0;">Nenhum destaque no momento</p>
          <p style="font-size:0.72rem; color:rgba(255,255,255,0.35); margin:0;">Explore nosso catálogo completo</p>
          <a href="#marcas" style="margin-top:4px; padding:8px 20px; background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.2); border-radius:8px; font-family:'Syne',sans-serif; font-size:0.68rem; font-weight:800; text-transform:uppercase; letter-spacing:0.06em; color:#fff; text-decoration:none;">
            Ver todos os carros
          </a>
        </div>
      @endif
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
    <div class="brands-row" id="brands-row">
      @forelse($marcas as $marca)
      @php
        $params = $marcaSelecionada === $marca->nome
          ? array_filter(['busca' => $busca])
          : array_filter(['marca' => $marca->nome, 'busca' => $busca]);
        $href = route('home', $params) . '#marcas';
      @endphp
      <a href="{{ $href }}"
         class="brand-item {{ $marcaSelecionada === $marca->nome ? 'brand-item--active' : '' }}"
         title="{{ $marca->nome }}">
        <img src="{{ storage_url($marca->logo) }}" alt="{{ $marca->nome }}">
      </a>
      @empty
      <div class="brand-item" style="font-size:0.75rem; font-weight:700; color:#9EA19C;">Nenhuma marca cadastrada</div>
      @endforelse
    </div>
  </div>

  <!-- FILTER BAR -->
  <form class="filter-bar" method="GET" action="{{ route('home') }}">
    @if($marcaSelecionada)
      <input type="hidden" name="marca" value="{{ $marcaSelecionada }}">
    @endif
    <div class="filter-search">
      <input type="text" name="busca" value="{{ $busca }}" placeholder="{{ __('home.busca_modelo') }}" autocomplete="off"/>
      <button type="submit" class="filter-search-btn">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
      </button>
    </div>
    <div class="categoria-dropdown">
      <button type="button" class="filter-btn" onclick="toggleCategorias(this)">
        {{ $categoriaSelecionada ? strtoupper($categoriaSelecionada) : __('home.filtrar') }}
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
        </svg>
      </button>
      <div class="categoria-menu" id="categoriaMenu">
        @foreach([
          ''           => 'Todas as categorias',
          'esportivo'  => 'Esportivo',
          'suv'        => 'SUV',
          'sedan'      => 'Sedã',
          'hatchback'  => 'Hatchback',
          'pickup'     => 'Pickup',
          'offroad'    => 'Off-road',
          'vintage'    => 'Vintage',
          'luxo'       => 'Luxo',
          'eletrico'   => 'Elétrico',
        ] as $val => $label)
        <a href="{{ route('home', array_filter(['busca' => $busca, 'marca' => $marcaSelecionada, 'categoria' => $val])) }}"
           class="categoria-item {{ $categoriaSelecionada === $val ? 'active' : '' }}">
          {{ $label }}
        </a>
        @endforeach
      </div>
    </div>
  </form>

  <!-- CAR CARDS -->
  <div class="cars-grid">

    @forelse($carros as $carro)
    <a href="{{ route('carro.show', $carro->id) }}" class="car-card">

      @if($carro->capa_path)
        <img src="{{ storage_url($carro->capa_path) }}"
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
    document.querySelector('.filter-bar').addEventListener('submit', function (e) {
      e.preventDefault();
      const params = new URLSearchParams(new FormData(this)).toString();
      window.location.href = '{{ route("home") }}' + (params ? '?' + params : '') + '#marcas';
    });

    function toggleCategorias(btn) {
      const menu = document.getElementById('categoriaMenu');
      const open = menu.classList.toggle('open');
      btn.classList.toggle('active', open);
      if (open) {
        document.addEventListener('click', function close(e) {
          if (!menu.closest('.categoria-dropdown').contains(e.target)) {
            menu.classList.remove('open');
            btn.classList.remove('active');
            document.removeEventListener('click', close);
          }
        });
      }
    }

    // Carrossel de destaques
    const heroTotal = document.querySelectorAll('.hero-destaque-card').length;
    if (heroTotal > 0) {
      const heroDots = document.querySelectorAll('.hero-dot');
      let heroIndex  = 0;

      function heroGoTo(n) {
        heroIndex = (n + heroTotal) % heroTotal;
        document.getElementById('heroTrack').style.transform = `translateX(-${heroIndex * 100}%)`;
        heroDots.forEach((d, i) => d.classList.toggle('active', i === heroIndex));
      }
      function heroSlide(dir) { heroGoTo(heroIndex + dir); }

      if (heroTotal > 1) setInterval(() => heroSlide(1), 5000);
    }

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
      badge.style.display = count ? 'flex' : 'none';
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

  @include('partials._footer')
  @include('partials._cookies')
</body>
</html>
