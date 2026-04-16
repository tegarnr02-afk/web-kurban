{{--
    Footer Component
    Usage: @include('components.footer')
--}}

<style>
/* ══════════════════════════════════════
   FOOTER
══════════════════════════════════════ */
.footer {
  background: #0e1f15;
  color: rgba(255,255,255,0.75);
  padding: 72px 0 0;
}
.footer-grid {
  display: grid;
  grid-template-columns: 2fr 1fr 1fr 1fr;
  gap: 48px; padding-bottom: 56px;
  border-bottom: 1px solid rgba(255,255,255,0.08);
}

.footer-brand {}
.footer-logo {
  display: flex; align-items: center; gap: 10px;
  margin-bottom: 16px;
}
.footer-logo-mark {
  width: 36px; height: 36px; border-radius: 10px;
  background: var(--primary); display: flex; align-items: center; justify-content: center;
}
.footer-logo-text { font-size: 20px; font-weight: 700; color: white; letter-spacing: -0.5px; }
.footer-tagline { font-size: 14px; line-height: 1.7; color: rgba(255,255,255,0.55); margin-bottom: 24px; max-width: 260px; }

.footer-socials { display: flex; gap: 10px; }
.social-btn {
  width: 36px; height: 36px; border-radius: var(--radius-xs);
  background: rgba(255,255,255,0.07);
  border: 1px solid rgba(255,255,255,0.1);
  display: flex; align-items: center; justify-content: center;
  cursor: pointer; transition: all 0.18s;
  text-decoration: none;
}
.social-btn:hover { background: var(--primary); border-color: var(--primary); }
.social-btn svg { width: 16px; height: 16px; }

.footer-col-title {
  font-size: 13px; font-weight: 700; color: white;
  text-transform: uppercase; letter-spacing: 0.8px;
  margin-bottom: 18px;
}
.footer-links { list-style: none; display: flex; flex-direction: column; gap: 10px; }
.footer-links a {
  font-size: 14px; color: rgba(255,255,255,0.55);
  text-decoration: none; transition: color 0.18s;
  display: flex; align-items: center; gap: 6px;
}
.footer-links a:hover { color: white; }
.footer-links a::before {
  content: ''; width: 4px; height: 4px; border-radius: 50%;
  background: var(--primary-lighter); flex-shrink: 0;
  opacity: 0; transition: opacity 0.18s;
}
.footer-links a:hover::before { opacity: 1; }

.footer-contact-item {
  display: flex; align-items: flex-start; gap: 10px;
  font-size: 13px; color: rgba(255,255,255,0.55);
  margin-bottom: 12px; line-height: 1.5;
}
.footer-contact-icon {
  width: 30px; height: 30px; border-radius: var(--radius-xs);
  background: rgba(255,255,255,0.06); flex-shrink: 0;
  display: flex; align-items: center; justify-content: center; margin-top: 1px;
}
.footer-contact-icon svg { width: 14px; height: 14px; }

.footer-bottom {
  padding: 24px 0;
  display: flex; align-items: center; justify-content: space-between;
  gap: 16px; flex-wrap: wrap;
}
.footer-copyright { font-size: 13px; color: rgba(255,255,255,0.35); }
.footer-copyright a { color: rgba(255,255,255,0.55); text-decoration: none; }
.footer-copyright a:hover { color: white; }
.footer-legal { display: flex; gap: 20px; }
.footer-legal a { font-size: 12px; color: rgba(255,255,255,0.35); text-decoration: none; transition: color 0.15s; }
.footer-legal a:hover { color: rgba(255,255,255,0.7); }

