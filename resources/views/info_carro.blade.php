<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Carwell – {{ $carro->nome ?? 'Honda Civic G12' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="{{ asset('css/info_carro.css') }}">
  </head>
<body>

  <!-- NAV-BAR -->
  <nav class="main-nav">
    <div class="nav-left">
      <img src="{{ asset('img/logo.png') }}" alt="logo" class="nav-logo" />
    </div>

    <div class="nav-center">
      <div class="nav-links">
        <a href="{{ route('home') }}" class="nav-hover-btn">Home</a>
        <a href="#" class="nav-hover-btn">Comprar Carro</a>
        <a href="#" class="nav-hover-btn">Sobre Nós</a>
        <a href="#" class="nav-hover-btn">Ajuda</a>
        <a href="{{ route('carrinho') }}" class="nav-hover-btn">Carrinho</a>
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

  <!-- PRODUTO PRINCIPAL -->
  <section class="product-section">

    <!-- Sidebar esquerda -->
    <div class="product-sidebar">
      <button class="sidebar-btn active">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <rect x="3" y="3" width="18" height="18" rx="2"/><path d="M9 9h6M9 12h6M9 15h4"/>
        </svg>
      </button>
      <button class="sidebar-btn">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
        </svg>
      </button>
      <button class="sidebar-btn">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14"/>
        </svg>
      </button>
      <div class="sidebar-3d">3D</div>
    </div>

    <!-- Imagem do carro -->
    <div class="product-image-area">
      <div class="product-actions-top">
        <button class="action-icon-btn">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/>
            <polyline points="16 6 12 2 8 6"/><line x1="12" y1="2" x2="12" y2="15"/>
          </svg>
        </button>
        <button class="action-icon-btn heart-btn" onclick="toggleHeart(this)">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
          </svg>
        </button>
      </div>
      <img src="{{ asset('img/carros/honda-civic.png') }}" alt="{{ $carro->nome ?? 'Honda Civic' }}" class="product-main-img" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
      <div class="product-img-placeholder" style="display:none">
        <svg viewBox="0 0 200 100" fill="none" width="200">
          <path d="M20 68 Q50 22 100 20 Q150 22 180 68" stroke="rgba(0,0,0,0.3)" stroke-width="4" fill="none" stroke-linecap="round"/>
          <rect x="12" y="65" width="176" height="24" rx="12" fill="rgba(0,0,0,0.2)"/>
          <circle cx="40" cy="92" r="13" fill="rgba(0,0,0,0.2)"/><circle cx="40" cy="92" r="7" fill="rgba(0,0,0,0.35)"/>
          <circle cx="160" cy="92" r="13" fill="rgba(0,0,0,0.2)"/><circle cx="160" cy="92" r="7" fill="rgba(0,0,0,0.35)"/>
        </svg>
      </div>
    </div>

    <!-- Info do produto -->
    <div class="product-info-area">
      <p class="product-label">HONDA CIVIC G12 2025(34)</p>
      <p class="product-price">R$ 708.900</p>
      <button class="btn-comprar">COMPRAR</button>

      <!-- Informações Básicas -->
      <div class="info-section">
        <p class="info-section-title">INFORMAÇÕES BÁSICAS</p>

        <!-- Cidade -->
        <div class="accordion-item">
          <button class="accordion-trigger" onclick="toggleAccordion(this)">
            <span class="info-label">CIDADE</span>
            <span class="accordion-right">
              <span class="accordion-preview">SÃO PAULO</span>
              <svg class="accordion-arrow" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="6 9 12 15 18 9"/></svg>
            </span>
          </button>
          <div class="accordion-body">
            <div class="accordion-content">
              <div class="accordion-detail-row"><span>São Paulo – SP</span></div>
              <div class="accordion-detail-row"><span>Zona Sul</span></div>
              <div class="accordion-detail-row"><span>CEP: 04000-000</span></div>
            </div>
          </div>
        </div>

        <!-- Estoque ID -->
        <div class="accordion-item">
          <button class="accordion-trigger" onclick="toggleAccordion(this)">
            <span class="info-label">ESTOQUE ID</span>
            <span class="accordion-right">
              <span class="accordion-preview">1720</span>
              <svg class="accordion-arrow" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="6 9 12 15 18 9"/></svg>
            </span>
          </button>
          <div class="accordion-body">
            <div class="accordion-content">
              <div class="accordion-detail-row"><span>Código interno</span><span class="accordion-val">1720-CW</span></div>
              <div class="accordion-detail-row"><span>Disponibilidade</span><span class="accordion-val accent">Em estoque</span></div>
            </div>
          </div>
        </div>

        <!-- Ano -->
        <div class="accordion-item">
          <button class="accordion-trigger" onclick="toggleAccordion(this)">
            <span class="info-label">ANO</span>
            <span class="accordion-right">
              <span class="accordion-preview">2026</span>
              <svg class="accordion-arrow" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="6 9 12 15 18 9"/></svg>
            </span>
          </button>
          <div class="accordion-body">
            <div class="accordion-content">
              <div class="accordion-detail-row"><span>Ano de fabricação</span><span class="accordion-val">2025</span></div>
              <div class="accordion-detail-row"><span>Ano modelo</span><span class="accordion-val">2026</span></div>
              <div class="accordion-detail-row"><span>Quilometragem</span><span class="accordion-val">0 km</span></div>
            </div>
          </div>
        </div>

        <a href="#" class="ver-mais-link">VER MAIS</a>
      </div>

      <!-- Características -->
      <div class="info-section">
        <p class="info-section-title">CARACTERÍSTICAS</p>

        <div class="accordion-item">
          <button class="accordion-trigger" onclick="toggleAccordion(this)">
            <span class="info-label">GERAL</span>
            <svg class="accordion-arrow" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="6 9 12 15 18 9"/></svg>
          </button>
          <div class="accordion-body">
            <div class="accordion-content">
              <div class="accordion-detail-row"><span>Combustível</span><span class="accordion-val">Gasolina</span></div>
              <div class="accordion-detail-row"><span>Câmbio</span><span class="accordion-val">CVT</span></div>
              <div class="accordion-detail-row"><span>Tração</span><span class="accordion-val">Dianteira</span></div>
              <div class="accordion-detail-row"><span>Direção</span><span class="accordion-val">Elétrica</span></div>
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <button class="accordion-trigger" onclick="toggleAccordion(this)">
            <span class="info-label">EXTERIOR</span>
            <svg class="accordion-arrow" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="6 9 12 15 18 9"/></svg>
          </button>
          <div class="accordion-body">
            <div class="accordion-content">
              <div class="accordion-detail-row"><span>Cor</span><span class="accordion-val">Preto</span></div>
              <div class="accordion-detail-row"><span>Rodas</span><span class="accordion-val">18" Liga Leve</span></div>
              <div class="accordion-detail-row"><span>Vidros elétricos</span><span class="accordion-val accent">Sim</span></div>
              <div class="accordion-detail-row"><span>Teto solar</span><span class="accordion-val accent">Sim</span></div>
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <button class="accordion-trigger" onclick="toggleAccordion(this)">
            <span class="info-label">ENTRETENIMENTO E CONFORTO</span>
            <svg class="accordion-arrow" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="6 9 12 15 18 9"/></svg>
          </button>
          <div class="accordion-body">
            <div class="accordion-content">
              <div class="accordion-detail-row"><span>Central multimídia</span><span class="accordion-val">10.5" Touch</span></div>
              <div class="accordion-detail-row"><span>Apple CarPlay</span><span class="accordion-val accent">Sim</span></div>
              <div class="accordion-detail-row"><span>Android Auto</span><span class="accordion-val accent">Sim</span></div>
              <div class="accordion-detail-row"><span>Ar-condicionado</span><span class="accordion-val">Dual Zone</span></div>
              <div class="accordion-detail-row"><span>Bancos</span><span class="accordion-val">Couro aquecido</span></div>
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <button class="accordion-trigger" onclick="toggleAccordion(this)">
            <span class="info-label">SEGURANÇA</span>
            <svg class="accordion-arrow" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="6 9 12 15 18 9"/></svg>
          </button>
          <div class="accordion-body">
            <div class="accordion-content">
              <div class="accordion-detail-row"><span>Airbags</span><span class="accordion-val">6 unidades</span></div>
              <div class="accordion-detail-row"><span>ABS + EBD</span><span class="accordion-val accent">Sim</span></div>
              <div class="accordion-detail-row"><span>Câmera de ré</span><span class="accordion-val accent">Sim</span></div>
              <div class="accordion-detail-row"><span>Sensor de estacionamento</span><span class="accordion-val accent">Sim</span></div>
              <div class="accordion-detail-row"><span>Honda Sensing</span><span class="accordion-val accent">Sim</span></div>
            </div>
          </div>
        </div>
      </div>

      <!-- Dados Técnicos -->
      <div class="info-section">
        <p class="info-section-title">DADOS TÉCNICOS</p>

        <div class="accordion-item">
          <button class="accordion-trigger" onclick="toggleAccordion(this)">
            <span class="info-label">UNIDADE MOTOR</span>
            <svg class="accordion-arrow" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="6 9 12 15 18 9"/></svg>
          </button>
          <div class="accordion-body">
            <div class="accordion-content">
              <div class="accordion-detail-row"><span>Motor</span><span class="accordion-val">1.5 VTEC Turbo</span></div>
              <div class="accordion-detail-row"><span>Cilindros</span><span class="accordion-val">4 cilindros</span></div>
              <div class="accordion-detail-row"><span>Cilindrada</span><span class="accordion-val">1.498 cc</span></div>
              <div class="accordion-detail-row"><span>Alimentação</span><span class="accordion-val">Injeção direta</span></div>
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <button class="accordion-trigger" onclick="toggleAccordion(this)">
            <span class="info-label">DESEMPENHO</span>
            <svg class="accordion-arrow" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="6 9 12 15 18 9"/></svg>
          </button>
          <div class="accordion-body">
            <div class="accordion-content">
              <div class="accordion-detail-row"><span>Potência</span><span class="accordion-val">182 cv</span></div>
              <div class="accordion-detail-row"><span>Torque</span><span class="accordion-val">24,1 kgfm</span></div>
              <div class="accordion-detail-row"><span>0–100 km/h</span><span class="accordion-val">7,2 s</span></div>
              <div class="accordion-detail-row"><span>Vel. máxima</span><span class="accordion-val">230 km/h</span></div>
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <button class="accordion-trigger" onclick="toggleAccordion(this)">
            <span class="info-label">CARROCERIA</span>
            <svg class="accordion-arrow" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="6 9 12 15 18 9"/></svg>
          </button>
          <div class="accordion-body">
            <div class="accordion-content">
              <div class="accordion-detail-row"><span>Tipo</span><span class="accordion-val">Sedã</span></div>
              <div class="accordion-detail-row"><span>Portas</span><span class="accordion-val">4</span></div>
              <div class="accordion-detail-row"><span>Capacidade</span><span class="accordion-val">5 lugares</span></div>
              <div class="accordion-detail-row"><span>Porta-malas</span><span class="accordion-val">519 litros</span></div>
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <button class="accordion-trigger" onclick="toggleAccordion(this)">
            <span class="info-label">NÍVEL DE RUÍDO</span>
            <svg class="accordion-arrow" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="6 9 12 15 18 9"/></svg>
          </button>
          <div class="accordion-body">
            <div class="accordion-content">
              <div class="accordion-detail-row"><span>Interno em marcha</span><span class="accordion-val">62 dB</span></div>
              <div class="accordion-detail-row"><span>Externo máx.</span><span class="accordion-val">71 dB</span></div>
              <div class="accordion-detail-row"><span>Classificação</span><span class="accordion-val accent">Silencioso</span></div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>

  <!-- VOCÊ TAMBÉM PODE SE INTERESSAR -->
  <section class="related-section">
    <div class="related-header">
      <h2 class="section-title-sm">VOCÊ TAMBÉM PODE SE INTERESSAR</h2>
      <button class="related-arrow">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      </button>
    </div>
    <div class="related-grid">
      <!-- Card 1 -->
      <div class="related-card">
        <div class="related-img-wrap">
          <img src="{{ asset('img/carros/ferrari-f8.png') }}" alt="Ferrari F8 Spyder" onerror="this.style.display='none'">
          <div class="related-img-placeholder ferrari"></div>
          <button class="related-heart" onclick="toggleHeart(this)">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
          </button>
        </div>
        <p class="related-name">FERRARI F8 SPYDER</p>
      </div>
      <!-- Card 2 -->
      <div class="related-card">
        <div class="related-img-wrap">
          <img src="{{ asset('img/carros/bmw-m8.png') }}" alt="BMW M8" onerror="this.style.display='none'">
          <div class="related-img-placeholder bmw"></div>
          <button class="related-heart" onclick="toggleHeart(this)">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
          </button>
        </div>
        <p class="related-name">BMW M8</p>
      </div>
      <!-- Card 3 -->
      <div class="related-card">
        <div class="related-img-wrap">
          <img src="{{ asset('img/carros/mercedes-amg.png') }}" alt="Mercedes-Benz AMG g63" onerror="this.style.display='none'">
          <div class="related-img-placeholder mercedes"></div>
          <button class="related-heart" onclick="toggleHeart(this)">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
          </button>
        </div>
        <p class="related-name">MERCEDES-BENZ AMG G63 ♥</p>
      </div>
      <!-- Card 4 -->
      <div class="related-card">
        <div class="related-img-wrap">
          <img src="{{ asset('img/carros/lamborghini.png') }}" alt="Lamborghini Aventador SV" onerror="this.style.display='none'">
          <div class="related-img-placeholder lambo"></div>
          <button class="related-heart" onclick="toggleHeart(this)">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
          </button>
        </div>
        <p class="related-name">LAMBORGHINI AVENTADOR SV</p>
      </div>
      <!-- Card 5 -->
      <div class="related-card">
        <div class="related-img-wrap">
          <img src="{{ asset('img/carros/fiat-uno.png') }}" alt="Fiat Uno" onerror="this.style.display='none'">
          <div class="related-img-placeholder fiat"></div>
          <button class="related-heart" onclick="toggleHeart(this)">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
          </button>
        </div>
        <p class="related-name">FIAT UNO</p>
      </div>
      <!-- Card 6 -->
      <div class="related-card">
        <div class="related-img-wrap">
          <img src="{{ asset('img/carros/porsche-pink.png') }}" alt="Porsche Pink" onerror="this.style.display='none'">
          <div class="related-img-placeholder porsche-pink"></div>
          <button class="related-heart" onclick="toggleHeart(this)">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
          </button>
        </div>
        <p class="related-name">PORSCHE PINK</p>
      </div>
    </div>
  </section>

  <!-- CATEGORIAS -->
  <section class="categories-section">
    <div class="related-header">
      <h2 class="section-title-sm">CATEGORIAS</h2>
    </div>
    <div class="categories-grid">
      <div class="category-card">
        <img src="{{ asset('img/categorias/vintage.jpg') }}" alt="Vintage" onerror="this.style.display='none'">
        <div class="category-overlay"></div>
        <span class="category-name">VINTAGE</span>
      </div>
      <div class="category-card">
        <img src="{{ asset('img/categorias/eletricos.jpg') }}" alt="Elétricos" onerror="this.style.display='none'">
        <div class="category-overlay"></div>
        <span class="category-name">ELÉTRICOS</span>
      </div>
      <div class="category-card">
        <img src="{{ asset('img/categorias/picapes.jpg') }}" alt="Picapes" onerror="this.style.display='none'">
        <div class="category-overlay"></div>
        <span class="category-name">PICAPES</span>
      </div>
    </div>
  </section>

  <script>
    function toggleHeart(el) {
      el.classList.toggle('liked');
    }

    function toggleAccordion(trigger) {
      const item = trigger.closest('.accordion-item');
      const isOpen = item.classList.contains('open');

      // Fecha todos dentro da mesma info-section
      const section = item.closest('.info-section');
      section.querySelectorAll('.accordion-item.open').forEach(openItem => {
        openItem.classList.remove('open');
        openItem.querySelector('.accordion-body').style.maxHeight = null;
      });

      // Abre o clicado (se não estava aberto)
      if (!isOpen) {
        item.classList.add('open');
        const body = item.querySelector('.accordion-body');
        body.style.maxHeight = body.scrollHeight + 'px';
      }
    }

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