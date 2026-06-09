<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>{{ __('meus_pedidos.titulo') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/meus-pedidos.css') }}">
  </head>
<body>

  @include('partials._nav')

  <main class="pedidos-page">

    <h1 class="pedidos-title">{{ __('meus_pedidos.titulo_h1') }} <span>{{ __('meus_pedidos.titulo_span') }}</span></h1>
    <p class="pedidos-subtitle">{{ __('meus_pedidos.subtitulo') }}</p>

    @if($pedidos->isEmpty())
      <div class="pedidos-empty">
        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#1a2e4a" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
          <line x1="3" y1="6" x2="21" y2="6"/>
          <path d="M16 10a4 4 0 0 1-8 0"/>
        </svg>
        <p>{{ __('meus_pedidos.nenhum_pedido') }}</p>
        <a href="{{ route('home') }}#marcas">{{ __('meus_pedidos.ver_veiculos') }}</a>
      </div>
    @else

      @php
        $statusLabel = [
          'em_separacao' => __('meus_pedidos.status_separacao'),
          'a_caminho'    => __('meus_pedidos.status_caminho'),
          'entregue'     => __('meus_pedidos.status_entregue'),
          'cancelado'    => __('meus_pedidos.status_cancelado'),
        ];
        $statusBadge = [
          'em_separacao' => 'badge-separacao',
          'a_caminho'    => 'badge-caminho',
          'entregue'     => 'badge-entregue',
          'cancelado'    => 'badge-cancelado',
        ];
      @endphp

      @foreach($pedidos as $pedido)
      <a href="{{ route('pedido.show', $pedido->id) }}" class="pedido-card">

        <div class="pedido-card-img">
          @if($pedido->carro->capa_path)
            <img src="{{ storage_url($pedido->carro->capa_path) }}"
                 alt="{{ $pedido->carro->veiculo_nome }}"
                 onerror="this.style.display='none'">
          @else
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" stroke-width="1.5">
              <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99z"/>
            </svg>
          @endif
        </div>

        <div class="pedido-card-info">
          <p class="pedido-card-numero">{{ $pedido->numero }} · {{ $pedido->created_at->format('d/m/Y') }}</p>
          <p class="pedido-card-nome">{{ strtoupper($pedido->carro->veiculo_nome) }}</p>
          <p class="pedido-card-data">{{ $pedido->carro->marca }} · {{ $pedido->carro->ano }}</p>
        </div>

        <div class="pedido-card-right">
          <span class="pedido-badge {{ $statusBadge[$pedido->status] ?? 'badge-separacao' }}">
            {{ $statusLabel[$pedido->status] ?? $pedido->status }}
          </span>
          <span class="pedido-card-valor">R$ {{ number_format($pedido->valor, 0, ',', '.') }}</span>
        </div>

        <div class="pedido-card-arrow">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="9 18 15 12 9 6"/>
          </svg>
        </div>

      </a>
      @endforeach

    @endif

  </main>

  @include('partials._footer')
  @include('partials._cookies')

  <script>
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
