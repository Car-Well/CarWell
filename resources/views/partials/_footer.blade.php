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
  background: linear-gradient(155deg, #1D9E75 0%, #0F6E56 40%, #0a4a38 100%);
  color: rgba(255,255,255,0.85);
  font-family: 'DM Sans', sans-serif;
  margin-top: 80px;
  position: relative;
  overflow: hidden;
}

.site-footer::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 3px;
  background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.35) 50%, transparent 100%);
}

.site-footer::after {
  content: '';
  position: absolute;
  width: 600px; height: 600px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(255,255,255,0.04) 0%, transparent 70%);
  top: -200px; right: -100px;
  pointer-events: none;
}

.footer-inner {
  max-width: 1200px;
  margin: 0 auto;
  padding: 68px 40px 48px;
  display: grid;
  grid-template-columns: 1.8fr 1fr 1fr;
  gap: 56px;
  position: relative;
  z-index: 1;
}

.footer-logo {
  height: 80px;
  object-fit: contain;
  filter: brightness(0) invert(1);
  margin-bottom: 18px;
  display: block;
  opacity: 0.92;
}

.footer-tagline {
  font-size: 0.85rem;
  color: rgba(255,255,255,0.6);
  margin-bottom: 28px;
  line-height: 1.65;
  max-width: 260px;
}

.footer-socials {
  display: flex;
  gap: 10px;
}

.footer-social-btn {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  border: 1px solid rgba(255,255,255,0.25);
  display: flex;
  align-items: center;
  justify-content: center;
  color: rgba(255,255,255,0.7);
  text-decoration: none;
  transition: all 0.22s;
}

.footer-social-btn:hover {
  background: rgba(255,255,255,0.18);
  color: #fff;
  border-color: rgba(255,255,255,0.55);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.footer-col-title {
  font-family: 'Syne', sans-serif;
  font-size: 0.7rem;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.12em;
  color: rgba(255,255,255,0.5);
  margin-bottom: 20px;
}

.footer-links {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 13px;
}

.footer-links a {
  font-size: 0.85rem;
  color: rgba(255,255,255,0.7);
  text-decoration: none;
  transition: color 0.2s, padding-left 0.2s;
  display: inline-block;
}

.footer-links a:hover {
  color: #fff;
  padding-left: 4px;
}

.footer-bottom {
  border-top: 1px solid rgba(255,255,255,0.1);
  max-width: 1200px;
  margin: 0 auto;
  padding: 22px 40px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 10px;
  position: relative;
  z-index: 1;
}

.footer-copy {
  font-size: 0.75rem;
  color: rgba(255,255,255,0.4);
}

.footer-legal {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 0.75rem;
  color: rgba(255,255,255,0.4);
}

.footer-legal a {
  color: rgba(255,255,255,0.4);
  text-decoration: none;
  transition: color 0.2s;
}

.footer-legal a:hover { color: rgba(255,255,255,0.8); }

@media (max-width: 768px) {
  .footer-inner {
    grid-template-columns: 1fr 1fr;
    gap: 36px;
    padding: 48px 24px 36px;
  }
  .footer-brand { grid-column: 1 / -1; }
  .footer-bottom {
    flex-direction: column;
    align-items: flex-start;
    padding: 20px 24px;
  }
}

@media (max-width: 480px) {
  .footer-inner { grid-template-columns: 1fr; }
}
</style>
