@php
  $navPedido = null;
  if (Auth::guard('cliente')->check()) {
    $navPedido = \App\Models\Pedido::where('cliente_id', Auth::guard('cliente')->id())
      ->latest()
      ->first();
  }
  $navStep = 1;
  if ($navPedido) {
    $navStep = match($navPedido->status) {
      'a_caminho'  => 2,
      'entregue'   => 3,
      'finalizado' => 4,
      default      => 1,
    };
  }
@endphp

<link rel="stylesheet" href="{{ asset('css/nav.css') }}">

<div class="notif-overlay" id="notifOverlay" onclick="closeNotifPopup()"></div>

<nav class="main-nav" style="border-bottom: 1px solid rgba(0,0,0,0.1);">
  <div class="nav-left">
    <img src="{{ asset('img/logo.png') }}" alt="logo" class="nav-logo" />
  </div>

  <div class="nav-center">
    <div class="nav-links">
      <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'nav-active' : '' }} nav-hover-btn">{{ __('nav.home') }}</a>
      <a href="{{ route('home') }}#marcas" class="nav-hover-btn">{{ __('nav.comprar') }}</a>
      <a href="{{ route('home') }}#por-que" class="nav-hover-btn">{{ __('nav.sobre') }}</a>
      <a href="{{ route('carrinho') }}" class="{{ request()->routeIs('carrinho') ? 'nav-active' : '' }} nav-hover-btn">{{ __('nav.carrinho') }}</a>
      @auth('cliente')
      <a href="{{ route('pedidos.index') }}" class="{{ request()->routeIs('pedidos.index') ? 'nav-active' : '' }} nav-hover-btn">{{ __('nav.meus_pedidos') }}</a>
      @endauth
    </div>
  </div>
  <div class="nav-right">
    <a href="{{ route('favoritos') }}" class="nav-fav-btn {{ request()->routeIs('favoritos') ? 'active' : '' }}" id="nav-favoritos" aria-label="Favoritos">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
      </svg>
      <span id="fav-badge" style="display:none;"></span>
    </a>

    @auth('cliente')
      <a href="{{ route('perfil') }}" class="nav-login">
        {{ explode(' ', Auth::guard('cliente')->user()->name)[0] }}
      </a>
    @else
      <a href="{{ route('login-cliente') }}" class="nav-login">{{ __('nav.login') }}</a>
    @endauth

    @if($navPedido)
      <div class="nav-notif-wrap">
        <button class="nav-notif-btn" onclick="toggleNotifPopup(event)">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0F6E56" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/>
          </svg>
          <span class="notif-badge" id="notifBadge">{{ $navStep }}</span>
        </button>

        <div class="notif-popup" id="notifPopup">
          <div class="notif-popup-header">
            <p class="notif-popup-title">{{ __('pedido.notificacoes') }}</p>
            <button class="notif-popup-close" onclick="toggleNotifPopup(event)">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
          </div>
          <div class="notif-list">

            @if($navStep >= 4)
            <div class="notif-item notif-unread">
              <div class="notif-icon notif-icon-green">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              </div>
              <div class="notif-content">
                <p class="notif-text">Seu pedido <strong>{{ $navPedido->numero }}</strong> foi entregue!</p>
                <p class="notif-time">{{ $navPedido->updated_at->format('d/m/Y – H:i') }}</p>
              </div>
            </div>
            @endif

            @if($navStep >= 3)
            <div class="notif-item {{ $navStep === 3 ? 'notif-unread' : '' }}">
              <div class="notif-icon notif-icon-blue">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
                  <circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>
                </svg>
              </div>
              <div class="notif-content">
                <p class="notif-text">Pedido <strong>{{ $navPedido->numero }}</strong> saiu para entrega</p>
                <p class="notif-time">{{ $navPedido->updated_at->format('d/m/Y – H:i') }}</p>
              </div>
            </div>
            @endif

            @if($navStep >= 2)
            <div class="notif-item {{ $navStep === 2 ? 'notif-unread' : '' }}">
              <div class="notif-icon notif-icon-gray">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
                </svg>
              </div>
              <div class="notif-content">
                <p class="notif-text">Pedido <strong>{{ $navPedido->numero }}</strong> em transporte</p>
                <p class="notif-time">{{ $navPedido->updated_at->format('d/m/Y – H:i') }}</p>
              </div>
            </div>
            @endif

            <div class="notif-item">
              <div class="notif-icon notif-icon-gray">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                </svg>
              </div>
              <div class="notif-content">
                <p class="notif-text">Pedido <strong>{{ $navPedido->numero }}</strong> realizado</p>
                <p class="notif-time">{{ $navPedido->created_at->format('d/m/Y – H:i') }}</p>
              </div>
            </div>

          </div>
          <a href="#" class="notif-see-all">{{ __('pedido.ver_todas_notificacoes') }}</a>
        </div>
      </div>
    @endif

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

<script>
  function toggleNotifPopup(e) {
    e.stopPropagation();
    const popup   = document.getElementById('notifPopup');
    const overlay = document.getElementById('notifOverlay');
    if (!popup) return;
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
    const popup   = document.getElementById('notifPopup');
    const overlay = document.getElementById('notifOverlay');
    if (popup)   popup.classList.remove('open');
    if (overlay) overlay.classList.remove('active');
  }
</script>
