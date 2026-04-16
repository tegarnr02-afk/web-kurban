<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Berkahin') — Platform Kebaikan Digital</title>
<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;12..96,500;12..96,600;12..96,700&family=Lora:ital,wght@0,500;0,600;1,400;1,500&display=swap" rel="stylesheet"/>
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
  --primary: #1a6b4a;
  --primary-light: #22875e;
  --primary-lighter: #2aaa76;
  --primary-pale: #e8f5ef;
  --primary-pale2: #d0eadc;
  --accent: #f0a500;
  --accent-light: #ffc94d;
  --text: #141414;
  --text-md: #3d3d3d;
  --text-muted: #717171;
  --text-hint: #a0a0a0;
  --bg: #f8f7f3;
  --bg2: #f2f0eb;
  --surface: #ffffff;
  --border: rgba(0,0,0,0.07);
  --border-md: rgba(0,0,0,0.12);
  --radius: 16px;
  --radius-sm: 10px;
  --radius-xs: 6px;
  --nav-h: 68px;
  --font-display: 'Bricolage Grotesque', sans-serif;
  --font-serif: 'Lora', serif;
}

html { scroll-behavior: smooth; }
body { font-family: var(--font-display); background: var(--bg); color: var(--text); overflow-x: hidden; }

/* ── NAVBAR ── */
.navbar {
  position: fixed; top: 0; left: 0; right: 0;
  height: var(--nav-h);
  background: rgba(255,255,255,0.92);
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  border-bottom: 1px solid var(--border);
  z-index: 1000;
  transition: box-shadow 0.3s;
}
.navbar.scrolled { box-shadow: 0 4px 24px rgba(0,0,0,0.07); }

.navbar-inner {
  display: grid;
  grid-template-columns: 1fr auto 1fr;
  align-items: center;
  height: 100%;
  padding: 0 32px;
}

.nav-logo {
  display: flex; align-items: center; gap: 10px;
  text-decoration: none; flex-shrink: 0;
  justify-self: start;
}
.nav-logo-mark { width: 36px; height: 36px; border-radius: 10px; background: var(--primary); display: flex; align-items: center; justify-content: center; }
.nav-logo-mark svg { width: 20px; height: 20px; }
.nav-logo-text { font-size: 20px; font-weight: 700; color: var(--text); letter-spacing: -0.5px; }
.nav-logo-text span { color: var(--primary); }

.nav-links {
  display: flex; align-items: center; gap: 4px;
  list-style: none;
  justify-self: center;
}
.nav-links a { display: block; padding: 7px 14px; font-size: 14px; font-weight: 500; color: var(--text-md); text-decoration: none; border-radius: var(--radius-xs); transition: all 0.18s; }
.nav-links a:hover { color: var(--primary); background: var(--primary-pale); }
.nav-links a.active { color: var(--primary); font-weight: 600; background: var(--primary-pale); }

.nav-cta {
  display: flex; align-items: center; gap: 10px;
  justify-self: end;
}
.btn-ghost { padding: 8px 18px; border-radius: var(--radius-xs); border: 1.5px solid var(--border-md); background: transparent; font-size: 14px; font-weight: 500; color: var(--text); cursor: pointer; font-family: var(--font-display); transition: all 0.18s; text-decoration: none; display: inline-flex; align-items: center; }
.btn-ghost:hover { border-color: var(--primary); color: var(--primary); }
.btn-primary-nav { padding: 8px 20px; border-radius: var(--radius-xs); background: var(--primary); color: white; border: none; font-size: 14px; font-weight: 600; cursor: pointer; font-family: var(--font-display); transition: all 0.18s; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; }
.btn-primary-nav:hover { background: var(--primary-light); transform: translateY(-1px); }

.nav-burger { display: none; flex-direction: column; gap: 5px; cursor: pointer; padding: 6px; justify-self: end; }
.nav-burger span { display: block; width: 22px; height: 2px; background: var(--text); border-radius: 2px; transition: all 0.25s; }

