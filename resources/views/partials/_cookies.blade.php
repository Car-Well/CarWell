{{-- Cookie Consent Popup --}}
<div id="cookie-popup" style="display:none;">
  <div class="cookie-overlay" id="cookie-overlay"></div>
  <div class="cookie-card">

    <div class="cookie-icon-wrap">
      <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#0F6E56" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
        <path d="M12 2a10 10 0 1 0 10 10 4 4 0 0 1-5-5 4 4 0 0 1-5-5"/>
        <circle cx="12" cy="12" r="1" fill="#0F6E56" stroke="none"/>
        <circle cx="8"  cy="14" r="1" fill="#0F6E56" stroke="none"/>
        <circle cx="15" cy="9"  r="1" fill="#0F6E56" stroke="none"/>
      </svg>
    </div>

    <div class="cookie-content">
      <p class="cookie-title">{{ __('cookies.titulo') }}</p>
      <p class="cookie-text">
        {{ __('cookies.texto') }}
        <a href="#" class="cookie-link">{{ __('cookies.politica') }}</a>.
      </p>

      <div class="cookie-options" id="cookie-options" style="display:none;">
        <label class="cookie-toggle">
          <input type="checkbox" checked disabled>
          <span class="cookie-toggle-slider"></span>
          <span class="cookie-toggle-label">{{ __('cookies.essenciais') }} <small>{{ __('cookies.obrigatorio') }}</small></span>
        </label>
        <label class="cookie-toggle">
          <input type="checkbox" id="cookie-analytics" checked>
          <span class="cookie-toggle-slider"></span>
          <span class="cookie-toggle-label">{{ __('cookies.analise') }}</span>
        </label>
        <label class="cookie-toggle">
          <input type="checkbox" id="cookie-marketing" checked>
          <span class="cookie-toggle-slider"></span>
          <span class="cookie-toggle-label">{{ __('cookies.marketing') }}</span>
        </label>
      </div>
    </div>

    <div class="cookie-actions">
      <button class="cookie-btn-config" onclick="toggleCookieOptions()" data-label-config="{{ __('cookies.configurar') }}" data-label-fechar="{{ __('cookies.fechar') }}">{{ __('cookies.configurar') }}</button>
      <button class="cookie-btn-essential" onclick="acceptEssential()">{{ __('cookies.essenciais_btn') }}</button>
      <button class="cookie-btn-accept" onclick="acceptAllCookies()">{{ __('cookies.aceitar') }}</button>
    </div>

  </div>
</div>

<style>
.cookie-overlay {
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,0.18);
  backdrop-filter: blur(2px);
  z-index: 9998;
  animation: cookieFadeIn 0.4s ease;
}

.cookie-card {
  position: fixed;
  bottom: 28px;
  left: 50%;
  transform: translateX(-50%);
  z-index: 9999;
  background: #fff;
  border-radius: 20px;
  box-shadow: 0 20px 60px rgba(15,110,86,0.18), 0 4px 16px rgba(0,0,0,0.08);
  padding: 28px 32px;
  width: min(560px, calc(100vw - 40px));
  display: flex;
  flex-direction: column;
  gap: 20px;
  animation: cookieSlideUp 0.45s cubic-bezier(0.34, 1.56, 0.64, 1);
  border-top: 3px solid #1D9E75;
}

@keyframes cookieFadeIn {
  from { opacity: 0; }
  to   { opacity: 1; }
}

@keyframes cookieSlideUp {
  from { opacity: 0; transform: translateX(-50%) translateY(40px); }
  to   { opacity: 1; transform: translateX(-50%) translateY(0); }
}

