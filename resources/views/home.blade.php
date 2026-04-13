<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Carwell – Encontre seu Carro</title>
  <link rel="stylesheet" href="{{ asset('css/home/home.css') }}">
</head>
<body>

  <!-- NAV -->
  <nav>
    <a class="nav-logo" href="#">
      <svg viewBox="0 0 80 52" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M10 30 Q20 12 40 12 Q60 12 70 30" stroke="#1a2e4a" stroke-width="3.5" fill="none" stroke-linecap="round"/>
        <rect x="8" y="28" width="64" height="12" rx="6" fill="#1a2e4a"/>
        <circle cx="22" cy="40" r="7" fill="#1a2e4a"/><circle cx="22" cy="40" r="4" fill="#f0f6fb"/>
        <circle cx="58" cy="40" r="7" fill="#1a2e4a"/><circle cx="58" cy="40" r="4" fill="#f0f6fb"/>
        <path d="M36 12 Q40 4 44 6" stroke="#1e4d8c" stroke-width="2.5" fill="none" stroke-linecap="round"/>
        <circle cx="44" cy="5.5" r="2.5" fill="#1e4d8c"/>
      </svg>
      <span class="nav-logo-text">Carwell</span>
    </a>
    <ul class="nav-links">
      <li><a href="#">COMPRAR CARRO</a></li>
      <li><a href="#">SOBRE NÓS</a></li>
      <li><a href="#">AJUDA</a></li>
      <li><a href="#">CARRINHO</a></li>
    </ul>
    <div class="nav-right">
      <span class="nav-flag">🇧🇷</span>
      <a href="login.html" class="nav-login">LOGIN</a>
      <div class="nav-profile">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#1a2e4a" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
        </svg>
      </div>
      <div class="hamburger" onclick="toggleMenu()">
        <span></span><span></span><span></span>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <section class="hero">
    <div class="hero-content">
      <h1 class="hero-title">TODA JORNADA<br>MERECE<br><span>O CARRO CERTO</span></h1>
      <p class="hero-desc">ENCONTRE QUALIDADE, PROCEDÊNCIA E AS MELHORES OPORTUNIDADES EM UM SÓ LUGAR</p>
      <div class="hero-search">
        <input type="text" placeholder="Explorar veículos"/>
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
      </div>
    </div>
    <div class="hero-car">
      <button class="carousel-btn left">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
      </button>
      <div class="hero-car-placeholder">
        <svg width="160" height="80" viewBox="0 0 200 90" fill="none">
          <path d="M20 60 Q40 25 100 25 Q160 25 180 60" stroke="rgba(255,255,255,0.7)" stroke-width="4" fill="none" stroke-linecap="round"/>
          <rect x="10" y="57" width="180" height="22" rx="11" fill="rgba(255,255,255,0.7)"/>
          <circle cx="45" cy="82" r="14" fill="rgba(255,255,255,0.5)"/><circle cx="45" cy="82" r="8" fill="rgba(255,255,255,0.8)"/>
          <circle cx="155" cy="82" r="14" fill="rgba(255,255,255,0.5)"/><circle cx="155" cy="82" r="8" fill="rgba(255,255,255,0.8)"/>
          <rect x="60" y="30" width="80" height="28" rx="6" fill="rgba(255,255,255,0.15)"/>
        </svg>
      </div>
      <button class="carousel-btn right">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
      </button>
    </div>
  </section>

  <!-- WHY CARWELL -->
  <section class="section">
    <h2 class="section-title">POR QUE ESCOLHER A CARWELL?</h2>
    <div class="features-grid">
      <div class="feature-card">
        <div class="feature-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
          </svg>
        </div>
        <p class="feature-title">GARANTIA DE CONFIANÇA</p>
        <p class="feature-desc">OFERECEMOS GARANTIA E SUPORTE MESMO APÓS A COMPRA</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
          </svg>
        </div>
        <p class="feature-title">TEST DRIVE IMEDIATO</p>
        <p class="feature-desc">AGENDE EM UMA HORA E TRATE O CARRO ANTES DE DECIDIR</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
          </svg>
        </div>
        <p class="feature-title">CONDIÇÕES QUE CABEM NO BOLSO</p>
        <p class="feature-desc">PARCELE COM AS PRINCIPAIS FINANCEIRAS E PLANOS QUE SE ENCAIXAM NA SUA REALIDADE</p>
      </div>
    </div>
  </section>

  <!-- BRANDS -->
  <div class="brands-section">
    <h2 class="section-title">MARCAS MAIS BUSCADAS</h2>
    <div style="display:flex; align-items:center; gap:10px;">
      <div class="brands-row" id="brands-row">
        <div class="brand-item">
          <svg width="36" height="36" viewBox="0 0 60 60" fill="none">
            <path d="M30 10 C18 10 10 20 10 30 C10 46 24 52 30 52 C36 52 50 46 50 30 C50 20 42 10 30 10Z" fill="none" stroke="#1a2e4a" stroke-width="2.5"/>
            <path d="M20 30 Q30 15 40 30" fill="none" stroke="#1a2e4a" stroke-width="2"/>
          </svg>
        </div>
        <div class="brand-item">
          <svg width="36" height="36" viewBox="0 0 60 60" fill="none">
            <circle cx="30" cy="30" r="20" fill="none" stroke="#1a2e4a" stroke-width="2.5"/>
            <path d="M30 10 L30 50 M10 30 L50 30" stroke="#1a2e4a" stroke-width="2"/>
          </svg>
        </div>
        <div class="brand-item">
          <svg width="36" height="36" viewBox="0 0 60 60" fill="none">
            <circle cx="30" cy="30" r="20" fill="none" stroke="#1a2e4a" stroke-width="2.5"/>
            <path d="M22 22 L38 38 M38 22 L22 38" stroke="#1a2e4a" stroke-width="2.5"/>
          </svg>
        </div>
        <div class="brand-item">
          <svg width="36" height="36" viewBox="0 0 60 60" fill="none">
            <circle cx="30" cy="30" r="20" fill="none" stroke="#1a2e4a" stroke-width="2.5"/>
            <circle cx="22" cy="30" r="8" fill="none" stroke="#1a2e4a" stroke-width="2"/>
            <circle cx="38" cy="30" r="8" fill="none" stroke="#1a2e4a" stroke-width="2"/>
          </svg>
        </div>
        <div class="brand-item" style="font-size:0.7rem; font-weight:800;">HONDA</div>
        <div class="brand-item" style="font-size:0.65rem; font-weight:800;">AUDI</div>
      </div>
      <div class="brands-arrow">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#1a2e4a" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
      </div>
    </div>
  </div>

  <!-- FILTER BAR -->
  <div class="filter-bar">
    <div class="filter-search">
      <input type="text" placeholder="BUSQUE POR MODELO DE VEÍCULO"/>
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
      </svg>
    </div>
    <button class="filter-btn">
      FILTRAR CATEGORIA
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
      </svg>
    </button>
  </div>

  <!-- CAR CARDS -->
  <div class="cars-grid">

    <!-- Card 1 -->
    <div class="car-card">
      <div class="car-img-placeholder">
        <svg viewBox="0 0 120 70" fill="none">
          <path d="M15 45 Q30 18 60 18 Q90 18 105 45" stroke="#1e4d8c" stroke-width="3" fill="none" stroke-linecap="round"/>
          <rect x="10" y="43" width="100" height="16" rx="8" fill="#1a2e4a" opacity="0.7"/>
          <circle cx="28" cy="60" r="9" fill="#1a2e4a" opacity="0.7"/><circle cx="28" cy="60" r="5" fill="#c8daea"/>
          <circle cx="92" cy="60" r="9" fill="#1a2e4a" opacity="0.7"/><circle cx="92" cy="60" r="5" fill="#c8daea"/>
        </svg>
      </div>
      <div class="car-heart" onclick="toggleHeart(this)">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
        </svg>
      </div>
      <div class="car-info">
        <p class="car-name">AUDI S6</p>
        <p class="car-spec">2.0 TFSI GASOLINA<br>PERFORMANCE S EDITION<br>QUATTRO S TRONIC</p>
      </div>
      <div class="car-arrow">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
      </div>
    </div>

    <!-- Card 2 -->
    <div class="car-card">
      <div class="car-img-placeholder" style="background: linear-gradient(135deg, #f5c6cb 0%, #f8d7da 100%);">
        <svg viewBox="0 0 120 70" fill="none">
          <path d="M12 46 Q25 16 60 14 Q95 16 108 46" stroke="#b91c1c" stroke-width="3" fill="none" stroke-linecap="round"/>
          <rect x="8" y="44" width="104" height="16" rx="8" fill="#b91c1c" opacity="0.6"/>
          <circle cx="26" cy="61" r="9" fill="#b91c1c" opacity="0.6"/><circle cx="26" cy="61" r="5" fill="#f8d7da"/>
          <circle cx="94" cy="61" r="9" fill="#b91c1c" opacity="0.6"/><circle cx="94" cy="61" r="5" fill="#f8d7da"/>
        </svg>
      </div>
      <div class="car-heart" onclick="toggleHeart(this)">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
        </svg>
      </div>
      <div class="car-info">
        <p class="car-name">PORSCHE 911 TURBO S<br>STYLE EDITION</p>
        <p class="car-spec">&nbsp;</p>
      </div>
      <div class="car-arrow">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
      </div>
    </div>

    <!-- Card 3 -->
    <div class="car-card">
      <div class="car-img-placeholder" style="background: linear-gradient(135deg, #1a2e4a 0%, #0d1b2e 100%);">
        <svg viewBox="0 0 120 70" fill="none">
          <path d="M10 46 Q28 16 60 14 Q92 16 110 46" stroke="rgba(255,255,255,0.6)" stroke-width="3" fill="none" stroke-linecap="round"/>
          <rect x="7" y="44" width="106" height="16" rx="8" fill="rgba(255,255,255,0.4)"/>
          <circle cx="25" cy="61" r="9" fill="rgba(255,255,255,0.3)"/><circle cx="25" cy="61" r="5" fill="rgba(255,255,255,0.7)"/>
          <circle cx="95" cy="61" r="9" fill="rgba(255,255,255,0.3)"/><circle cx="95" cy="61" r="5" fill="rgba(255,255,255,0.7)"/>
        </svg>
      </div>
      <div class="car-heart" onclick="toggleHeart(this)">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
        </svg>
      </div>
      <div class="car-info">
        <p class="car-name">FORD MUSTANG<br>#19</p>
        <p class="car-spec">5.0 V8 GASOLINA<br>DARK HORSE<br>SELECT SHIFT</p>
      </div>
      <div class="car-arrow">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
      </div>
    </div>

  </div>

  <script>
    function toggleHeart(el) {
      el.classList.toggle('liked');
    }
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