.footer-newsletter {
  background: rgba(255,255,255,0.04);
  border: 1px solid rgba(255,255,255,0.08);
  border-radius: var(--radius);
  padding: 28px 32px;
  display: flex; align-items: center; justify-content: space-between;
  gap: 24px; margin-bottom: 56px; flex-wrap: wrap;
}
.footer-newsletter-title { font-size: 16px; font-weight: 600; color: white; margin-bottom: 4px; }
.footer-newsletter-sub { font-size: 13px; color: rgba(255,255,255,0.45); }
.footer-newsletter-form { display: flex; gap: 10px; }
.newsletter-input {
  flex: 1; min-width: 220px; padding: 10px 16px;
  background: rgba(255,255,255,0.07);
  border: 1px solid rgba(255,255,255,0.12);
  border-radius: var(--radius-xs);
  color: white; font-size: 14px; font-family: var(--font-display);
  outline: none; transition: border-color 0.18s;
}
.newsletter-input::placeholder { color: rgba(255,255,255,0.3); }
.newsletter-input:focus { border-color: var(--primary-lighter); }
.newsletter-btn {
  padding: 10px 20px; border-radius: var(--radius-xs);
  background: var(--primary); color: white;
  border: none; font-size: 14px; font-weight: 600;
  cursor: pointer; font-family: var(--font-display);
  transition: background 0.18s; white-space: nowrap;
}
.newsletter-btn:hover { background: var(--primary-light); }

@media (max-width: 900px) {
  .footer-grid { grid-template-columns: 1fr 1fr; gap: 36px; }
}
@media (max-width: 600px) {
  .footer-grid { grid-template-columns: 1fr; gap: 28px; }
  .footer-newsletter { padding: 20px; }
  .footer-newsletter-form { flex-direction: column; }
  .newsletter-input { min-width: unset; }
}
</style>

