<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>{{ __('pedido.titulo') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/pedido.css') }}">
  </head>
<body>

  <!-- NAV-BAR -->
  <nav class="main-nav">
    <div class="nav-left">
      <img src="{{ asset('img/logo.png') }}" alt="logo" class="nav-logo" />
    </div>

    <div class="nav-center">
      <div class="nav-links">
        <a href="{{ route('home') }}" class="nav-hover-btn">{{ __('nav.home') }}</a>
        <a href="#" class="nav-hover-btn">{{ __('nav.comprar') }}</a>
        <a href="#" class="nav-hover-btn">{{ __('nav.sobre') }}</a>
        <a href="#" class="nav-hover-btn">{{ __('nav.ajuda') }}</a>
        <a href="{{ route('carrinho') }}" class="nav-hover-btn">{{ __('nav.carrinho') }}</a>
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

      <!-- Sino com popup -->
      <div class="nav-notif-wrap">
        <button class="nav-notif-btn" onclick="toggleNotifPopup(event)">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0F6E56" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/>
          </svg>
          <span class="notif-badge" id="notifBadge">3</span>
        </button>

        <div class="notif-popup" id="notifPopup">
          <div class="notif-popup-header">
            <p class="notif-popup-title">{{ __('pedido.notificacoes') }}</p>
            <button class="notif-popup-close" onclick="toggleNotifPopup(event)">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
          </div>
          <div class="notif-list">
            <div class="notif-item notif-unread">
              <div class="notif-icon notif-icon-green">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              </div>
              <div class="notif-content">
                <p class="notif-text">Seu pedido <strong>#17289</strong> foi entregue!</p>
                <p class="notif-time">04/02/2026 – 18:34</p>
              </div>
            </div>
            <div class="notif-item notif-unread">
              <div class="notif-icon notif-icon-blue">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
                  <circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>
                </svg>
              </div>
              <div class="notif-content">
                <p class="notif-text">Pedido <strong>#17289</strong> saiu para entrega</p>
                <p class="notif-time">04/02/2026 – 15:34</p>
              </div>
            </div>
            <div class="notif-item">
              <div class="notif-icon notif-icon-gray">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
                </svg>
              </div>
              <div class="notif-content">
                <p class="notif-text">Pedido em transporte para Curitiba</p>
                <p class="notif-time">02/02/2026 – 10:34</p>
              </div>
            </div>
          </div>
          <a href="#" class="notif-see-all">{{ __('pedido.ver_todas_notificacoes') }}</a>
        </div>
      </div>

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

  <!-- PEDIDO -->
  <main class="pedido-container">

    <div class="pedido-header-card">
      <div class="pedido-car-img">
        <img src="{{ asset('img/carros/porsche-pink.png') }}" alt="Porsche Pink" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
        <div class="pedido-car-placeholder" style="display:none"></div>
      </div>
      <div class="pedido-header-info">
        <p class="pedido-header-label">{{ __('pedido.seus_pedidos') }}</p>
        <p class="pedido-car-name">PORSCHE PINK</p>
        <p class="pedido-car-price">R$ 3.200.000</p>
      </div>
    </div>

    <div class="pedido-id-block">
      <p class="pedido-id-label">{{ __('pedido.id_pedido') }}</p>
      <p class="pedido-id">#17289</p>
      <p class="pedido-realizados-label">{{ __('pedido.pedidos_realizados') }}</p>
    </div>

    <div class="pedido-timeline">

      <div class="timeline-step done">
        <div class="timeline-icon-wrap">
          <div class="timeline-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
            </svg>
          </div>
        </div>
        <div class="timeline-content">
          <p class="timeline-title">{{ __('pedido.pedido_realizado') }}</p>
          <p class="timeline-date">28/01/2026 – 23:34</p>
        </div>
      </div>

      <div class="timeline-step done">
        <div class="timeline-icon-wrap">
          <div class="timeline-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
              <circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>
            </svg>
          </div>
        </div>
        <div class="timeline-content">
          <p class="timeline-title">{{ __('pedido.em_transporte', ['cidade' => 'CURITIBA']) }}</p>
          <p class="timeline-date">02/02/2026 – 10:34</p>
        </div>
      </div>

      <div class="timeline-step done">
        <div class="timeline-icon-wrap">
          <div class="timeline-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
            </svg>
          </div>
        </div>
        <div class="timeline-content">
          <p class="timeline-title">{{ __('pedido.saiu_para_entrega') }}</p>
          <p class="timeline-date">04/02/2026 – 15:34</p>
        </div>
      </div>

      <div class="timeline-step delivered">
        <div class="timeline-icon-wrap">
          <div class="timeline-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="20 6 9 17 4 12"/>
            </svg>
          </div>
        </div>
        <div class="timeline-content">
          <p class="timeline-title">{{ __('pedido.pedido_entregue') }}</p>
          <p class="timeline-date">04/02/2026 – 18:34</p>
        </div>
      </div>

    </div>

  </main>

  <div class="notif-overlay" id="notifOverlay" onclick="closeNotifPopup()"></div>

  <script>
    function toggleNotifPopup(e) {
      e.stopPropagation();
      const popup = document.getElementById('notifPopup');
      const overlay = document.getElementById('notifOverlay');
      const isOpen = popup.classList.contains('open');
      if (isOpen) {
        popup.classList.remove('open');
        overlay.classList.remove('active');
      } else {
        popup.classList.add('open');
        overlay.classList.add('active');
        const badge = document.getElementById('notifBadge');
        if (badge) setTimeout(() => { badge.style.opacity = '0'; }, 800);
      }
    }

    function closeNotifPopup() {
      document.getElementById('notifPopup').classList.remove('open');
      document.getElementById('notifOverlay').classList.remove('active');
    }

    function toggleMenu() {
      const links = document.querySelector('.nav-links');
      if (links.style.display === 'flex') {
        links.style.display = 'none';
      } else {
        links.style.cssText = 'display:flex; flex-direction:column; position:absolute; top:60px; left:0; right:0; background:#fff; padding:20px 32px; gap:18px; box-shadow:0 8px 24px rgba(30,77,140,0.1); z-index:99;';
      }
    }

    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') closeNotifPopup();
    });
  </script>
</body>
</html>