<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>{{ __('checkout.titulo') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
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
        <a href="{{ route('home') }}#marcas" class="nav-hover-btn">{{ __('nav.comprar') }}</a>
        <a href="{{ route('home') }}#por-que" class="nav-hover-btn">{{ __('nav.sobre') }}</a>
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

  <!-- CHECKOUT -->
  <main class="checkout-container">

    <h1 class="checkout-title">{{ __('carrinho.finalizar') }}</h1>

    <!-- SEUS PEDIDOS -->
    <div class="checkout-block">
      <p class="checkout-block-title">{{ __('checkout.seus_pedidos') }}</p>
      <div id="checkout-items"><p style="color:#9EA19C; font-size:0.85rem;">Carregando...</p></div>
    </div>

    <!-- DADOS DO PAGAMENTO -->
    <div class="checkout-block">
      <p class="checkout-block-title">{{ __('checkout.dados_pagamento') }}</p>

      <form class="payment-form" onsubmit="handleCheckout(event)">
        <input type="text" class="form-input" placeholder="{{ __('checkout.numero_cartao') }}" maxlength="19" oninput="formatCard(this)">
        <input type="text" class="form-input" placeholder="{{ __('checkout.titular_cartao') }}">
        <input type="text" class="form-input cvv-input" placeholder="CVV" maxlength="4">

        <div class="billing-address-row">
          <div class="billing-left">
            <p class="billing-label">{{ __('checkout.endereco_cobranca') }}</p>
            <input type="text" class="form-input" placeholder="CEP" maxlength="9">
            <input type="text" class="form-input" placeholder="{{ __('checkout.rua') }}">
            <input type="text" class="form-input" placeholder="{{ __('checkout.numero') }}">
          </div>
          <div class="billing-right">
            <div class="order-summary-box">
              <p class="order-summary-label">{{ __('checkout.resumo_pedido') }}</p>
              <p class="order-summary-value" id="checkout-total">R$ 0</p>
              <p class="order-summary-frete">{{ __('checkout.frete_gratis') }}</p>
            </div>
            <button type="submit" class="btn-pagar">{{ __('checkout.pagar_agora') }}</button>
          </div>
        </div>
      </form>
    </div>

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
    const cart = JSON.parse(localStorage.getItem('carwell_carrinho') || '{}');
    const ids  = Object.keys(cart);

    if (!ids.length) {
      document.getElementById('checkout-items').innerHTML = '<p style="color:#9EA19C;font-size:0.85rem;">Nenhum item no carrinho.</p>';
    } else {
      fetch('{{ route("carros.por-ids") }}?' + ids.map(id => `ids[]=${id}`).join('&'))
        .then(r => r.json())
        .then(carros => {
          let total = 0;

          document.getElementById('checkout-items').innerHTML = carros.map(c => {
            const qty      = cart[c.id] || 1;
            const subtotal = Number(c.preco) * qty;
            total += subtotal;
            const img = c.capa_path
              ? `<img src="{{ asset('storage') }}/${c.capa_path}" onerror="this.style.display='none'">`
              : '';

            return `<div class="checkout-order-item">
              <div class="checkout-order-img">
                ${img}
                <div class="order-img-placeholder" style="${c.capa_path ? 'display:none;' : ''}background:linear-gradient(135deg,#2d3748,#4a5568);"></div>
              </div>
              <div class="checkout-order-info">
                <p class="checkout-order-name">${c.nome.toUpperCase()}${qty > 1 ? ' ×' + qty : ''}</p>
                <p class="checkout-order-price">R$ ${Number(subtotal).toLocaleString('pt-BR')}</p>
              </div>
            </div>`;
          }).join('');

          document.getElementById('checkout-total').textContent = 'R$ ' + Number(total).toLocaleString('pt-BR');
        });
    }

    function formatCard(input) {
      let v = input.value.replace(/\D/g, '').substring(0, 16);
      input.value = v.replace(/(.{4})/g, '$1 ').trim();
    }

    function handleCheckout(e) {
      e.preventDefault();
      window.location.href = "{{ route('pedido') }}";
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