.cookie-icon-wrap {
  width: 52px;
  height: 52px;
  background: #E1F5EE;
  border-radius: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.cookie-title {
  font-family: 'Syne', sans-serif;
  font-size: 1rem;
  font-weight: 800;
  color: #1A1C19;
  margin-bottom: 6px;
}

.cookie-text {
  font-size: 0.82rem;
  color: #6B6E69;
  line-height: 1.6;
}

.cookie-link {
  color: #0F6E56;
  text-decoration: underline;
  text-underline-offset: 2px;
}

/* Toggles */
.cookie-options {
  margin-top: 12px;
  display: flex;
  flex-direction: column;
  gap: 10px;
  padding: 16px;
  background: #F4F5F3;
  border-radius: 12px;
  animation: cookieFadeIn 0.25s ease;
}

.cookie-toggle {
  display: flex;
  align-items: center;
  gap: 10px;
  cursor: pointer;
  user-select: none;
}

.cookie-toggle input { display: none; }

.cookie-toggle-slider {
  width: 36px;
  height: 20px;
  background: #d1d5db;
  border-radius: 999px;
  position: relative;
  flex-shrink: 0;
  transition: background 0.2s;
}

.cookie-toggle-slider::after {
  content: '';
  position: absolute;
  top: 3px;
  left: 3px;
  width: 14px;
  height: 14px;
  background: #fff;
  border-radius: 50%;
  transition: transform 0.2s;
  box-shadow: 0 1px 3px rgba(0,0,0,0.2);
}

.cookie-toggle input:checked + .cookie-toggle-slider { background: #1D9E75; }
.cookie-toggle input:checked + .cookie-toggle-slider::after { transform: translateX(16px); }
.cookie-toggle input:disabled + .cookie-toggle-slider { opacity: 0.5; cursor: not-allowed; }

.cookie-toggle-label {
  font-size: 0.8rem;
  color: #1A1C19;
  font-weight: 500;
}

.cookie-toggle-label small { color: #9EA19C; font-weight: 400; }

/* Buttons */
.cookie-actions {
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
}

.cookie-btn-config {
  background: none;
  border: 1.5px solid #d1d5db;
  color: #6B6E69;
  font-family: 'Syne', sans-serif;
  font-size: 0.72rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.06em;
  padding: 9px 16px;
  border-radius: 8px;
  cursor: pointer;
  transition: border-color 0.2s, color 0.2s;
}

.cookie-btn-config:hover { border-color: #0F6E56; color: #0F6E56; }

.cookie-btn-essential {
  background: #F4F5F3;
  border: none;
  color: #1A1C19;
  font-family: 'Syne', sans-serif;
  font-size: 0.72rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.06em;
  padding: 9px 16px;
  border-radius: 8px;
  cursor: pointer;
  transition: background 0.2s;
}

.cookie-btn-essential:hover { background: #e5e7e5; }

.cookie-btn-accept {
  background: linear-gradient(135deg, #1D9E75, #0F6E56);
  border: none;
  color: #fff;
  font-family: 'Syne', sans-serif;
  font-size: 0.72rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.06em;
  padding: 9px 20px;
  border-radius: 8px;
  cursor: pointer;
  margin-left: auto;
  transition: opacity 0.2s, transform 0.15s;
  box-shadow: 0 4px 14px rgba(15,110,86,0.3);
}

.cookie-btn-accept:hover { opacity: 0.9; transform: translateY(-1px); }

@media (max-width: 480px) {
  .cookie-card { padding: 22px 20px; bottom: 16px; }
  .cookie-btn-accept { margin-left: 0; width: 100%; }
}
</style>

<script>
(function() {
  const COOKIE_KEY = 'carwell_cookies';

  if (localStorage.getItem(COOKIE_KEY)) return;

  document.getElementById('cookie-popup').style.display = 'block';

  window.toggleCookieOptions = function() {
    const opts = document.getElementById('cookie-options');
    const btn  = document.querySelector('.cookie-btn-config');
    const open = opts.style.display === 'flex' || opts.style.display === '';
    opts.style.display = open ? 'none' : 'flex';
    btn.textContent    = open ? btn.dataset.labelConfig : btn.dataset.labelFechar;
  };

  window.acceptAllCookies = function() {
    localStorage.setItem(COOKIE_KEY, JSON.stringify({ essential: true, analytics: true, marketing: true }));
    closeCookiePopup();
  };

  window.acceptEssential = function() {
    const analytics  = document.getElementById('cookie-analytics')?.checked  ?? false;
    const marketing  = document.getElementById('cookie-marketing')?.checked  ?? false;
    localStorage.setItem(COOKIE_KEY, JSON.stringify({ essential: true, analytics, marketing }));
    closeCookiePopup();
  };

  function closeCookiePopup() {
    const card    = document.querySelector('.cookie-card');
    const overlay = document.getElementById('cookie-overlay');
    card.style.transition    = 'opacity 0.3s, transform 0.3s';
    card.style.opacity       = '0';
    card.style.transform     = 'translateX(-50%) translateY(20px)';
    overlay.style.transition = 'opacity 0.3s';
    overlay.style.opacity    = '0';
    setTimeout(() => document.getElementById('cookie-popup').style.display = 'none', 320);
  }
})();
</script>
