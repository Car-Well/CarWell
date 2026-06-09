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

  @include('partials._nav')

  <!-- PEDIDO -->
  @php
    $step = match($pedido->status) {
      'a_caminho'  => 2,
      'entregue'   => 3,
      'finalizado' => 4,
      default      => 1,
    };
  @endphp

  <main class="pedido-container">

    <div class="pedido-header-card">
      <div class="pedido-car-img">
        @if($pedido->carro->capa_path)
          <img src="{{ storage_url($pedido->carro->capa_path) }}" alt="{{ $pedido->carro->veiculo_nome }}" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
        @endif
        <div class="pedido-car-placeholder" style="{{ $pedido->carro->capa_path ? 'display:none' : '' }}"></div>
      </div>
      <div class="pedido-header-info">
        <p class="pedido-header-label">{{ __('pedido.seus_pedidos') }}</p>
        <p class="pedido-car-name">{{ strtoupper($pedido->carro->veiculo_nome) }}</p>
        <p class="pedido-car-price">R$ {{ number_format($pedido->valor, 0, ',', '.') }}</p>
      </div>
    </div>

    <div class="pedido-id-block">
      <p class="pedido-id-label">{{ __('pedido.id_pedido') }}</p>
      <p class="pedido-id">{{ $pedido->numero }}</p>
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
          <p class="timeline-date">{{ $pedido->created_at->format('d/m/Y – H:i') }}</p>
        </div>
      </div>

      <div class="timeline-step {{ $step >= 2 ? 'done' : '' }}">
        <div class="timeline-icon-wrap">
          <div class="timeline-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
              <circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>
            </svg>
          </div>
        </div>
        <div class="timeline-content">
          <p class="timeline-title">{{ __('pedido.em_transporte', ['cidade' => strtoupper($cliente->cidade ?? 'sua cidade')]) }}</p>
          @if($step >= 2) <p class="timeline-date">{{ $pedido->updated_at->format('d/m/Y – H:i') }}</p> @endif
        </div>
      </div>

      <div class="timeline-step {{ $step >= 3 ? 'done' : '' }}">
        <div class="timeline-icon-wrap">
          <div class="timeline-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
            </svg>
          </div>
        </div>
        <div class="timeline-content">
          <p class="timeline-title">{{ __('pedido.saiu_para_entrega') }}</p>
          @if($step >= 3) <p class="timeline-date">{{ $pedido->updated_at->format('d/m/Y – H:i') }}</p> @endif
        </div>
      </div>

      <div class="timeline-step {{ $step >= 4 ? 'delivered' : '' }}">
        <div class="timeline-icon-wrap">
          <div class="timeline-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="20 6 9 17 4 12"/>
            </svg>
          </div>
        </div>
        <div class="timeline-content">
          <p class="timeline-title">{{ __('pedido.pedido_entregue') }}</p>
          @if($step >= 4) <p class="timeline-date">{{ $pedido->updated_at->format('d/m/Y – H:i') }}</p> @endif
        </div>
      </div>

    </div>

  </main>

  <script>
    localStorage.removeItem('carwell_carrinho');

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

  @include('partials._footer')
  @include('partials._cookies')
</body>
</html>