.mobile-menu { display: none; position: fixed; top: var(--nav-h); left: 0; right: 0; background: var(--surface); border-bottom: 1px solid var(--border); padding: 16px 24px 24px; z-index: 999; flex-direction: column; gap: 4px; }
.mobile-menu.open { display: flex; }
.mobile-menu a { padding: 10px 14px; font-size: 15px; font-weight: 500; color: var(--text-md); text-decoration: none; border-radius: var(--radius-xs); transition: all 0.15s; }
.mobile-menu a:hover { color: var(--primary); background: var(--primary-pale); }
.mobile-menu .m-divider { height: 1px; background: var(--border); margin: 8px 0; }
.mobile-menu .btn-primary-nav { width: 100%; justify-content: center; margin-top: 4px; }

@media (max-width: 768px) {
  .navbar-inner { grid-template-columns: 1fr auto; padding: 0 20px; }
  .nav-links, .nav-cta { display: none; }
  .nav-burger { display: flex; }
}

/* ── SECTION COMMONS ── */
.section { padding: 80px 0; }
.section-alt { background: var(--bg2); }
.container { max-width: 1100px; margin: 0 auto; padding: 0 32px; }

.section-header { margin-bottom: 48px; }
.section-eyebrow { display: inline-flex; align-items: center; gap: 8px; font-size: 12px; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; color: var(--primary); margin-bottom: 12px; }
.section-eyebrow::before { content: ''; width: 20px; height: 2px; background: var(--primary); border-radius: 2px; }
.section-title { font-family: var(--font-serif); font-size: clamp(24px, 3vw, 36px); font-weight: 600; line-height: 1.25; color: var(--text); margin-bottom: 12px; }
.section-title em { font-style: italic; color: var(--primary); }
.section-desc { font-size: 15px; color: var(--text-muted); line-height: 1.7; max-width: 520px; }
.section-header-row { display: flex; align-items: flex-end; justify-content: space-between; gap: 20px; flex-wrap: wrap; }
.btn-see-all { display: inline-flex; align-items: center; gap: 6px; padding: 10px 20px; border-radius: var(--radius-xs); border: 1.5px solid var(--primary); color: var(--primary); font-size: 14px; font-weight: 600; text-decoration: none; font-family: var(--font-display); transition: all 0.2s; white-space: nowrap; flex-shrink: 0; background: transparent; }
.btn-see-all:hover { background: var(--primary); color: white; }
.btn-see-all svg { transition: transform 0.2s; }
.btn-see-all:hover svg { transform: translateX(3px); }

/* ── STATS STRIP ── */
.stats-strip { background: var(--primary); padding: 48px 0; }
.stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 0; }
.stat-item { text-align: center; padding: 20px; border-right: 1px solid rgba(255,255,255,0.15); }
.stat-item:last-child { border-right: none; }
.stat-num { font-family: var(--font-serif); font-size: clamp(28px, 4vw, 44px); font-weight: 600; color: white; line-height: 1; }
.stat-num span { color: var(--accent-light); }
.stat-label { font-size: 13px; color: rgba(255,255,255,0.65); margin-top: 6px; }

/* ── REVEAL ANIMATIONS ── */
.reveal { opacity: 0; transform: translateY(24px); transition: opacity 0.6s ease, transform 0.6s ease; }
.reveal.visible { opacity: 1; transform: translateY(0); }
.reveal-delay-1 { transition-delay: 0.1s; }
.reveal-delay-2 { transition-delay: 0.2s; }
.reveal-delay-3 { transition-delay: 0.3s; }

