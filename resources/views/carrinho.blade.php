<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Carwell – Carrinho</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/carrinho.css') }}">
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
        <a href="{{ route('carrinho') }}" class="nav-active nav-hover-btn">Carrinho</a>
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

  <!-- CARRINHO -->
  <main class="carrinho-container">

    <!-- Item 1 -->
    <div class="cart-item">
      <div class="cart-item-img-wrap">
        <img src="{{ asset('img/carros/honda-civic.png') }}" alt="Honda Civic" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
        <div class="cart-item-img-placeholder civic" style="display:none"></div>
      </div>
      <div class="cart-item-details">
        <p class="cart-item-name">HONDA CIVIC G12 2025(34)</p>
        <div class="cart-item-qty">
          <button class="qty-btn" onclick="changeQty(this, -1)">–</button>
          <span class="qty-value">1</span>
          <button class="qty-btn" onclick="changeQty(this, 1)">+</button>
        </div>
        <div class="cart-item-prices">
          <span class="cart-item-price-orig">R$ 708.900</span>
          <button class="cart-item-remove" onclick="removeItem(this)">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/>
              <path d="M9 6V4h6v2"/>
            </svg>
          </button>
        </div>
        <p class="cart-item-price-final">R$ 708.900</p>
        <a href="#" class="adicionar-seguro">
          Adicionar seguro
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
        </a>
      </div>
    </div>

    <!-- Item 2 -->
    <div class="cart-item">
      <div class="cart-item-img-wrap">
        <img src="{{ asset('img/carros/bmw-m8.png') }}" alt="BMW M8" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
        <div class="cart-item-img-placeholder bmw" style="display:none"></div>
      </div>
      <div class="cart-item-details">
        <p class="cart-item-name">BMW M8</p>
        <div class="cart-item-qty">
          <button class="qty-btn" onclick="changeQty(this, -1)">–</button>
          <span class="qty-value">1</span>
          <button class="qty-btn" onclick="changeQty(this, 1)">+</button>
        </div>
        <div class="cart-item-prices">
          <span class="cart-item-price-orig">R$ 880.900</span>
          <button class="cart-item-remove" onclick="removeItem(this)">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/>
              <path d="M9 6V4h6v2"/>
            </svg>
          </button>
        </div>
        <p class="cart-item-price-final">R$ 880.900</p>
        <a href="#" class="adicionar-seguro">
          Adicionar seguro
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
        </a>
      </div>
    </div>

    <!-- Item 3 -->
    <div class="cart-item">
      <div class="cart-item-img-wrap">
        <img src="{{ asset('img/carros/ferrari-f8.png') }}" alt="Ferrari F8 Spyder" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
        <div class="cart-item-img-placeholder ferrari" style="display:none"></div>
      </div>
      <div class="cart-item-details">
        <p class="cart-item-name">FERRARI F8 SPYDER (2032)</p>
        <div class="cart-item-qty">
          <button class="qty-btn" onclick="changeQty(this, -1)">–</button>
          <span class="qty-value">1</span>
          <button class="qty-btn" onclick="changeQty(this, 1)">+</button>
        </div>
        <div class="cart-item-prices">
          <span class="cart-item-price-orig">R$ 3.200.000</span>
          <button class="cart-item-remove" onclick="removeItem(this)">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/>
              <path d="M9 6V4h6v2"/>
            </svg>
          </button>
        </div>
        <p class="cart-item-price-final">R$ 3.200.000</p>
        <a href="#" class="adicionar-seguro">
          Adicionar seguro
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
        </a>
      </div>
    </div>

    <!-- Adicionar mais carros -->
    <div class="add-more-wrap">
      <a href="{{ route('home') }}" class="add-more-link">+ Adicionar mais carros</a>
    </div>

    <!-- Resumo -->
    <div class="cart-summary">
      <div class="summary-row">
        <span class="summary-label">Subtotal</span>
        <span class="summary-value" id="subtotal">R$ 4.868.900</span>
      </div>
      <div class="summary-row">
        <span class="summary-label">Frete</span>
        <span class="summary-value free">Grátis</span>
      </div>
      <div class="summary-row total-row">
        <span class="summary-label total-label">Total</span>
        <span class="summary-value total-value" id="total">R$ 4.868.900</span>
      </div>
    </div>

    <!-- Botão finalizar -->
    <a href="{{ route('checkout') }}" class="btn-finalizar">FINALIZAR COMPRA</a>

    <!-- Métodos de pagamento -->
    <div class="payment-methods">
      <img src="{{ asset('img/payment/visa.svg') }}" alt="Visa" onerror="this.outerHTML='<span class=pay-icon>VISA</span>'">
      <img src="{{ asset('img/payment/mastercard.svg') }}" alt="Mastercard" onerror="this.outerHTML='<span class=pay-icon>MC</span>'">
      <img src="{{ asset('img/payment/amex.svg') }}" alt="Amex" onerror="this.outerHTML='<span class=pay-icon>AMEX</span>'">
      <img src="{{ asset('img/payment/elo.svg') }}" alt="Elo" onerror="this.outerHTML='<span class=pay-icon>ELO</span>'">
      <img src="{{ asset('img/payment/cielo.svg') }}" alt="Cielo" onerror="this.outerHTML='<span class=pay-icon>CIELO</span>'">
      <img src="{{ asset('img/payment/pix.svg') }}" alt="Pix" onerror="this.outerHTML='<span class=pay-icon>PIX</span>'">
    </div>

  </main>

  <script>
    function changeQty(btn, delta) {
      const qtyEl = btn.parentElement.querySelector('.qty-value');
      let qty = parseInt(qtyEl.textContent) + delta;
      if (qty < 1) qty = 1;
      qtyEl.textContent = qty;
    }

    function removeItem(btn) {
      const item = btn.closest('.cart-item');
      item.style.opacity = '0';
      item.style.transform = 'translateX(40px)';
      item.style.transition = 'all 0.3s ease';
      setTimeout(() => item.remove(), 300);
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