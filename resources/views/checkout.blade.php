<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Carwell – Finalizar Compra</title>
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

  <!-- CHECKOUT -->
  <main class="checkout-container">

    <h1 class="checkout-title">FINALIZAR COMPRA</h1>

    <!-- SEUS PEDIDOS -->
    <div class="checkout-block">
      <p class="checkout-block-title">SEUS PEDIDOS</p>

      <div class="checkout-order-item">
        <div class="checkout-order-img">
          <img src="{{ asset('img/carros/lamborghini.png') }}" alt="Lamborghini Aventador SV" onerror="this.style.display='none'">
          <div class="order-img-placeholder lambo"></div>
        </div>
        <div class="checkout-order-info">
          <p class="checkout-order-name">LAMBORGHINI AVENTADOR SV</p>
          <p class="checkout-order-price">R$ 3.200.000</p>
        </div>
      </div>

      <div class="checkout-order-item">
        <div class="checkout-order-img">
          <img src="{{ asset('img/carros/porsche-pink.png') }}" alt="Porsche Pink" onerror="this.style.display='none'">
          <div class="order-img-placeholder porsche"></div>
        </div>
        <div class="checkout-order-info">
          <p class="checkout-order-name">PORSCHE PINK</p>
          <p class="checkout-order-price">R$ 3.200.000</p>
        </div>
      </div>

      <div class="checkout-order-item">
        <div class="checkout-order-img">
          <img src="{{ asset('img/carros/audi-r8.png') }}" alt="Audi R8" onerror="this.style.display='none'">
          <div class="order-img-placeholder audi"></div>
        </div>
        <div class="checkout-order-info">
          <p class="checkout-order-name">AUDI R8</p>
          <p class="checkout-order-price">R$ 3.200.000</p>
        </div>
      </div>
    </div>

    <!-- DADOS DO PAGAMENTO -->
    <div class="checkout-block">
      <p class="checkout-block-title">DADOS DO PAGAMENTO</p>

      <form class="payment-form" onsubmit="handleCheckout(event)">
        <input type="text" class="form-input" placeholder="Numero do cartão" maxlength="19" oninput="formatCard(this)">
        <input type="text" class="form-input" placeholder="Titular do cartão">
        <input type="text" class="form-input cvv-input" placeholder="CVV" maxlength="4">

        <div class="billing-address-row">
          <div class="billing-left">
            <p class="billing-label">Endereço de Cobrança</p>
            <input type="text" class="form-input" placeholder="CEP" maxlength="9">
            <input type="text" class="form-input" placeholder="RUA">
            <input type="text" class="form-input" placeholder="NÚMERO">
          </div>
          <div class="billing-right">
            <div class="order-summary-box">
              <p class="order-summary-label">resumo de pedido</p>
              <p class="order-summary-value">R$ 9600.000</p>
              <p class="order-summary-frete">Frete Grátis</p>
            </div>
            <button type="submit" class="btn-pagar">PAGAR AGORA</button>
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