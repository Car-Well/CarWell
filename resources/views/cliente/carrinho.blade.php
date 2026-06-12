<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="UTF-8" />
  <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>{{ __('carrinho.titulo') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/carrinho.css') }}">
  </head>
<body>

  @include('partials._nav')

  <main class="carrinho-container">

    @if($carros->isEmpty())
      <div style="text-align:center; padding:80px 0; color:#9EA19C;">
        <p style="font-family:'Syne',sans-serif; font-size:0.9rem; font-weight:800; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:8px; color:#6b7280;">{{ __('carrinho.vazio') }}</p>
        <p style="font-size:0.82rem;">{{ __('carrinho.vazio_texto') }}</p>
        <a href="{{ route('home') }}" style="display:inline-block; margin-top:20px; background:#0F6E56; color:#fff; font-family:'Syne',sans-serif; font-size:0.78rem; font-weight:800; text-transform:uppercase; letter-spacing:0.06em; padding:10px 24px; border-radius:8px; text-decoration:none;">{{ __('carrinho.ver_carros') }}</a>
      </div>
    @else

      <div id="cart-items">
        @foreach($carros as $carro)
          <div class="cart-item">
            <div class="cart-item-img-wrap">
              @if($carro->capa_path)
                <img src="{{ storage_url($carro->capa_path) }}" style="width:100%;height:100%;object-fit:cover;" alt="{{ $carro->veiculo_nome }}">
              @else
                <div class="cart-item-img-placeholder" style="background:linear-gradient(135deg,#2d3748,#4a5568);width:100%;height:100%;"></div>
              @endif
            </div>
            <div class="cart-item-details">
              <p class="cart-item-name">{{ strtoupper($carro->veiculo_nome) }}</p>
              <div class="cart-item-prices">
                <span class="cart-item-price-orig">R$ {{ number_format($carro->preco, 0, ',', '.') }}</span>
                <form method="POST" action="{{ route('carrinho.remover', $carro->id) }}" style="display:inline;">
                  @csrf
                  <button type="submit" class="cart-item-remove">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/>
                    </svg>
                  </button>
                </form>
              </div>
              <p class="cart-item-price-final">R$ {{ number_format($carro->preco, 0, ',', '.') }}</p>
            </div>
          </div>
        @endforeach
      </div>

      <div id="cart-footer">
        <div class="add-more-wrap">
          <a href="{{ route('home') }}" class="add-more-link">{{ __('carrinho.adicionar_mais') }}</a>
        </div>

        <div class="cart-summary">
          <div class="summary-row">
            <span class="summary-label">{{ __('carrinho.subtotal') }}</span>
            <span class="summary-value">R$ {{ number_format($total, 0, ',', '.') }}</span>
          </div>
          <div class="summary-row">
            <span class="summary-label">{{ __('carrinho.frete') }}</span>
            <span class="summary-value free">{{ __('carrinho.gratis') }}</span>
          </div>
          <div class="summary-row total-row">
            <span class="summary-label total-label">{{ __('carrinho.total') }}</span>
            <span class="summary-value total-value">R$ {{ number_format($total, 0, ',', '.') }}</span>
          </div>
        </div>

        <a href="{{ route('checkout') }}" class="btn-finalizar">{{ __('carrinho.finalizar') }}</a>

        <div class="payment-methods">
          <img src="{{ asset('img/payment/visa.svg') }}" alt="Visa" onerror="this.outerHTML='<span class=pay-icon>VISA</span>'">
          <img src="{{ asset('img/payment/mastercard.svg') }}" alt="Mastercard" onerror="this.outerHTML='<span class=pay-icon>MC</span>'">
          <img src="{{ asset('img/payment/amex.svg') }}" alt="Amex" onerror="this.outerHTML='<span class=pay-icon>AMEX</span>'">
          <img src="{{ asset('img/payment/elo.svg') }}" alt="Elo" onerror="this.outerHTML='<span class=pay-icon>ELO</span>'">
          <img src="{{ asset('img/payment/pix.svg') }}" alt="Pix" onerror="this.outerHTML='<span class=pay-icon>PIX</span>'">
        </div>
      </div>

    @endif

  </main>

  @include('partials._footer')
  @include('partials._cookies')
</body>
</html>
