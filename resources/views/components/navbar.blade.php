{{--
    Navbar Component
    Usage: @include('components.navbar')
--}}

<style>
/* ══════════════════════════════════════
NAVBAR
══════════════════════════════════════ */
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

/* Inner wrapper pakai grid 3 kolom equal */
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
.nav-logo-mark {
  width: 36px; height: 36px; border-radius: 10px;
  background: var(--primary);
  display: flex; align-items: center; justify-content: center;
}
.nav-logo-mark svg { width: 20px; height: 20px; }
.nav-logo-text {
  font-size: 20px; font-weight: 700; color: var(--text);
  letter-spacing: -0.5px;
}
.nav-logo-text span { color: var(--primary); }

/* Kolom tengah — links */
.nav-links {
  display: flex; align-items: center; gap: 4px;
  list-style: none;
  justify-self: center;
}
.nav-links a {
  display: block; padding: 7px 14px;
  font-size: 14px; font-weight: 500; color: var(--text-md);
  text-decoration: none; border-radius: var(--radius-xs);
  transition: all 0.18s;
}
.nav-links a:hover { color: var(--primary); background: var(--primary-pale); }
.nav-links a.active {
  color: var(--primary); font-weight: 600;
  background: var(--primary-pale);
}

/* Kolom kanan — CTA */
.nav-cta {
  display: flex; align-items: center; gap: 10px;
  justify-self: end;
}
.btn-ghost {
  padding: 8px 18px; border-radius: var(--radius-xs);
  border: 1.5px solid var(--border-md);
  background: transparent; font-size: 14px; font-weight: 500;
  color: var(--text); cursor: pointer; font-family: var(--font-display);
  transition: all 0.18s; text-decoration: none;
  display: inline-flex; align-items: center;
}
.btn-ghost:hover { border-color: var(--primary); color: var(--primary); }
.btn-primary {
  padding: 8px 20px; border-radius: var(--radius-xs);
  background: var(--primary); color: white;
  border: none; font-size: 14px; font-weight: 600;
  cursor: pointer; font-family: var(--font-display);
  transition: all 0.18s; text-decoration: none;
  display: inline-flex; align-items: center; gap: 6px;
}
.btn-primary:hover { background: var(--primary-light); transform: translateY(-1px); }

.nav-burger {
  display: none; flex-direction: column; gap: 5px;
  cursor: pointer; padding: 6px;
  justify-self: end;
}
.nav-burger span { display: block; width: 22px; height: 2px; background: var(--text); border-radius: 2px; transition: all 0.25s; }

/* Mobile Menu */
.mobile-menu {
  display: none; position: fixed; top: var(--nav-h); left: 0; right: 0;
  background: var(--surface); border-bottom: 1px solid var(--border);
  padding: 16px 24px 24px; z-index: 999;
  flex-direction: column; gap: 4px;
}
.mobile-menu.open { display: flex; }
.mobile-menu a { padding: 10px 14px; font-size: 15px; font-weight: 500; color: var(--text-md); text-decoration: none; border-radius: var(--radius-xs); transition: all 0.15s; }
.mobile-menu a:hover { color: var(--primary); background: var(--primary-pale); }
.mobile-menu .m-divider { height: 1px; background: var(--border); margin: 8px 0; }
.mobile-menu .btn-primary { width: 100%; justify-content: center; margin-top: 4px; }

@media (max-width: 768px) {
  .navbar-inner { grid-template-columns: 1fr auto; padding: 0 20px; }
  .nav-links, .nav-cta { display: none; }
  .nav-burger { display: flex; }
}
</style>

<nav class="navbar" id="navbar">
  <div class="navbar-inner">

    {{-- Kiri: Logo --}}
    <a href="{{ url('/') }}" class="nav-logo">
      <div class="nav-logo-mark">
        <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M10 2C10 2 4 5.5 4 10.5C4 13.537 6.686 16 10 16C13.314 16 16 13.537 16 10.5C16 5.5 10 2 10 2Z" fill="white" opacity="0.9"/>
          <path d="M10 6C10 6 7 8 7 10.5C7 12.157 8.343 13.5 10 13.5C11.657 13.5 13 12.157 13 10.5C13 8 10 6 10 6Z" fill="white" opacity="0.5"/>
        </svg>
      </div>
      <span class="nav-logo-text">Berka<span>hin</span></span>
    </a>

    {{-- Tengah: Links --}}
    <ul class="nav-links">
      <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a></li>
      <li><a href="{{ url('/#donasi') }}">Donasi</a></li>
      <li><a href="{{ url('/#zakat') }}">Zakat</a></li>
      <li><a href="{{ url('/#blog') }}">Blog</a></li>
      <li><a href="{{ url('/#kontak') }}">Kontak</a></li>
    </ul>

    {{-- Kanan: CTA (desktop) & Burger (mobile) --}}
    <div class="nav-cta">
    <a href="{{ route('login') }}" class="btn-ghost">Masuk</a>
      <a href="{{ url('/#donasi') }}" class="btn-primary">
        <svg width="15" height="15" viewBox="0 0 15 15" fill="none"><path d="M7.5 1.5C4.186 1.5 1.5 4.186 1.5 7.5s2.686 6 6 6 6-2.686 6-6-2.686-6-6-6zm.75 9H6.75V6.75h1.5V10.5zm0-5.25H6.75V3.75h1.5v1.5z" fill="white"/></svg>
        Mulai Berdonasi
      </a>
    </div>

    <div class="nav-burger" id="burger" onclick="toggleMobile()">
      <span></span><span></span><span></span>
    </div>

  </div>
</nav>

<div class="mobile-menu" id="mobileMenu">
  <a href="{{ url('/') }}">Beranda</a>
  <a href="{{ url('/#donasi') }}">Donasi</a>
  <a href="{{ url('/#zakat') }}">Zakat</a>
  <a href="{{ url('/#blog') }}">Blog</a>
  <a href="{{ url('/#kontak') }}">Kontak</a>
  <div class="m-divider"></div>
  <a href="{{ route('login') }}" class="btn-ghost">Masuk</a>
  <a href="{{ url('/#donasi') }}" class="btn-primary">Mulai Berdonasi</a>
</div>

<script>
  window.addEventListener('scroll', () => {
    document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 10);
  });

  function toggleMobile() {
    document.getElementById('mobileMenu').classList.toggle('open');
  }

  document.addEventListener('click', function(e) {
    const menu = document.getElementById('mobileMenu');
    const burger = document.getElementById('burger');
    if (menu && burger && !menu.contains(e.target) && !burger.contains(e.target)) {
      menu.classList.remove('open');
    }
  });
</script>