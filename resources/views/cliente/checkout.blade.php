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

  @include('partials._nav')

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

      <!-- Seletor de método -->
      <div style="display:flex; gap:8px; margin-bottom:24px;">
        <button id="tab-cartao" onclick="selectMethod('cartao')" style="flex:1; padding:11px; border:2px solid #0F6E56; border-radius:8px; background:#0F6E56; color:#fff; font-family:'Syne',sans-serif; font-size:0.75rem; font-weight:800; text-transform:uppercase; cursor:pointer;">
          Cartão de Crédito
        </button>
        <button id="tab-pix" onclick="selectMethod('pix')" style="flex:1; padding:11px; border:2px solid #e5e7eb; border-radius:8px; background:#fff; color:#6b7280; font-family:'Syne',sans-serif; font-size:0.75rem; font-weight:800; text-transform:uppercase; cursor:pointer;">
          Pix
        </button>
      </div>

      <!-- SEÇÃO CARTÃO -->
      <div id="section-cartao">
        <form class="payment-form" onsubmit="pagarCartao(event)">
          <input id="num-cartao" type="text" class="form-input" placeholder="{{ __('checkout.numero_cartao') }}" maxlength="19" oninput="formatCard(this)">
          <input id="titular" type="text" class="form-input" placeholder="{{ __('checkout.titular_cartao') }}">
          <input id="cvv" type="text" class="form-input cvv-input" placeholder="CVV" maxlength="4">

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
              <button type="submit" id="btn-pagar" class="btn-pagar">{{ __('checkout.pagar_agora') }}</button>
            </div>
          </div>
        </form>
      </div>

      <!-- SEÇÃO PIX -->
      <div id="section-pix" style="display:none;">
        <div style="display:flex; flex-direction:column; align-items:center; gap:20px; padding:16px 0;">

          <p style="font-family:'Syne',sans-serif; font-size:0.85rem; font-weight:800; text-transform:uppercase; color:#1a2e4a;">Escaneie o QR Code com o app do seu banco</p>

          <img src="https://api.qrserver.com/v1/create-qr-code/?size=190x190&data=00020126580014BR.GOV.BCB.PIX0136carwell%40pagamento.com.br5204000053039865802BR5907CarWell6009SAOPAULO6304ABCD"
               alt="QR Code Pix"
               style="border:4px solid #f3f4f6; border-radius:12px; padding:8px;">

          <p style="font-size:0.82rem; color:#6b7280;">Chave Pix: <strong style="color:#1a2e4a;">carwell@pagamento.com.br</strong></p>

          <div style="width:100%; max-width:440px;">
            <p style="font-size:0.72rem; color:#9EA19C; margin-bottom:6px; text-transform:uppercase; font-weight:700; letter-spacing:0.05em;">Pix Copia e Cola</p>
            <div style="display:flex; gap:8px;">
              <input id="pix-code" readonly
                value="00020126580014BR.GOV.BCB.PIX0136carwell@pagamento.com.br5204000053039865802BR5907CarWell6009SAOPAULO6304ABCD"
                style="flex:1; padding:10px 12px; border:1px solid #e5e7eb; border-radius:8px; font-size:0.7rem; color:#6b7280; background:#f9fafb; cursor:pointer; outline:none;">
              <button onclick="copiarPix()" id="btn-copiar"
                style="padding:10px 18px; background:#0F6E56; color:#fff; border:none; border-radius:8px; font-family:'Syne',sans-serif; font-size:0.72rem; font-weight:800; cursor:pointer; white-space:nowrap;">
                Copiar
              </button>
            </div>
          </div>

          <div style="width:100%; max-width:440px; background:#f0fdf4; border:1px solid #bbf7d0; border-radius:10px; padding:20px; text-align:center;">
            <p style="font-size:0.8rem; color:#15803d; margin-bottom:14px;">Aguardando confirmação do pagamento...</p>
            <button onclick="simularPix()" id="btn-simular-pix"
              style="width:100%; padding:13px; background:#0F6E56; color:#fff; border:none; border-radius:8px; font-family:'Syne',sans-serif; font-size:0.78rem; font-weight:800; text-transform:uppercase; cursor:pointer; letter-spacing:0.05em;">
              Já realizei o pagamento
            </button>
          </div>

        </div>
      </div>

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

    function selectMethod(method) {
      document.getElementById('section-cartao').style.display = method === 'cartao' ? 'block' : 'none';
      document.getElementById('section-pix').style.display    = method === 'pix'    ? 'block' : 'none';

      const ativo   = method === 'cartao' ? 'tab-cartao' : 'tab-pix';
      const inativo = method === 'cartao' ? 'tab-pix'    : 'tab-cartao';

      document.getElementById(ativo).style.cssText   += ';background:#0F6E56;color:#fff;border-color:#0F6E56;';
      document.getElementById(inativo).style.cssText += ';background:#fff;color:#6b7280;border-color:#e5e7eb;';
    }

    function finalizarPedido(metodoPagamento) {
      const cart = JSON.parse(localStorage.getItem('carwell_carrinho') || '{}');
      const ids  = Object.keys(cart);
      if (!ids.length) return;

      const form    = document.createElement('form');
      form.method   = 'POST';
      form.action   = '{{ route("pedido.store") }}';

      const csrf    = document.createElement('input');
      csrf.type     = 'hidden';
      csrf.name     = '_token';
      csrf.value    = '{{ csrf_token() }}';
      form.appendChild(csrf);

      ids.forEach(id => {
        const el  = document.createElement('input');
        el.type   = 'hidden';
        el.name   = 'carros[]';
        el.value  = id;
        form.appendChild(el);
      });

      const pag  = document.createElement('input');
      pag.type   = 'hidden';
      pag.name   = 'pagamento';
      pag.value  = metodoPagamento;
      form.appendChild(pag);

      document.body.appendChild(form);
      form.submit();
    }

    function pagarCartao(e) {
      e.preventDefault();
      const num     = document.getElementById('num-cartao').value.replace(/\s/g, '');
      const titular = document.getElementById('titular').value.trim();
      const cvv     = document.getElementById('cvv').value.trim();

      if (num.length < 16) { alert('Número do cartão inválido.'); return; }
      if (!titular)         { alert('Informe o titular do cartão.'); return; }
      if (cvv.length < 3)  { alert('CVV inválido.'); return; }

      const btn = document.getElementById('btn-pagar');
      btn.textContent   = 'Processando...';
      btn.disabled      = true;
      btn.style.opacity = '0.7';

      setTimeout(() => finalizarPedido('credito'), 2000);
    }

    function copiarPix() {
      navigator.clipboard.writeText(document.getElementById('pix-code').value);
      const btn = document.getElementById('btn-copiar');
      btn.textContent = 'Copiado!';
      setTimeout(() => btn.textContent = 'Copiar', 2000);
    }

    function simularPix() {
      const btn = document.getElementById('btn-simular-pix');
      btn.textContent   = 'Confirmando pagamento...';
      btn.disabled      = true;
      btn.style.opacity = '0.7';
      setTimeout(() => finalizarPedido('pix'), 2000);
    }

    function formatCard(input) {
      let v = input.value.replace(/\D/g, '').substring(0, 16);
      input.value = v.replace(/(.{4})/g, '$1 ').trim();
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

  @include('partials._footer')
  @include('partials._cookies')
</body>
</html>