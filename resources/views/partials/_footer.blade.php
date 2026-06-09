<footer class="site-footer">
  <div class="footer-inner">

    {{-- Coluna 1: Logo + tagline --}}
    <div class="footer-brand">
      <img src="{{ asset('img/logo.png') }}" alt="CarWell" class="footer-logo">
      <p class="footer-tagline">{{ __('footer.tagline') }}</p>
      <div class="footer-socials">
        <a href="#" class="footer-social-btn" aria-label="Instagram">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4.5"/>
            <circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/>
          </svg>
        </a>
        <a href="#" class="footer-social-btn" aria-label="YouTube">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 0 0 1.46 6.42 29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58 2.78 2.78 0 0 0 1.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.96-1.96A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/>
            <polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="currentColor" stroke="none"/>
          </svg>
        </a>
        <a href="#" class="footer-social-btn" aria-label="Facebook">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
          </svg>
        </a>
        <a href="#" class="footer-social-btn" aria-label="X / Twitter">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
          </svg>
        </a>
      </div>
    </div>

    {{-- Coluna 2: Navegação --}}
    <div class="footer-col">
      <p class="footer-col-title">{{ __('footer.nav_titulo') }}</p>
      <ul class="footer-links">
        <li><a href="{{ route('home') }}">{{ __('footer.nav_home') }}</a></li>
        <li><a href="{{ route('home') }}#marcas">{{ __('footer.nav_comprar') }}</a></li>
        <li><a href="{{ route('home') }}#por-que">{{ __('footer.nav_sobre') }}</a></li>
        <li><a href="{{ route('favoritos') }}">{{ __('footer.nav_favoritos') }}</a></li>
        <li><a href="{{ route('carrinho') }}">{{ __('footer.nav_carrinho') }}</a></li>
      </ul>
    </div>

    {{-- Coluna 3: Informações --}}
    <div class="footer-col">
      <p class="footer-col-title">{{ __('footer.info_titulo') }}</p>
      <ul class="footer-links">
        <li><a href="#">{{ __('footer.info_faq') }}</a></li>
        <li><a href="#">{{ __('footer.info_guia') }}</a></li>
        <li><a href="#">{{ __('footer.info_onde') }}</a></li>
        <li><a href="#">{{ __('footer.info_contato') }}</a></li>
        <li><a href="#">{{ __('footer.info_blog') }}</a></li>
      </ul>
    </div>

  </div>

  <div class="footer-bottom">
    <p class="footer-copy">{{ __('footer.direitos', ['year' => date('Y')]) }}</p>
    <div class="footer-legal">
      <a href="#">{{ __('footer.privacidade') }}</a>
      <span>·</span>
      <a href="#">{{ __('footer.termos') }}</a>
      <span>·</span>
      <a href="#">{{ __('footer.cookies_config') }}</a>
    </div>
  </div>
</footer>

<style>
.site-footer {
  background: linear-gradient(135deg, #3DBFA0 0%, #1D9E75 35%, #0F6E56 100%);
  color: rgba(255,255,255,0.85);
  font-family: 'DM Sans', sans-serif;
  margin-top: 80px;
}

.footer-inner {
  max-width: 1200px;
  margin: 0 auto;
  padding: 60px 32px 40px;
  display: grid;
  grid-template-columns: 1.6fr 1fr 1fr;
  gap: 48px;
}

.footer-logo {
  height: 96px;
  object-fit: contain;
  filter: brightness(0) invert(1);
  margin-bottom: 16px;
  display: block;
}

.footer-tagline {
  font-size: 0.82rem;
  color: rgba(255,255,255,0.6);
  margin-bottom: 24px;
  line-height: 1.5;
}

.footer-socials {
  display: flex;
  gap: 10px;
}

.footer-social-btn {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  border: 1px solid rgba(255,255,255,0.3);
  display: flex;
  align-items: center;
  justify-content: center;
  color: rgba(255,255,255,0.7);
  text-decoration: none;
  transition: background 0.2s, color 0.2s, border-color 0.2s;
}

.footer-social-btn:hover {
  background: rgba(255,255,255,0.15);
  color: #fff;
  border-color: rgba(255,255,255,0.6);
}

.footer-col-title {
  font-family: 'Syne', sans-serif;
  font-size: 0.72rem;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.1em;
  color: #fff;
  margin-bottom: 18px;
}

.footer-links {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.footer-links a {
  font-size: 0.82rem;
  color: rgba(255,255,255,0.65);
  text-decoration: none;
  transition: color 0.2s;
}

.footer-links a:hover {
  color: #fff;
}

.footer-bottom {
  border-top: 1px solid rgba(255,255,255,0.08);
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px 32px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 10px;
}

.footer-copy {
  font-size: 0.75rem;
  color: rgba(255,255,255,0.45);
}

.footer-legal {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 0.75rem;
  color: rgba(255,255,255,0.45);
}

.footer-legal a {
  color: rgba(255,255,255,0.45);
  text-decoration: none;
  transition: color 0.2s;
}

.footer-legal a:hover { color: #fff; }

@media (max-width: 768px) {
  .footer-inner {
    grid-template-columns: 1fr 1fr;
    gap: 32px;
  }
  .footer-brand { grid-column: 1 / -1; }
  .footer-bottom { flex-direction: column; align-items: flex-start; }
}

@media (max-width: 480px) {
  .footer-inner { grid-template-columns: 1fr; }
}
</style>
