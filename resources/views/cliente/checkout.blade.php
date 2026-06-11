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

  <main class="checkout-container">

    <h1 class="checkout-title">{{ __('carrinho.finalizar') }}</h1>

    {{-- SEUS PEDIDOS --}}
    <div class="checkout-block">
      <p class="checkout-block-title">{{ __('checkout.seus_pedidos') }}</p>

      @foreach($carros as $carro)
        <div class="checkout-order-item">
          <div class="checkout-order-img">
            @if($carro->capa_path)
              <img src="{{ storage_url($carro->capa_path) }}" alt="{{ $carro->veiculo_nome }}">
            @else
              <div class="order-img-placeholder" style="background:linear-gradient(135deg,#2d3748,#4a5568);"></div>
            @endif
          </div>
          <div class="checkout-order-info">
            <p class="checkout-order-name">{{ strtoupper($carro->veiculo_nome) }}</p>
            <p class="checkout-order-price">R$ {{ number_format($carro->preco, 0, ',', '.') }}</p>
          </div>
        </div>
      @endforeach
    </div>

    {{-- DADOS DO PAGAMENTO --}}
    <div class="checkout-block">
      <p class="checkout-block-title">{{ __('checkout.dados_pagamento') }}</p>

      {{-- Seletor de método via GET --}}
      @php $metodo = request('metodo', 'cartao'); @endphp
      <div style="display:flex; gap:8px; margin-bottom:24px;">
        <a href="{{ request()->fullUrlWithQuery(['metodo' => 'cartao']) }}"
           style="flex:1; padding:11px; border:2px solid {{ $metodo === 'cartao' ? '#0F6E56' : '#e5e7eb' }}; border-radius:8px; background:{{ $metodo === 'cartao' ? '#0F6E56' : '#fff' }}; color:{{ $metodo === 'cartao' ? '#fff' : '#6b7280' }}; font-family:'Syne',sans-serif; font-size:0.75rem; font-weight:800; text-transform:uppercase; text-align:center; text-decoration:none; display:block;">
          Cartão de Crédito
        </a>
        <a href="{{ request()->fullUrlWithQuery(['metodo' => 'pix']) }}"
           style="flex:1; padding:11px; border:2px solid {{ $metodo === 'pix' ? '#0F6E56' : '#e5e7eb' }}; border-radius:8px; background:{{ $metodo === 'pix' ? '#0F6E56' : '#fff' }}; color:{{ $metodo === 'pix' ? '#fff' : '#6b7280' }}; font-family:'Syne',sans-serif; font-size:0.75rem; font-weight:800; text-transform:uppercase; text-align:center; text-decoration:none; display:block;">
          Pix
        </a>
      </div>

      {{-- CARTÃO --}}
      @if($metodo === 'cartao')
        <div style="display:flex; flex-direction:column; align-items:center; gap:16px; padding:8px 0;">
          <p style="font-family:'DM Sans',sans-serif; font-size:0.82rem; color:#6b7280; text-align:center; margin:0;">Você será redirecionado para a página segura do Stripe para concluir o pagamento.</p>

          <div style="display:flex; align-items:center; justify-content:space-between; width:100%; background:#f9fafb; border:1px solid #e5e7eb; border-radius:12px; padding:16px 20px;">
            <span style="font-family:'DM Sans',sans-serif; font-size:0.82rem; color:#6b7280;">{{ __('checkout.total') }}</span>
            <span style="font-family:'Syne',sans-serif; font-size:1.1rem; font-weight:800; color:#0F6E56;">R$ {{ number_format($total, 0, ',', '.') }}</span>
          </div>

          <form method="POST" action="{{ route('stripe.checkout') }}" style="width:100%;">
            @csrf
            <button type="submit" class="btn-pagar" style="width:100%;">{{ __('checkout.pagar_agora') }}</button>
          </form>

          <div style="display:flex; align-items:center; gap:6px;">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#9EA19C" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            <span style="font-size:0.72rem; color:#9EA19C; font-family:'DM Sans',sans-serif;">Pagamento protegido pelo Stripe</span>
          </div>
        </div>
      @endif

      {{-- PIX --}}
      @if($metodo === 'pix')
        <div style="display:flex; flex-direction:column; align-items:center; gap:20px; padding:16px 0;">

          <p style="font-family:'Syne',sans-serif; font-size:0.85rem; font-weight:800; text-transform:uppercase; color:#1A1C19;">Escaneie o QR Code com o app do seu banco</p>

          <img src="https://api.qrserver.com/v1/create-qr-code/?size=190x190&data=00020126580014BR.GOV.BCB.PIX0136carwell%40pagamento.com.br5204000053039865802BR5907CarWell6009SAOPAULO6304ABCD"
               alt="QR Code Pix"
               style="border:4px solid #f3f4f6; border-radius:12px; padding:8px;">

          <p style="font-size:0.82rem; color:#6B6E69;">Chave Pix: <strong style="color:#1A1C19;">carwell@pagamento.com.br</strong></p>

          <div style="width:100%; max-width:440px; background:#f0fdf4; border:1px solid #bbf7d0; border-radius:10px; padding:20px; text-align:center;">
            <p style="font-size:0.8rem; color:#15803d; margin-bottom:14px;">Após o pagamento, clique no botão abaixo para confirmar:</p>
            <form method="POST" action="{{ route('stripe.checkout') }}">
              @csrf
              <button type="submit" style="width:100%; padding:13px; background:#0F6E56; color:#fff; border:none; border-radius:8px; font-family:'Syne',sans-serif; font-size:0.78rem; font-weight:800; text-transform:uppercase; cursor:pointer; letter-spacing:0.05em;">
                Já realizei o pagamento
              </button>
            </form>
          </div>

        </div>
      @endif

    </div>

    <div class="payment-methods">
      <img src="{{ asset('img/payment/visa.svg') }}" alt="Visa" onerror="this.outerHTML='<span class=pay-icon>VISA</span>'">
      <img src="{{ asset('img/payment/mastercard.svg') }}" alt="Mastercard" onerror="this.outerHTML='<span class=pay-icon>MC</span>'">
      <img src="{{ asset('img/payment/amex.svg') }}" alt="Amex" onerror="this.outerHTML='<span class=pay-icon>AMEX</span>'">
      <img src="{{ asset('img/payment/elo.svg') }}" alt="Elo" onerror="this.outerHTML='<span class=pay-icon>ELO</span>'">
      <img src="{{ asset('img/payment/pix.svg') }}" alt="Pix" onerror="this.outerHTML='<span class=pay-icon>PIX</span>'">
    </div>

  </main>

  @include('partials._footer')
  @include('partials._cookies')
</body>
</html>
