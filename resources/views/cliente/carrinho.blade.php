<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>{{ __('carrinho.titulo') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/carrinho.css') }}">
  </head>
<body>

  @include('partials._nav')

  <!-- CARRINHO -->
  <main class="carrinho-container">

    <div id="cart-loading" style="text-align:center; padding:60px 0; color:#9EA19C; font-size:0.85rem;">Carregando...</div>

    <div id="cart-empty" style="display:none; text-align:center; padding:80px 0; color:#9EA19C;">
      <p style="font-family:'Syne',sans-serif; font-size:0.9rem; font-weight:800; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:8px; color:#6b7280;">Carrinho vazio</p>
      <p style="font-size:0.82rem;">Você ainda não adicionou nenhum carro ao carrinho.</p>
      <a href="{{ route('home') }}" style="display:inline-block; margin-top:20px; background:#0F6E56; color:#fff; font-family:'Syne',sans-serif; font-size:0.78rem; font-weight:800; text-transform:uppercase; letter-spacing:0.06em; padding:10px 24px; border-radius:8px; text-decoration:none;">Ver carros</a>
    </div>

    <div id="cart-items"></div>

    <div id="cart-footer" style="display:none;">
      <div class="add-more-wrap">
        <a href="{{ route('home') }}" class="add-more-link">{{ __('carrinho.adicionar_mais') }}</a>
      </div>

      <div class="cart-summary">
        <div class="summary-row">
          <span class="summary-label">{{ __('carrinho.subtotal') }}</span>
          <span class="summary-value" id="subtotal">R$ 0</span>
        </div>
        <div class="summary-row">
          <span class="summary-label">{{ __('carrinho.frete') }}</span>
          <span class="summary-value free">{{ __('carrinho.gratis') }}</span>
        </div>
        <div class="summary-row total-row">
          <span class="summary-label total-label">{{ __('carrinho.total') }}</span>
          <span class="summary-value total-value" id="total">R$ 0</span>
        </div>
      </div>

      <a href="{{ route('checkout') }}" class="btn-finalizar">{{ __('carrinho.finalizar') }}</a>

      <div class="payment-methods">
        <img src="{{ asset('img/payment/visa.svg') }}" alt="Visa" onerror="this.outerHTML='<span class=pay-icon>VISA</span>'">
        <img src="{{ asset('img/payment/mastercard.svg') }}" alt="Mastercard" onerror="this.outerHTML='<span class=pay-icon>MC</span>'">
        <img src="{{ asset('img/payment/amex.svg') }}" alt="Amex" onerror="this.outerHTML='<span class=pay-icon>AMEX</span>'">
        <img src="{{ asset('img/payment/elo.svg') }}" alt="Elo" onerror="this.outerHTML='<span class=pay-icon>ELO</span>'">
        <img src="{{ asset('img/payment/cielo.svg') }}" alt="Cielo" onerror="this.outerHTML='<span class=pay-icon>CIELO</span>'">
        <img src="{{ asset('img/payment/pix.svg') }}" alt="Pix" onerror="this.outerHTML='<span class=pay-icon>PIX</span>'">
      </div>
    </div>

  </main>

  <script>
    const cart = JSON.parse(localStorage.getItem('carwell_carrinho') || '{}');
    const ids  = Object.keys(cart);

    function saveCart() {
      localStorage.setItem('carwell_carrinho', JSON.stringify(cart));
    }

    function fmtPreco(v) {
      return 'R$ ' + Number(v).toLocaleString('pt-BR');
    }

    function updateTotal() {
      let total = 0;
      document.querySelectorAll('.cart-item').forEach(item => {
        total += Number(item.dataset.preco) * Number(item.querySelector('.qty-value').textContent);
      });
      document.getElementById('subtotal').textContent = fmtPreco(total);
      document.getElementById('total').textContent    = fmtPreco(total);
    }

    function changeQty(btn, delta) {
      const item = btn.closest('.cart-item');
      const el   = item.querySelector('.qty-value');
      const qty  = Math.max(1, Number(el.textContent) + delta);
      el.textContent = qty;
      cart[item.dataset.id] = qty;
      saveCart();
      updateTotal();
    }

    function removeItem(btn, id) {
      btn.closest('.cart-item').remove();
      delete cart[id];
      saveCart();
      updateTotal();
      if (!document.querySelectorAll('.cart-item').length) {
        document.getElementById('cart-footer').style.display = 'none';
        document.getElementById('cart-empty').style.display  = 'block';
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

    if (!ids.length) {
      document.getElementById('cart-loading').style.display = 'none';
      document.getElementById('cart-empty').style.display   = 'block';
    } else {
      fetch('{{ route("carros.por-ids") }}?' + ids.map(id => `ids[]=${id}`).join('&'))
        .then(r => r.json())
        .then(carros => {
          document.getElementById('cart-loading').style.display = 'none';

          document.getElementById('cart-items').innerHTML = carros.map(c => {
            const qty = cart[c.id] || 1;
            const img = c.capa_path
              ? `<img src="{{ asset('storage') }}/${c.capa_path}" style="width:100%;height:100%;object-fit:cover;" onerror="this.style.display='none'">`
              : '';

            return `<div class="cart-item" data-id="${c.id}" data-preco="${c.preco}">
              <div class="cart-item-img-wrap">
                ${img}
                <div class="cart-item-img-placeholder" style="${c.capa_path ? 'display:none;' : ''}background:linear-gradient(135deg,#2d3748,#4a5568);width:100%;height:100%;"></div>
              </div>
              <div class="cart-item-details">
                <p class="cart-item-name">${c.nome.toUpperCase()}</p>
                <div class="cart-item-qty">
                  <button class="qty-btn" onclick="changeQty(this,-1)">–</button>
                  <span class="qty-value">${qty}</span>
                  <button class="qty-btn" onclick="changeQty(this,1)">+</button>
                </div>
                <div class="cart-item-prices">
                  <span class="cart-item-price-orig">${fmtPreco(c.preco)}</span>
                  <button class="cart-item-remove" onclick="removeItem(this,${c.id})">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/>
                    </svg>
                  </button>
                </div>
                <p class="cart-item-price-final">${fmtPreco(c.preco)}</p>
              </div>
            </div>`;
          }).join('');

          document.getElementById('cart-footer').style.display = 'block';
          updateTotal();
        });
    }
  </script>

  @include('partials._footer')
  @include('partials._cookies')
</body>
</html>