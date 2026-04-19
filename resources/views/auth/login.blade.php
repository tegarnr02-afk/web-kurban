@extends('layouts.app')

@section('title', 'Masuk — Berkahin')

@section('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
/* ══════════════════════════════════════
   RESET & VARS
══════════════════════════════════════ */
:root {
  --green-deep:   #062e1f;
  --green-dark:   #0a4a2f;
  --green-mid:    #0d6b42;
  --green-bright: #12965e;
  --accent:       #e8c96a;
  --accent-light: #f5dfa0;
  --surface:      #ffffff;
  --text:         #111c17;
  --text-muted:   #5a7065;
  --text-faint:   #9bb0a8;
  --border:       #d6e8df;
  --bg:           #f4f8f6;
  --radius:       16px;
  --radius-sm:    10px;
  --radius-xs:    8px;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body {
  font-family: 'DM Sans', sans-serif;
  background: var(--bg);
  min-height: 100vh;
  color: var(--text);
}

/* ══════════════════════════════════════
   LAYOUT: full-page centered
══════════════════════════════════════ */
.login-wrapper {
  min-height: calc(100vh - var(--nav-h, 0px));
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 60px 20px;
  position: relative;
}

/* Background dekoratif */
.login-wrapper::before {
  content: '';
  position: absolute; inset: 0;
  background:
    radial-gradient(ellipse 80% 60% at 20% 10%, rgba(13,107,66,0.08) 0%, transparent 60%),
    radial-gradient(ellipse 60% 50% at 80% 90%, rgba(232,201,106,0.07) 0%, transparent 60%),
    var(--bg);
  z-index: 0;
}

/* Ornamen lingkaran besar */
.login-orb {
  position: absolute;
  border-radius: 50%;
  pointer-events: none;
  z-index: 0;
}
.login-orb-1 {
  width: 500px; height: 500px;
  top: -200px; right: -150px;
  background: radial-gradient(circle, rgba(13,107,66,0.07) 0%, transparent 70%);
}
.login-orb-2 {
  width: 400px; height: 400px;
  bottom: -150px; left: -120px;
  background: radial-gradient(circle, rgba(232,201,106,0.08) 0%, transparent 70%);
}

/* ── Card ── */
.login-card {
  width: 100%;
  max-width: 460px;
  background: var(--surface);
  border-radius: var(--radius);
  border: 1px solid rgba(214,232,223,0.8);
  box-shadow: 0 8px 40px rgba(6,46,31,0.10), 0 2px 8px rgba(6,46,31,0.06);
  padding: 48px 44px 40px;
  position: relative;
  z-index: 1;
  animation: cardReveal 0.65s cubic-bezier(0.22, 1, 0.36, 1) both;
  overflow: hidden;
}

/* Noise texture halus di dalam card */
.login-card::after {
  content: '';
  position: absolute; inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.025'/%3E%3C/svg%3E");
  pointer-events: none;
  border-radius: var(--radius);
}

/* Ornamen accent di sudut kanan atas card */
.card-corner-accent {
  position: absolute;
  top: -30px; right: -30px;
  width: 120px; height: 120px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(232,201,106,0.12) 0%, transparent 70%);
  pointer-events: none;
}

@keyframes cardReveal {
  from { opacity: 0; transform: translateY(24px) scale(0.99); }
  to   { opacity: 1; transform: translateY(0) scale(1); }
}

/* ── Logo ── */
.lc-logo {
  display: flex; align-items: center; gap: 10px;
  text-decoration: none; margin-bottom: 32px;
  width: fit-content;
}
.lc-logo-icon {
  width: 36px; height: 36px;
  background: var(--green-dark);
  border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
  font-size: 18px;
}
.lc-logo-text {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 20px; font-weight: 700;
  color: var(--text); letter-spacing: -0.3px;
}
.lc-logo-text span { color: var(--green-mid); }

/* ── Header form ── */
.lc-header { margin-bottom: 28px; }
.lc-greeting {
  display: inline-flex; align-items: center; gap: 7px;
  background: linear-gradient(135deg, #e8f5ee, #d0ede0);
  border: 1px solid rgba(13,107,66,0.15);
  color: var(--green-mid);
  font-size: 11.5px; font-weight: 600;
  padding: 5px 12px; border-radius: 20px;
  letter-spacing: 0.3px; margin-bottom: 14px;
}
.lc-greeting-dot {
  width: 6px; height: 6px; border-radius: 50%;
  background: var(--green-bright);
  animation: pulse 2s ease-in-out infinite;
}
@keyframes pulse {
  0%, 100% { opacity: 1; transform: scale(1); }
  50%       { opacity: 0.5; transform: scale(0.75); }
}

.lc-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 26px; font-weight: 700;
  color: var(--text); line-height: 1.25;
  margin-bottom: 6px;
}
.lc-title em { font-style: italic; color: var(--green-mid); }
.lc-sub {
  font-size: 13.5px; color: var(--text-muted); line-height: 1.6;
}
.lc-sub a {
  color: var(--green-mid); font-weight: 600; text-decoration: none;
}
.lc-sub a:hover { text-decoration: underline; }

/* ── Social login ── */
.lc-social { display: flex; gap: 10px; margin-bottom: 20px; }
.lc-social-btn {
  flex: 1; display: flex; align-items: center; justify-content: center; gap: 8px;
  padding: 10px 12px; border-radius: var(--radius-xs);
  border: 1.5px solid var(--border);
  background: white; cursor: pointer;
  font-size: 13px; font-weight: 500; color: var(--text);
  transition: all 0.2s;
  text-decoration: none;
}
.lc-social-btn:hover {
  border-color: var(--green-mid);
  background: #f4faf7;
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(13,107,66,0.1);
}

.lc-divider {
  display: flex; align-items: center; gap: 12px;
  margin-bottom: 20px;
  color: var(--text-faint); font-size: 12px;
}
.lc-divider::before, .lc-divider::after {
  content: ''; flex: 1; height: 1px; background: var(--border);
}

/* ── Form fields ── */
.lc-form { display: flex; flex-direction: column; gap: 15px; }

.lf-group { display: flex; flex-direction: column; gap: 6px; }
.lf-label {
  font-size: 13px; font-weight: 600;
  color: var(--text); letter-spacing: 0.1px;
}

.lf-input-wrap { position: relative; }
.lf-input-icon {
  position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
  color: var(--text-faint); pointer-events: none;
  transition: color 0.2s; display: flex;
}
.lf-input-wrap:focus-within .lf-input-icon { color: var(--green-mid); }

.lf-input {
  width: 100%;
  padding: 12px 14px 12px 42px;
  border: 1.5px solid var(--border);
  border-radius: var(--radius-xs);
  font-family: 'DM Sans', sans-serif;
  font-size: 14px; color: var(--text);
  background: white;
  transition: all 0.2s;
  outline: none;
}
.lf-input::placeholder { color: var(--text-faint); }
.lf-input:focus {
  border-color: var(--green-mid);
  box-shadow: 0 0 0 3px rgba(13,107,66,0.1);
}
.lf-input:hover:not(:focus) { border-color: #aacfc0; }

.lf-toggle-pw {
  position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
  color: var(--text-faint); cursor: pointer;
  background: none; border: none; padding: 2px;
  transition: color 0.2s; display: flex;
}
.lf-toggle-pw:hover { color: var(--green-mid); }

.lf-row {
  display: flex; align-items: center;
  justify-content: space-between;
  margin-top: -2px;
}
.lf-checkbox-wrap {
  display: flex; align-items: center; gap: 8px;
  cursor: pointer; font-size: 13px; color: var(--text-muted);
  user-select: none;
}
.lf-checkbox {
  width: 16px; height: 16px; border-radius: 4px;
  border: 1.5px solid var(--border);
  accent-color: var(--green-mid);
  cursor: pointer; flex-shrink: 0;
}
.lf-forgot {
  font-size: 13px; color: var(--green-mid); font-weight: 600;
  text-decoration: none;
}
.lf-forgot:hover { text-decoration: underline; }

/* ── Submit ── */
.lf-submit {
  width: 100%; padding: 13px 24px;
  border-radius: var(--radius-xs);
  background: var(--green-dark);
  color: white; border: none;
  font-family: 'DM Sans', sans-serif;
  font-size: 15px; font-weight: 600;
  cursor: pointer; letter-spacing: 0.2px;
  position: relative; overflow: hidden;
  transition: all 0.25s;
  margin-top: 4px;
  display: flex; align-items: center; justify-content: center; gap: 8px;
}
.lf-submit::before {
  content: '';
  position: absolute; inset: 0;
  background: linear-gradient(135deg, var(--green-mid), var(--green-dark));
  opacity: 0; transition: opacity 0.25s;
}
.lf-submit:hover::before { opacity: 1; }
.lf-submit:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(10,74,47,0.3); }
.lf-submit:active { transform: translateY(0); }
.lf-submit span, .lf-submit svg { position: relative; z-index: 1; }

.lf-submit-shimmer {
  position: absolute; inset: 0; z-index: 0;
  background: linear-gradient(105deg, transparent 40%, rgba(255,255,255,0.12) 50%, transparent 60%);
  background-size: 200% 100%;
  animation: shimmer 3s ease-in-out infinite;
}
@keyframes shimmer {
  0%   { background-position: 200% 0; }
  100% { background-position: -200% 0; }
}

/* ── Trust badges ── */
.lc-trust {
  display: flex; align-items: center; justify-content: center;
  gap: 20px; margin-top: 20px;
}
.lc-trust-item {
  display: flex; align-items: center; gap: 5px;
  font-size: 11px; color: var(--text-faint);
}
.lc-trust-item svg { color: var(--green-bright); }

/* ── Alert error ── */
.lc-alert {
  padding: 12px 16px;
  background: #fff5f5; border: 1px solid #fecaca;
  border-radius: var(--radius-xs);
  font-size: 13px; color: #dc2626;
  display: flex; align-items: flex-start; gap: 10px;
  margin-bottom: 16px;
}
.lc-alert svg { flex-shrink: 0; margin-top: 1px; }

/* ── Register link ── */
.lc-register {
  text-align: center;
  margin-top: 24px;
  font-size: 13.5px; color: var(--text-muted);
  padding-top: 20px;
  border-top: 1px solid var(--border);
}
.lc-register a {
  color: var(--green-mid); font-weight: 700;
  text-decoration: none; margin-left: 4px;
}
.lc-register a:hover { text-decoration: underline; }

/* ══════════════════════════════════════
   MOBILE
══════════════════════════════════════ */
@media (max-width: 520px) {
  .login-card { padding: 36px 24px 32px; }
  .lc-social { flex-direction: column; }
  .lf-row { flex-direction: column; align-items: flex-start; gap: 10px; }
}
</style>
@endsection

@section('content')

<div class="login-wrapper">
  <div class="login-orb login-orb-1"></div>
  <div class="login-orb login-orb-2"></div>

  <div class="login-card">
    <div class="card-corner-accent"></div>

    {{-- Logo --}}
    <a href="{{ url('/') }}" class="lc-logo">
      <div class="lc-logo-icon">🌿</div>
      <span class="lc-logo-text">Berka<span>hin</span></span>
    </a>

    {{-- Header --}}
    <div class="lc-header">
      <div class="lc-greeting">
        <span class="lc-greeting-dot"></span>
        Selamat Datang 
      </div>
      <h1 class="lc-title">Masuk ke <em>Berkahin</em></h1>
    </div>

    {{-- Login sosial --}}
    <div class="lc-social">
      <a href="{{ url('/auth/google') }}" class="lc-social-btn">
        <svg width="18" height="18" viewBox="0 0 24 24">
          <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
          <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
          <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
          <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
        </svg>
        Google
      </a>
      <a href="{{ url('/auth/facebook') }}" class="lc-social-btn">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="#1877F2">
          <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
        </svg>
        Facebook
      </a>
    </div>

    <div class="lc-divider">atau masuk dengan email</div>

    {{-- Pesan error --}}
    @if ($errors->any())
    <div class="lc-alert">
      <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
        <circle cx="8" cy="8" r="7" stroke="#dc2626" stroke-width="1.5"/>
        <path d="M8 5v3.5M8 10.5v.5" stroke="#dc2626" stroke-width="1.5" stroke-linecap="round"/>
      </svg>
      <span>{{ $errors->first() }}</span>
    </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('login') }}" method="POST" class="lc-form" id="loginForm">
      @csrf

      {{-- Email --}}
      <div class="lf-group">
        <label class="lf-label" for="email">Alamat Email</label>
        <div class="lf-input-wrap">
          <span class="lf-input-icon">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
              <rect x="1.5" y="3.5" width="13" height="9" rx="1.5" stroke="currentColor" stroke-width="1.4"/>
              <path d="M1.5 5.5l5.79 3.86a1.3 1.3 0 0 0 1.42 0L14.5 5.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
            </svg>
          </span>
          <input
            type="email" id="email" name="email"
            class="lf-input"
            placeholder="nama@email.com"
            value="{{ old('email') }}"
            autocomplete="email"
            required
          />
        </div>
      </div>

      {{-- Password --}}
      <div class="lf-group">
        <label class="lf-label" for="password">Kata Sandi</label>
        <div class="lf-input-wrap">
          <span class="lf-input-icon">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
              <rect x="3" y="7" width="10" height="7.5" rx="1.5" stroke="currentColor" stroke-width="1.4"/>
              <path d="M5.5 7V5a2.5 2.5 0 0 1 5 0v2" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
              <circle cx="8" cy="10.5" r="1" fill="currentColor"/>
            </svg>
          </span>
          <input
            type="password" id="password" name="password"
            class="lf-input"
            placeholder="Masukkan kata sandi"
            autocomplete="current-password"
            required
          />
          <button type="button" class="lf-toggle-pw" id="togglePw" aria-label="Tampilkan sandi">
            <svg id="eyeIcon" width="16" height="16" viewBox="0 0 16 16" fill="none">
              <path d="M1 8s2.5-4.5 7-4.5S15 8 15 8s-2.5 4.5-7 4.5S1 8 1 8z" stroke="currentColor" stroke-width="1.4"/>
              <circle cx="8" cy="8" r="2" stroke="currentColor" stroke-width="1.4"/>
            </svg>
          </button>
        </div>
      </div>

      {{-- Remember + Forgot --}}
      <div class="lf-row">
        <label class="lf-checkbox-wrap">
          <input type="checkbox" name="remember" class="lf-checkbox" id="remember">
          Ingat saya
        </label>
        <a href="{{ url('/forgot-password') }}" class="lf-forgot">Lupa sandi?</a>
      </div>

      {{-- Submit --}}
      <button type="submit" class="lf-submit">
        <div class="lf-submit-shimmer"></div>
        <span>Masuk Sekarang</span>
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
          <path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </button>

    </form>

    {{-- Trust badges --}}
    <div class="lc-trust">
      <div class="lc-trust-item">
        <svg width="13" height="13" viewBox="0 0 16 16" fill="none">
          <path d="M8 1.5l1.7 3.4 3.8.55-2.75 2.68.65 3.78L8 10.1l-3.4 1.79.65-3.78L2.5 5.45l3.8-.55L8 1.5z" stroke="currentColor" stroke-width="1.4" fill="currentColor"/>
        </svg>
        Terpercaya
      </div>
      <div class="lc-trust-item">
        <svg width="13" height="13" viewBox="0 0 16 16" fill="none">
          <path d="M8 1.5C5.5 2.5 2 3 2 3s-.5 6 2 9c1 1.3 2.4 2.3 4 2.8 1.6-.5 3-1.5 4-2.8 2.5-3 2-9 2-9S10.5 2.5 8 1.5z" stroke="currentColor" stroke-width="1.4"/>
          <path d="M5.5 8l2 2 3-3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Aman & Terenkripsi
      </div>
      <div class="lc-trust-item">
        <svg width="13" height="13" viewBox="0 0 16 16" fill="none">
          <circle cx="8" cy="8" r="6.5" stroke="currentColor" stroke-width="1.4"/>
          <path d="M5.5 8l2 2 3-3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Izin Resmi
      </div>
    </div>

    {{-- Daftar --}}
    <div class="lc-register">
      Belum punya akun?
      <a href="{{ url('/register') }}">Daftar sekarang, gratis!</a>
    </div>

  </div>{{-- end login-card --}}