/* ── FOOTER ── */
.footer { background: #0e1f15; color: rgba(255,255,255,0.75); padding: 72px 0 0; }
.footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 48px; padding-bottom: 56px; border-bottom: 1px solid rgba(255,255,255,0.08); }
.footer-logo { display: flex; align-items: center; gap: 10px; margin-bottom: 16px; }
.footer-logo-mark { width: 36px; height: 36px; border-radius: 10px; background: var(--primary); display: flex; align-items: center; justify-content: center; }
.footer-logo-text { font-size: 20px; font-weight: 700; color: white; letter-spacing: -0.5px; }
.footer-tagline { font-size: 14px; line-height: 1.7; color: rgba(255,255,255,0.55); margin-bottom: 24px; max-width: 260px; }
.footer-socials { display: flex; gap: 10px; }
.social-btn { width: 36px; height: 36px; border-radius: var(--radius-xs); background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.18s; text-decoration: none; }
.social-btn:hover { background: var(--primary); border-color: var(--primary); }
.footer-col-title { font-size: 13px; font-weight: 700; color: white; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 18px; }
.footer-links { list-style: none; display: flex; flex-direction: column; gap: 10px; }
.footer-links a { font-size: 14px; color: rgba(255,255,255,0.55); text-decoration: none; transition: color 0.18s; display: flex; align-items: center; gap: 6px; }
.footer-links a:hover { color: white; }
.footer-links a::before { content: ''; width: 4px; height: 4px; border-radius: 50%; background: var(--primary-lighter); flex-shrink: 0; opacity: 0; transition: opacity 0.18s; }
.footer-links a:hover::before { opacity: 1; }
.footer-contact-item { display: flex; align-items: flex-start; gap: 10px; font-size: 13px; color: rgba(255,255,255,0.55); margin-bottom: 12px; line-height: 1.5; }
.footer-contact-icon { width: 30px; height: 30px; border-radius: var(--radius-xs); background: rgba(255,255,255,0.06); flex-shrink: 0; display: flex; align-items: center; justify-content: center; margin-top: 1px; }
.footer-bottom { padding: 24px 0; display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap; }
.footer-copyright { font-size: 13px; color: rgba(255,255,255,0.35); }
.footer-copyright a { color: rgba(255,255,255,0.55); text-decoration: none; }
.footer-legal { display: flex; gap: 20px; }
.footer-legal a { font-size: 12px; color: rgba(255,255,255,0.35); text-decoration: none; transition: color 0.15s; }
.footer-legal a:hover { color: rgba(255,255,255,0.7); }
.footer-newsletter { background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: var(--radius); padding: 28px 32px; display: flex; align-items: center; justify-content: space-between; gap: 24px; margin-bottom: 56px; flex-wrap: wrap; }
.footer-newsletter-title { font-size: 16px; font-weight: 600; color: white; margin-bottom: 4px; }
.footer-newsletter-sub { font-size: 13px; color: rgba(255,255,255,0.45); }
.footer-newsletter-form { display: flex; gap: 10px; }
.newsletter-input { flex: 1; min-width: 220px; padding: 10px 16px; background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.12); border-radius: var(--radius-xs); color: white; font-size: 14px; font-family: var(--font-display); outline: none; transition: border-color 0.18s; }
.newsletter-input::placeholder { color: rgba(255,255,255,0.3); }
.newsletter-input:focus { border-color: var(--primary-lighter); }
.newsletter-btn { padding: 10px 20px; border-radius: var(--radius-xs); background: var(--primary); color: white; border: none; font-size: 14px; font-weight: 600; cursor: pointer; font-family: var(--font-display); transition: background 0.18s; white-space: nowrap; }
.newsletter-btn:hover { background: var(--primary-light); }

@media (max-width: 900px) { .footer-grid { grid-template-columns: 1fr 1fr; gap: 36px; } }
@media (max-width: 600px) {
  .footer-grid { grid-template-columns: 1fr; gap: 28px; }
  .footer-newsletter { padding: 20px; }
  .footer-newsletter-form { flex-direction: column; }
  .newsletter-input { min-width: unset; }
  .stats-grid { grid-template-columns: repeat(2, 1fr); }
  .stat-item { border-bottom: 1px solid rgba(255,255,255,0.15); }
  .stat-item:nth-child(2n) { border-right: none; }
  .stat-item:nth-last-child(-n+2) { border-bottom: none; }
  .container { padding: 0 20px; }
}

