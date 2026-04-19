<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}"/>
  <title>@yield('title', 'Admin') — Berkahin</title>
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"/>
  <style>

    .main > *:first-child { margin-top: 0; }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --g9: #04342C; --g7: #085041; --g6: #0F6E56; --g5: #1D9E75;
      --g1: #9FE1CB; --g0: #E1F5EE;
      --txt: #111D17; --txt2: #3D5949; --txt3: #7A9588;
      --border: #E0E8E4; --bg: #F3F7F5; --card: #fff;
      --red: #E24B4A; --red0: #FCEBEB;
      --amber: #BA7517; --amber0: #FAEEDA;
      --blue: #185FA5; --blue0: #E6F1FB;
    }
    body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg); color: var(--txt); font-size: 13px; min-height: 100vh; }

    /* ── LAYOUT ── */
    .shell { display: flex; min-height: 100vh; }

    /* ── SIDEBAR ── */
    .sidebar { width: 200px; min-width: 200px; background: var(--g9); display: flex; flex-direction: column; position: fixed; top: 0; left: 0; height: 100vh; z-index: 100; }
    .sb-logo { padding: 18px 16px 14px; border-bottom: 1px solid rgba(255,255,255,.07); display: flex; align-items: center; gap: 9px; }
    .sb-dot { width: 26px; height: 26px; background: var(--g5); border-radius: 7px; display: flex; align-items: center; justify-content: center; }
    .sb-brand { font-size: 15px; font-weight: 700; color: #fff; letter-spacing: -.3px; }
    .sb-nav { flex: 1; padding: 10px 0; overflow-y: auto; }
    .sb-group { padding: 10px 14px 4px; font-size: 9px; font-weight: 700; color: rgba(255,255,255,.25); letter-spacing: .1em; text-transform: uppercase; }
    .sb-item { display: flex; align-items: center; gap: 8px; padding: 8px 14px; color: rgba(255,255,255,.5); font-size: 12px; font-weight: 500; cursor: pointer; transition: .15s; position: relative; text-decoration: none; }
    .sb-item:hover { background: rgba(255,255,255,.06); color: rgba(255,255,255,.8); }
    .sb-item.active { background: rgba(29,158,117,.2); color: #fff; }
    .sb-item.active::before { content: ''; position: absolute; left: 0; top: 5px; bottom: 5px; width: 2.5px; background: var(--g5); border-radius: 0 2px 2px 0; }
    .sb-item svg { width: 14px; height: 14px; flex-shrink: 0; opacity: .7; }
    .sb-item.active svg { opacity: 1; }
    .sb-foot { padding: 14px; border-top: 1px solid rgba(255,255,255,.07); display: flex; align-items: center; gap: 9px; }
    .sb-av { width: 28px; height: 28px; border-radius: 50%; background: var(--g5); display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 700; color: #fff; }
    .sb-un { font-size: 11px; font-weight: 600; color: #fff; }
    .sb-ur { font-size: 9px; color: rgba(255,255,255,.35); }

    /* ── MAIN ── */
    .main { flex: 1; margin-left: 200px; display: flex; flex-direction: column; min-width: 0; }
    .topbar { background: #fff; border-bottom: 1px solid var(--border); padding: 0 22px; height: 52px; display: flex; align-items: center; gap: 10px; position: sticky; top: 0; z-index: 50; }
    .breadcrumb { display: flex; align-items: center; gap: 6px; font-size: 12px; color: var(--txt3); }
    .breadcrumb .sep { opacity: .4; }
    .breadcrumb .cur { color: var(--txt); font-weight: 600; }
    .topbar-right { margin-left: auto; display: flex; align-items: center; gap: 8px; }

    /* ── CONTENT WRAPPER (PERBAIKAN OVERLAP SAAT SCROLL) ── */
    .main-content {
      padding-top: 52px;     /* ← ini yang memperbaiki topbar tidak menutupi konten */
    }

    /* ── BUTTONS ── */
    .btn-ghost { background: transparent; border: 1px solid var(--border); border-radius: 8px; padding: 6px 14px; font-size: 12px; font-weight: 500; color: var(--txt2); cursor: pointer; font-family: inherit; transition: .15s; text-decoration: none; display: inline-flex; align-items: center; }
    .btn-ghost:hover { background: var(--bg); }
    .btn-draft { background: var(--g0); color: var(--g6); border: 1px solid var(--g1); border-radius: 8px; padding: 6px 14px; font-size: 12px; font-weight: 600; cursor: pointer; font-family: inherit; transition: .15s; display: inline-flex; align-items: center; }
    .btn-draft:hover { background: var(--g1); }
    .btn-primary { background: var(--g6); color: #fff; border: none; border-radius: 8px; padding: 7px 16px; font-size: 12px; font-weight: 600; cursor: pointer; font-family: inherit; display: inline-flex; align-items: center; gap: 6px; transition: .15s; }
    .btn-primary:hover { background: var(--g7); }

    /* ── ALERTS ── */
    .alert-success { background: var(--g0); border: 1px solid var(--g1); color: var(--g6); border-radius: 8px; padding: 12px 16px; font-size: 12px; margin: 14px 22px 0; }
    .alert-error { background: var(--red0); border: 1px solid #F5C0BF; color: var(--red); border-radius: 8px; padding: 12px 16px; font-size: 12px; margin: 14px 22px 0; }

    @yield('extra-css')
  </style>
  @stack('styles')
</head>
<body>
<div class="shell">

  {{-- ════════════ SIDEBAR ════════════ --}}
  <aside class="sidebar">
    <div class="sb-logo">
      <div class="sb-dot">
        <svg viewBox="0 0 16 16" fill="none"><circle cx="8" cy="8" r="5.5" stroke="#fff" stroke-width="1.5"/><path d="M5.5 8.5l2 2 3-4" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </div>
      <span class="sb-brand">Berkahin</span>
    </div>

    <nav class="sb-nav">
      <div class="sb-group">Utama</div>
      <a href="{{ route('admin.dashboard') }}" class="sb-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <svg viewBox="0 0 14 14" fill="none"><rect x="1" y="1" width="5" height="5" rx="1" fill="currentColor"/><rect x="8" y="1" width="5" height="5" rx="1" fill="currentColor"/><rect x="1" y="8" width="5" height="5" rx="1" fill="currentColor"/><rect x="8" y="8" width="5" height="5" rx="1" fill="currentColor"/></svg>
        Dasbor
      </a>

      <div class="sb-group">Campaign</div>
      <a href="{{ route('admin.campaigns.index') }}" class="sb-item {{ request()->routeIs('admin.campaigns.index') ? 'active' : '' }}">
        <svg viewBox="0 0 14 14" fill="none"><path d="M2 4h10M2 7h10M2 10h6" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>
        Semua Campaign
      </a>
      <a href="{{ route('admin.campaigns.create') }}" class="sb-item {{ request()->routeIs('admin.campaigns.create') ? 'active' : '' }}">
        <svg viewBox="0 0 14 14" fill="none"><path d="M7 2v10M2 7h10" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
        Tambah Campaign
      </a>

      <div class="sb-group">Sistem</div>
      <a href="#" class="sb-item {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
        <svg viewBox="0 0 14 14" fill="none"><circle cx="7" cy="7" r="2" stroke="currentColor" stroke-width="1.2"/><path d="M7 1v1.5M7 11.5V13M1 7h1.5M11.5 7H13M3.2 3.2l1 1M9.8 9.8l1 1M3.2 10.8l1-1M9.8 4.2l1-1" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>
        Pengaturan
      </a>
    </nav>

    <div class="sb-foot">
      <div class="sb-av">A</div>
      <div>
        <div class="sb-un">Admin</div>
        <div class="sb-ur">Super Admin</div>
      </div>
    </div>
  </aside>

  {{-- ════════════ MAIN ════════════ --}}
  <div class="main">

    {{-- Topbar --}}
    <div class="topbar">
      <div class="breadcrumb">
        @yield('breadcrumb')
      </div>
      <div class="topbar-right">
        @yield('topbar-actions')
      </div>
    </div>

    {{-- Content wrapper (dengan padding agar tidak tertimpa) --}}
    <div class="main-content">

      {{-- Flash messages --}}
      @if(session('success'))
        <div class="alert-success">✓ {{ session('success') }}</div>
      @endif
      @if(session('error'))
        <div class="alert-error">✗ {{ session('error') }}</div>
      @endif

      {{-- Page content --}}
      @yield('content')

    </div>

  </div>
</div>

@stack('scripts')
</body>
</html>