</div>{{-- end login-wrapper --}}

@endsection

@push('scripts')
<script>
/* ── Toggle password visibility ── */
const togglePw = document.getElementById('togglePw');
const pwInput  = document.getElementById('password');
const eyeIcon  = document.getElementById('eyeIcon');

const eyeOpen = `<path d="M1 8s2.5-4.5 7-4.5S15 8 15 8s-2.5 4.5-7 4.5S1 8 1 8z" stroke="currentColor" stroke-width="1.4"/><circle cx="8" cy="8" r="2" stroke="currentColor" stroke-width="1.4"/>`;
const eyeOff  = `<path d="M2 2l12 12M6.5 6.6A2 2 0 0 0 8 10a2 2 0 0 0 1.5-.6M4.2 4.3C2.5 5.4 1 8 1 8s2.5 4.5 7 4.5c1.2 0 2.3-.25 3.2-.67M10.8 10.9C12.5 9.7 15 8 15 8s-2.5-4.5-7-4.5c-.4 0-.8.03-1.2.08" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>`;

togglePw.addEventListener('click', () => {
  const show = pwInput.type === 'password';
  pwInput.type = show ? 'text' : 'password';
  eyeIcon.innerHTML = show ? eyeOff : eyeOpen;
});

/* ── Submit button loading state ── */
document.getElementById('loginForm').addEventListener('submit', function () {
  const btn = this.querySelector('.lf-submit');
  btn.innerHTML = `
    <div class="lf-submit-shimmer"></div>
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" style="animation:spin .8s linear infinite">
      <circle cx="12" cy="12" r="9" stroke="rgba(255,255,255,.3)" stroke-width="2.5"/>
      <path d="M12 3a9 9 0 0 1 9 9" stroke="white" stroke-width="2.5" stroke-linecap="round"/>
    </svg>
    <span>Masuk...</span>
  `;
  btn.disabled = true;
  btn.style.opacity = '0.9';
});
</script>

<style>
@keyframes spin { to { transform: rotate(360deg); } }
</style>
@endpush