@yield('extra-styles')
</style>
@yield('styles')
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar" id="navbar">
  <div class="navbar-inner">

    <a href="{{ url('/') }}" class="nav-logo">
      <div class="nav-logo-mark">
        <svg viewBox="0 0 20 20" fill="none">
          <path d="M10 2C10 2 4 5.5 4 10.5C4 13.537 6.686 16 10 16C13.314 16 16 13.537 16 10.5C16 5.5 10 2 10 2Z" fill="white" opacity="0.9"/>
          <path d="M10 6C10 6 7 8 7 10.5C7 12.157 8.343 13.5 10 13.5C11.657 13.5 13 12.157 13 10.5C13 8 10 6 10 6Z" fill="white" opacity="0.5"/>
        </svg>
      </div>
      <span class="nav-logo-text">Berka<span>hin</span></span>
    </a>

    <ul class="nav-links">
      <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a></li>
      <li><a href="{{ url('/donasi') }}" class="{{ request()->is('donasi*') ? 'active' : '' }}">Donasi</a></li>
      <li><a href="{{ url('/zakat') }}" class="{{ request()->is('zakat*') ? 'active' : '' }}">Zakat</a></li>
      <li><a href="{{ url('/blog') }}" class="{{ request()->is('blog*') ? 'active' : '' }}">Blog</a></li>
      <li><a href="{{ url('/kontak') }}" class="{{ request()->is('kontak*') ? 'active' : '' }}">Kontak</a></li>
    </ul>

    <div class="nav-cta">
      <a href="{{ url('/login') }}" class="btn-ghost">Masuk</a>
      <a href="{{ url('/donasi') }}" class="btn-primary-nav">
        <svg width="15" height="15" viewBox="0 0 15 15" fill="none"><path d="M7.5 2C5.015 2 3 4.015 3 6.5s4.5 7.5 4.5 7.5S12 8.985 12 6.5 9.985 2 7.5 2zm0 6a1.5 1.5 0 110-3 1.5 1.5 0 010 3z" fill="white"/></svg>
        Mulai Berdonasi
      </a>
    </div>

    <div class="nav-burger" id="burger" onclick="toggleMobile()">
      <span></span><span></span><span></span>
    </div>

  </div>
</nav>

<div class="mobile-menu" id="mobileMenu">
  <a href="{{ url('/') }}" onclick="closeMobile()">Beranda</a>
  <a href="{{ url('/donasi') }}" onclick="closeMobile()">Donasi</a>
  <a href="{{ url('/zakat') }}" onclick="closeMobile()">Zakat</a>
  <a href="{{ url('/blog') }}" onclick="closeMobile()">Blog</a>
  <a href="{{ url('/kontak') }}" onclick="closeMobile()">Kontak</a>
  <div class="m-divider"></div>
  <a href="{{ url('/donasi') }}" class="btn-primary-nav" onclick="closeMobile()">Mulai Berdonasi</a>
</div>

{{-- MAIN CONTENT --}}
<main style="padding-top: var(--nav-h)">
  @yield('content')
</main>

