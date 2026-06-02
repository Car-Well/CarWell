<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Carwell – {{ $carro ? strtoupper($carro->veiculo_nome) : 'Veículo' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="{{ asset('css/info_carro.css') }}">
  </head>
<body>

  @include('partials._nav')

  <!-- PRODUTO PRINCIPAL -->
  <section class="product-section">

    <!-- Sidebar esquerda -->
    <div class="product-sidebar">
      <button class="sidebar-btn active">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <rect x="3" y="3" width="18" height="18" rx="2"/><path d="M9 9h6M9 12h6M9 15h4"/>
        </svg>
      </button>
      <button class="sidebar-btn">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
        </svg>
      </button>
      <button class="sidebar-btn">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14"/>
        </svg>
      </button>
      <div class="sidebar-3d">3D</div>
    </div>

    <!-- Imagem do carro -->
    <div class="product-image-area">
      <div class="product-actions-top">
        <button class="action-icon-btn">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/>
            <polyline points="16 6 12 2 8 6"/><line x1="12" y1="2" x2="12" y2="15"/>
          </svg>
        </button>
        <button class="action-icon-btn heart-btn" onclick="toggleHeart(this)">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
          </svg>
        </button>
      </div>
      @if($carro && $carro->capa_path)
        <img id="mainCarImg" src="{{ asset('storage/' . $carro->capa_path) }}" alt="{{ $carro->veiculo_nome }}" class="product-main-img" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
      @else
        <img id="mainCarImg" src="{{ asset('img/carros/honda-civic.png') }}" alt="Veículo" class="product-main-img" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
      @endif
      <div class="product-img-placeholder" style="display:none">
        <svg viewBox="0 0 200 100" fill="none" width="200">
          <path d="M20 68 Q50 22 100 20 Q150 22 180 68" stroke="rgba(0,0,0,0.3)" stroke-width="4" fill="none" stroke-linecap="round"/>
          <rect x="12" y="65" width="176" height="24" rx="12" fill="rgba(0,0,0,0.2)"/>
          <circle cx="40" cy="92" r="13" fill="rgba(0,0,0,0.2)"/><circle cx="40" cy="92" r="7" fill="rgba(0,0,0,0.35)"/>
          <circle cx="160" cy="92" r="13" fill="rgba(0,0,0,0.2)"/><circle cx="160" cy="92" r="7" fill="rgba(0,0,0,0.35)"/>
        </svg>
      </div>

      @if($carro && $carro->fotos->count() > 1)
      <div class="photo-thumbnails">
        @foreach($carro->fotos->sortBy('ordem') as $foto)
          <button class="thumb-btn {{ $foto->is_capa ? 'active' : '' }}"
                  onclick="switchPhoto(this, '{{ asset('storage/' . $foto->path) }}')"
                  type="button">
            <img src="{{ asset('storage/' . $foto->path) }}" alt="Foto {{ $loop->iteration }}">
          </button>
        @endforeach
      </div>
      @php $totalFotos = $carro->fotos->count(); @endphp
      @if($totalFotos > 3)
      <button class="btn-ver-fotos" onclick="openGallery()">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
        Ver todas as fotos ({{ $totalFotos }})
      </button>
      @endif
      @endif

    </div>

    <!-- Info do produto -->
    <div class="product-info-area">
      <p class="product-label">
        {{ $carro ? strtoupper($carro->veiculo_nome) : 'HONDA CIVIC G12' }}
        @if($carro && $carro->ano) {{ $carro->ano }} @endif
      </p>
      <p class="product-price">
        @if($carro && $carro->preco)
          R$ {{ number_format($carro->preco, 0, ',', '.') }}
        @else
          R$ 708.900
        @endif
      </p>
      {{-- Descrição do admin --}}
      @if($carro && $carro->descricao)
      <div class="info-section">
        <p class="info-section-title">Descrição</p>
        <p class="carro-descricao">{{ $carro->descricao }}</p>
      </div>
      @endif

      <!-- Informações Básicas -->
      <div class="info-section">
        <p class="info-section-title">{{ __('info_carro.info_basicas') }}</p>

        <!-- Estoque ID -->
        <div class="accordion-item">
          <button class="accordion-trigger" onclick="toggleAccordion(this)">
            <span class="info-label">{{ __('info_carro.estoque_id') }}</span>
            <span class="accordion-right">
              <span class="accordion-preview">{{ $carro ? $carro->id : '–' }}</span>
              <svg class="accordion-arrow" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="6 9 12 15 18 9"/></svg>
            </span>
          </button>
          <div class="accordion-body">
            <div class="accordion-content">
              <div class="accordion-detail-row"><span>Código interno</span><span class="accordion-val">{{ $carro ? $carro->id . '-CW' : '–' }}</span></div>
              <div class="accordion-detail-row"><span>Disponibilidade</span><span class="accordion-val accent">{{ $carro ? ucfirst($carro->status) : 'Disponível' }}</span></div>
            </div>
          </div>
        </div>

        <!-- Ano / KM -->
        <div class="accordion-item">
          <button class="accordion-trigger" onclick="toggleAccordion(this)">
            <span class="info-label">{{ __('info_carro.ano') }}</span>
            <span class="accordion-right">
              <span class="accordion-preview">{{ $carro ? $carro->ano : '–' }}</span>
              <svg class="accordion-arrow" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="6 9 12 15 18 9"/></svg>
            </span>
          </button>
          <div class="accordion-body">
            <div class="accordion-content">
              <div class="accordion-detail-row"><span>Ano</span><span class="accordion-val">{{ $carro ? $carro->ano : '–' }}</span></div>
              <div class="accordion-detail-row"><span>Quilometragem</span><span class="accordion-val">{{ $carro && $carro->km ? number_format($carro->km, 0, ',', '.') . ' km' : '0 km' }}</span></div>
            </div>
          </div>
        </div>
      </div>

      <!-- Características -->
      <div class="info-section">
        <p class="info-section-title">{{ __('info_carro.caracteristicas') }}</p>

        <div class="accordion-item">
          <button class="accordion-trigger" onclick="toggleAccordion(this)">
            <span class="info-label">{{ __('info_carro.geral') }}</span>
            <svg class="accordion-arrow" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="6 9 12 15 18 9"/></svg>
          </button>
          <div class="accordion-body">
            <div class="accordion-content">
              <div class="accordion-detail-row"><span>Combustível</span><span class="accordion-val">{{ $carro && $carro->combustivel ? ucfirst($carro->combustivel) : '–' }}</span></div>
              <div class="accordion-detail-row"><span>Câmbio</span><span class="accordion-val">{{ $carro && $carro->cambio ? ucfirst($carro->cambio) : '–' }}</span></div>
              <div class="accordion-detail-row"><span>Cor</span><span class="accordion-val">{{ $carro && $carro->cor ? ucfirst($carro->cor) : '–' }}</span></div>
            </div>
          </div>
        </div>

      </div>

      <button class="btn-comprar" onclick="addToCart()">{{ __('info_carro.comprar') }}</button>
    </div>

  </section>

  <!-- VOCÊ TAMBÉM PODE SE INTERESSAR -->
  <section class="related-section">
    <div class="related-header">
      <h2 class="section-title-sm">{{ __('info_carro.tambem_interessar') }}</h2>
      <button class="related-arrow">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      </button>
    </div>
    <div class="related-grid">
      @forelse($relacionados as $rel)
      <a href="{{ route('carro.show', $rel->id) }}" class="related-card" style="text-decoration:none; color:inherit;">
        <div class="related-img-wrap">
          @if($rel->capa_path)
            <img src="{{ asset('storage/' . $rel->capa_path) }}" alt="{{ $rel->veiculo_nome }}" onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
            <div class="related-img-placeholder" style="display:none"></div>
          @else
            <div class="related-img-placeholder"></div>
          @endif
          <button class="related-heart" onclick="event.preventDefault(); toggleHeart(this)">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
          </button>
        </div>
        <p class="related-name">{{ strtoupper($rel->veiculo_nome) }}</p>
      </a>
      @empty
        <p style="color:#9EA19C; font-size:0.8rem;">Nenhum veículo relacionado.</p>
      @endforelse
    </div>
  </section>

  <!-- CATEGORIAS -->
  <section class="categories-section">
    <div class="related-header">
      <h2 class="section-title-sm">{{ __('info_carro.categorias') }}</h2>
    </div>
    <div class="categories-grid">
      <div class="category-card">
        <img src="{{ asset('img/categorias/vintage.jpg') }}" alt="Vintage" onerror="this.style.display='none'">
        <div class="category-overlay"></div>
        <span class="category-name">VINTAGE</span>
      </div>
      <div class="category-card">
        <img src="{{ asset('img/categorias/eletricos.jpg') }}" alt="Elétricos" onerror="this.style.display='none'">
        <div class="category-overlay"></div>
        <span class="category-name">ELÉTRICOS</span>
      </div>
      <div class="category-card">
        <img src="{{ asset('img/categorias/picapes.jpg') }}" alt="Picapes" onerror="this.style.display='none'">
        <div class="category-overlay"></div>
        <span class="category-name">PICAPES</span>
      </div>
    </div>
  </section>

  <script>
    function switchPhoto(btn, url) {
      document.getElementById('mainCarImg').src = url;
      document.querySelectorAll('.thumb-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
    }

    function toggleHeart(el) {
      el.classList.toggle('liked');
    }

    function toggleAccordion(trigger) {
      const item = trigger.closest('.accordion-item');
      const isOpen = item.classList.contains('open');

      // Fecha todos dentro da mesma info-section
      const section = item.closest('.info-section');
      section.querySelectorAll('.accordion-item.open').forEach(openItem => {
        openItem.classList.remove('open');
        openItem.querySelector('.accordion-body').style.maxHeight = null;
      });

      // Abre o clicado (se não estava aberto)
      if (!isOpen) {
        item.classList.add('open');
        const body = item.querySelector('.accordion-body');
        body.style.maxHeight = body.scrollHeight + 'px';
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

    function addToCart() {
      const id = {{ $carro ? $carro->id : 'null' }};
      if (!id) return;
      const cart = JSON.parse(localStorage.getItem('carwell_carrinho') || '{}');
      cart[id] = (cart[id] || 0) + 1;
      localStorage.setItem('carwell_carrinho', JSON.stringify(cart));
      window.location.href = "{{ route('carrinho') }}";
    }
  </script>

  @if($carro && $carro->fotos->count() > 1)
  @php $todasFotos = $carro->fotos->sortBy('ordem')->values(); @endphp
  <div class="gallery-modal-overlay" id="galleryModal">
    <div class="gallery-modal">
      <button class="gallery-modal-close" onclick="closeGallery()">&#x2715;</button>
      <button class="gallery-nav prev" onclick="galleryNav(-1)">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
      </button>
      <button class="gallery-nav next" onclick="galleryNav(1)">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      </button>
      <img id="galleryMainImg" class="gallery-modal-main" src="" alt="Foto do veículo">
      <div class="gallery-modal-strip" id="galleryStrip">
        @foreach($todasFotos as $i => $foto)
          <div class="gallery-strip-thumb {{ $i === 0 ? 'active' : '' }}"
               onclick="galleryGoTo({{ $i }})"
               id="gthumb-{{ $i }}">
            <img src="{{ asset('storage/' . $foto->path) }}" alt="Foto {{ $i + 1 }}">
          </div>
        @endforeach
      </div>
    </div>
  </div>

  <script>
    const galleryPhotos = @json($todasFotos->map(fn($f) => asset('storage/' . $f->path))->values());
    let galleryIndex = 0;

    function openGallery(startIndex) {
      galleryIndex = startIndex ?? 0;
      updateGalleryImg();
      document.getElementById('galleryModal').classList.add('open');
      document.body.style.overflow = 'hidden';
    }

    function closeGallery() {
      document.getElementById('galleryModal').classList.remove('open');
      document.body.style.overflow = '';
    }

    function galleryNav(dir) {
      galleryIndex = (galleryIndex + dir + galleryPhotos.length) % galleryPhotos.length;
      updateGalleryImg();
    }

    function galleryGoTo(index) {
      galleryIndex = index;
      updateGalleryImg();
    }

    function updateGalleryImg() {
      document.getElementById('galleryMainImg').src = galleryPhotos[galleryIndex];
      document.querySelectorAll('.gallery-strip-thumb').forEach((t, i) => {
        t.classList.toggle('active', i === galleryIndex);
      });
      const thumb = document.getElementById('gthumb-' + galleryIndex);
      if (thumb) thumb.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
    }

    document.getElementById('galleryModal').addEventListener('click', function(e) {
      if (e.target === this) closeGallery();
    });

    document.addEventListener('keydown', function(e) {
      if (!document.getElementById('galleryModal').classList.contains('open')) return;
      if (e.key === 'ArrowLeft') galleryNav(-1);
      if (e.key === 'ArrowRight') galleryNav(1);
      if (e.key === 'Escape') closeGallery();
    });
  </script>
  @endif

  @include('partials._footer')
  @include('partials._cookies')
</body>
</html>