<footer class="footer" id="kontak">
  <div class="container">

    <!-- Newsletter -->
    <div class="footer-newsletter">
      <div class="footer-newsletter-left">
        <div class="footer-newsletter-title">Dapatkan Inspirasi Kebaikan</div>
        <div class="footer-newsletter-sub">Daftarkan email Anda untuk update campaign, artikel, dan program terbaru.</div>
      </div>
      <form class="footer-newsletter-form" action="{{ url('/newsletter/subscribe') }}" method="POST">
        @csrf
        <input type="email" name="email" class="newsletter-input" placeholder="alamat@email.com" required/>
        <button type="submit" class="newsletter-btn">Langganan</button>
      </form>
    </div>

    <!-- Main Grid -->
    <div class="footer-grid">

      <!-- Brand -->
      <div class="footer-brand">
        <div class="footer-logo">
          <div class="footer-logo-mark">
            <svg viewBox="0 0 20 20" fill="none" width="20" height="20">
              <path d="M10 2C10 2 4 5.5 4 10.5C4 13.537 6.686 16 10 16C13.314 16 16 13.537 16 10.5C16 5.5 10 2 10 2Z" fill="white" opacity="0.9"/>
              <path d="M10 6C10 6 7 8 7 10.5C7 12.157 8.343 13.5 10 13.5C11.657 13.5 13 12.157 13 10.5C13 8 10 6 10 6Z" fill="white" opacity="0.5"/>
            </svg>
          </div>
          <span class="footer-logo-text">Berkahin</span>
        </div>
        <p class="footer-tagline">Platform kebaikan digital yang menghubungkan donatur dengan program sosial terpercaya dan transparan di Indonesia.</p>
        <div class="footer-socials">
          <a href="#" class="social-btn" aria-label="Facebook">
            <svg viewBox="0 0 24 24" fill="rgba(255,255,255,0.6)"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
          </a>
          <a href="#" class="social-btn" aria-label="Instagram">
            <svg viewBox="0 0 24 24" fill="rgba(255,255,255,0.6)"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
          </a>
          <a href="#" class="social-btn" aria-label="TikTok">
            <svg viewBox="0 0 24 24" fill="rgba(255,255,255,0.6)"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.27 6.27 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.18 8.18 0 004.77 1.52V6.77a4.85 4.85 0 01-1-.08z"/></svg>
          </a>
          <a href="#" class="social-btn" aria-label="WhatsApp">
            <svg viewBox="0 0 24 24" fill="rgba(255,255,255,0.6)"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
          </a>
        </div>
      </div>

      <!-- Navigasi -->
      <div>
        <div class="footer-col-title">Navigasi</div>
        <ul class="footer-links">
          <li><a href="{{ url('/') }}">Beranda</a></li>
          <li><a href="{{ url('/#donasi') }}">Donasi</a></li>
          <li><a href="{{ url('/#zakat') }}">Zakat</a></li>
          <li><a href="{{ url('/#blog') }}">Blog</a></li>
          <li><a href="{{ url('/#kontak') }}">Kontak</a></li>
        </ul>
      </div>

      <!-- Program -->
      <div>
        <div class="footer-col-title">Program</div>
        <ul class="footer-links">
          <li><a href="{{ url('/program/qurban') }}">Qurban</a></li>
          <li><a href="{{ url('/program/zakat-fitrah') }}">Zakat Fitrah</a></li>
          <li><a href="{{ url('/program/zakat-maal') }}">Zakat Maal</a></li>
          <li><a href="{{ url('/program/beasiswa') }}">Beasiswa</a></li>
          <li><a href="{{ url('/program/donasi-darurat') }}">Donasi Darurat</a></li>
          <li><a href="{{ url('/program/wakaf') }}">Wakaf</a></li>
        </ul>
      </div>

      <!-- Kontak -->
      <div>
        <div class="footer-col-title">Hubungi Kami</div>
        <div class="footer-contact-item">
          <div class="footer-contact-icon">
            <svg viewBox="0 0 14 14" fill="none"><path d="M7 1.5C4.515 1.5 2.5 3.515 2.5 6c0 3 4.5 7 4.5 7s4.5-4 4.5-7c0-2.485-2.015-4.5-4.5-4.5zm0 6a1.5 1.5 0 110-3 1.5 1.5 0 010 3z" fill="rgba(255,255,255,0.5)"/></svg>
          </div>
          <span>Jl. Kebaikan No. 1, Jakarta Selatan, DKI Jakarta 12345</span>
        </div>
        <div class="footer-contact-item">
          <div class="footer-contact-icon">
            <svg viewBox="0 0 14 14" fill="none"><path d="M2 3h10v8H2z" stroke="rgba(255,255,255,0.5)" stroke-width="1.2" fill="none"/><path d="M2 3l5 5 5-5" stroke="rgba(255,255,255,0.5)" stroke-width="1.2"/></svg>
          </div>
          <span>halo@berkahin.id</span>
        </div>
        <div class="footer-contact-item">
          <div class="footer-contact-icon">
            <svg viewBox="0 0 14 14" fill="rgba(255,255,255,0.5)"><path d="M2.5 2h2.3l1 2.5-1.3 1.3a8 8 0 002.7 2.7l1.3-1.3L11 8.2V10.5a1 1 0 01-1 1A8.5 8.5 0 011.5 3a1 1 0 011-1z"/></svg>
          </div>
          <span>+62 811-1234-5678</span>
        </div>
        <div class="footer-contact-item">
          <div class="footer-contact-icon">
            <svg viewBox="0 0 14 14" fill="rgba(255,255,255,0.5)"><path d="M7 1C3.686 1 1 3.686 1 7s2.686 6 6 6 6-2.686 6-6-2.686-6-6-6zm.5 9H6.5V6.5h1V10zm0-4.5H6.5V4h1v1.5z"/></svg>
          </div>
          <span>Senin – Jumat, 08.00 – 17.00 WIB</span>
        </div>
      </div>

    </div>

    <!-- Bottom Bar -->
    <div class="footer-bottom">
      <div class="footer-copyright">
        © {{ date('Y') }} <a href="{{ url('/') }}">Berkahin</a>. Semua hak cipta dilindungi. Platform donasi terpercaya Indonesia.
      </div>
      <div class="footer-legal">
        <a href="{{ url('/kebijakan-privasi') }}">Kebijakan Privasi</a>
        <a href="{{ url('/syarat-ketentuan') }}">Syarat & Ketentuan</a>
        <a href="{{ url('/laporan-keuangan') }}">Laporan Keuangan</a>
      </div>
    </div>

  </div>
</footer>