{{-- FOOTER --}}
<footer class="footer" id="kontak">
  <div class="container">
    <div class="footer-newsletter">
      <div>
        <div class="footer-newsletter-title">Dapatkan Inspirasi Kebaikan</div>
        <div class="footer-newsletter-sub">Daftarkan email Anda untuk update campaign, artikel, dan program terbaru.</div>
      </div>
      <div class="footer-newsletter-form">
        <input type="email" class="newsletter-input" placeholder="alamat@email.com"/>
        <button class="newsletter-btn">Langganan</button>
      </div>
    </div>

    <div class="footer-grid">
      <div>
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
          <a href="#" class="social-btn"><svg width="16" height="16" viewBox="0 0 24 24" fill="rgba(255,255,255,0.6)"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>
          <a href="#" class="social-btn"><svg width="16" height="16" viewBox="0 0 24 24" fill="rgba(255,255,255,0.6)"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg></a>
          <a href="#" class="social-btn"><svg width="16" height="16" viewBox="0 0 24 24" fill="rgba(255,255,255,0.6)"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg></a>
        </div>
      </div>

      <div>
        <div class="footer-col-title">Navigasi</div>
        <ul class="footer-links">
          <li><a href="{{ url('/') }}">Beranda</a></li>
          <li><a href="{{ url('/donasi') }}">Donasi</a></li>
          <li><a href="{{ url('/zakat') }}">Zakat</a></li>
          <li><a href="{{ url('/blog') }}">Blog</a></li>
          <li><a href="{{ url('/kontak') }}">Kontak</a></li>
        </ul>
      </div>

      <div>
        <div class="footer-col-title">Program</div>
        <ul class="footer-links">
          <li><a href="{{ url('/donasi/qurban') }}">Qurban</a></li>
          <li><a href="{{ url('/zakat') }}">Zakat Fitrah</a></li>
          <li><a href="{{ url('/zakat') }}">Zakat Maal</a></li>
          <li><a href="{{ url('/donasi/beasiswa') }}">Beasiswa</a></li>
          <li><a href="{{ url('/donasi/palestina') }}">Donasi Darurat</a></li>
          <li><a href="{{ url('/wakaf') }}">Wakaf</a></li>
        </ul>
      </div>

      <div>
        <div class="footer-col-title">Hubungi Kami</div>
        <div class="footer-contact-item">
          <div class="footer-contact-icon"><svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M7 1.5C4.515 1.5 2.5 3.515 2.5 6c0 3 4.5 7 4.5 7s4.5-4 4.5-7c0-2.485-2.015-4.5-4.5-4.5zm0 6a1.5 1.5 0 110-3 1.5 1.5 0 010 3z" fill="rgba(255,255,255,0.5)"/></svg></div>
          <span>Jl. Kebaikan No. 1, Jakarta Selatan 12345</span>
        </div>
        <div class="footer-contact-item">
          <div class="footer-contact-icon"><svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2 3h10v8H2z" stroke="rgba(255,255,255,0.5)" stroke-width="1.2" fill="none"/><path d="M2 3l5 5 5-5" stroke="rgba(255,255,255,0.5)" stroke-width="1.2"/></svg></div>
          <span>halo@berkahin.id</span>
        </div>
        <div class="footer-contact-item">
          <div class="footer-contact-icon"><svg width="14" height="14" viewBox="0 0 14 14" fill="rgba(255,255,255,0.5)"><path d="M2.5 2h2.3l1 2.5-1.3 1.3a8 8 0 002.7 2.7l1.3-1.3L11 8.2V10.5a1 1 0 01-1 1A8.5 8.5 0 011.5 3a1 1 0 011-1z"/></svg></div>
          <span>+62 811-1234-5678</span>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <div class="footer-copyright">© {{ date('Y') }} <a href="{{ url('/') }}">Berkahin</a>. Semua hak cipta dilindungi.</div>
      <div class="footer-legal">
        <a href="#">Kebijakan Privasi</a>
        <a href="#">Syarat & Ketentuan</a>
        <a href="#">Laporan Keuangan</a>
      </div>
    </div>
  </div>
</footer>

<script>
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
  navbar.classList.toggle('scrolled', window.scrollY > 20);
});

function toggleMobile() {
  document.getElementById('mobileMenu').classList.toggle('open');
}
function closeMobile() {
  document.getElementById('mobileMenu').classList.remove('open');
}

document.addEventListener('click', function(e) {
  const menu = document.getElementById('mobileMenu');
  const burger = document.getElementById('burger');
  if (menu && burger && !menu.contains(e.target) && !burger.contains(e.target)) {
    menu.classList.remove('open');
  }
});

const reveals = document.querySelectorAll('.reveal');
const observer = new IntersectionObserver((entries) => {
  entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: 0.1 });
reveals.forEach(el => observer.observe(el));
</script>

@stack('scripts')
</body>
</html>