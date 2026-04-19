@extends('layouts.app')

@section('title', 'Daftar — Berkahin')

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
   LAYOUT
══════════════════════════════════════ */
.register-wrapper {
  min-height: calc(100vh - var(--nav-h, 0px));
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 60px 20px;
  position: relative;
}

.register-wrapper::before {
  content: '';
  position: absolute; inset: 0;
  background:
    radial-gradient(ellipse 70% 50% at 10% 20%, rgba(13,107,66,0.08) 0%, transparent 60%),
    radial-gradient(ellipse 60% 50% at 90% 80%, rgba(232,201,106,0.07) 0%, transparent 60%),
    var(--bg);
  z-index: 0;
}

.register-orb {
  position: absolute;
  border-radius: 50%;
  pointer-events: none;
  z-index: 0;
}
.register-orb-1 {
  width: 500px; height: 500px;
  top: -180px; right: -160px;
  background: radial-gradient(circle, rgba(13,107,66,0.07) 0%, transparent 70%);
}
.register-orb-2 {
  width: 380px; height: 380px;
  bottom: -120px; left: -100px;
  background: radial-gradient(circle, rgba(232,201,106,0.08) 0%, transparent 70%);
}

/* ── Card ── */
.register-card {
  width: 100%;
  max-width: 520px;
  background: var(--surface);
  border-radius: var(--radius);
  border: 1px solid rgba(214,232,223,0.8);
  box-shadow: 0 8px 40px rgba(6,46,31,0.10), 0 2px 8px rgba(6,46,31,0.06);
  padding: 44px 44px 40px;
  position: relative;
  z-index: 1;
  animation: cardReveal 0.65s cubic-bezier(0.22, 1, 0.36, 1) both;
  overflow: hidden;
}

.register-card::after {
  content: '';
  position: absolute; inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.025'/%3E%3C/svg%3E");
  pointer-events: none;
  border-radius: var(--radius);
}

.card-corner-accent {
  position: absolute;
  top: -30px; right: -30px;
  width: 140px; height: 140px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(13,107,66,0.08) 0%, transparent 70%);
  pointer-events: none;
}
.card-corner-accent-2 {
  position: absolute;
  bottom: -40px; left: -40px;
  width: 160px; height: 160px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(232,201,106,0.07) 0%, transparent 70%);
  pointer-events: none;
}

@keyframes cardReveal {
  from { opacity: 0; transform: translateY(24px) scale(0.99); }
  to   { opacity: 1; transform: translateY(0) scale(1); }
}

/* ── Logo ── */
.rc-logo {
  display: flex; align-items: center; gap: 10px;
  text-decoration: none; margin-bottom: 28px;
  width: fit-content;
}
.rc-logo-icon {
  width: 36px; height: 36px;
  background: var(--green-dark);
  border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
  font-size: 18px;
}
.rc-logo-text {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 20px; font-weight: 700;
  color: var(--text); letter-spacing: -0.3px;
}
.rc-logo-text span { color: var(--green-mid); }

/* ── Header ── */
.rc-header { margin-bottom: 28px; }
.rc-badge {
  display: inline-flex; align-items: center; gap: 7px;
  background: linear-gradient(135deg, #e8f5ee, #d0ede0);
  border: 1px solid rgba(13,107,66,0.15);
  color: var(--green-mid);
  font-size: 11.5px; font-weight: 600;
  padding: 5px 12px; border-radius: 20px;
  letter-spacing: 0.3px; margin-bottom: 14px;
}
.rc-badge-dot {
  width: 6px; height: 6px; border-radius: 50%;
  background: var(--green-bright);
  animation: pulse 2s ease-in-out infinite;
}
@keyframes pulse {
  0%, 100% { opacity: 1; transform: scale(1); }
  50%       { opacity: 0.5; transform: scale(0.75); }
}

.rc-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 26px; font-weight: 700;
  color: var(--text); line-height: 1.25;
  margin-bottom: 6px;
}
.rc-title em { font-style: italic; color: var(--green-mid); }
.rc-sub {
  font-size: 13.5px; color: var(--text-muted); line-height: 1.6;
}
.rc-sub a {
  color: var(--green-mid); font-weight: 600; text-decoration: none;
}
.rc-sub a:hover { text-decoration: underline; }

/* ── Social ── */
.rc-social { display: flex; gap: 10px; margin-bottom: 20px; }
.rc-social-btn {
  flex: 1; display: flex; align-items: center; justify-content: center; gap: 8px;
  padding: 10px 12px; border-radius: var(--radius-xs);
  border: 1.5px solid var(--border);
  background: white; cursor: pointer;
  font-size: 13px; font-weight: 500; color: var(--text);
  transition: all 0.2s; text-decoration: none;
}
.rc-social-btn:hover {
  border-color: var(--green-mid);
  background: #f4faf7;
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(13,107,66,0.1);
}

.rc-divider {
  display: flex; align-items: center; gap: 12px;
  margin-bottom: 20px;
  color: var(--text-faint); font-size: 12px;
}
.rc-divider::before, .rc-divider::after {
  content: ''; flex: 1; height: 1px; background: var(--border);
}

/* ── Form ── */
.rc-form { display: flex; flex-direction: column; gap: 15px; }

/* Grid dua kolom untuk nama depan & belakang */
.rf-row-2 {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px;
}

.rf-group { display: flex; flex-direction: column; gap: 6px; }
.rf-label {
  font-size: 13px; font-weight: 600;
  color: var(--text); letter-spacing: 0.1px;
}

.rf-input-wrap { position: relative; }
.rf-input-icon {
  position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
  color: var(--text-faint); pointer-events: none;
  transition: color 0.2s; display: flex;
}
.rf-input-wrap:focus-within .rf-input-icon { color: var(--green-mid); }

.rf-input {
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
.rf-input::placeholder { color: var(--text-faint); }
.rf-input:focus {
  border-color: var(--green-mid);
  box-shadow: 0 0 0 3px rgba(13,107,66,0.1);
}
.rf-input:hover:not(:focus) { border-color: #aacfc0; }
.rf-input.is-valid {
  border-color: var(--green-bright);
}
.rf-input.is-invalid {
  border-color: #f87171;
  box-shadow: 0 0 0 3px rgba(248,113,113,0.12);
}

/* Toggle password */
.rf-toggle-pw {
  position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
  color: var(--text-faint); cursor: pointer;
  background: none; border: none; padding: 2px;
  transition: color 0.2s; display: flex;
}
.rf-toggle-pw:hover { color: var(--green-mid); }

/* Password strength bar */
.rf-strength {
  display: flex; flex-direction: column; gap: 6px;
  margin-top: 6px;
}
.rf-strength-bars {
  display: flex; gap: 4px;
}
.rf-strength-bar {
  flex: 1; height: 3px; border-radius: 2px;
  background: var(--border);
  transition: background 0.3s;
}
.rf-strength-bar.weak   { background: #f87171; }
.rf-strength-bar.medium { background: var(--accent); }
.rf-strength-bar.strong { background: var(--green-bright); }
.rf-strength-label {
  font-size: 11.5px; color: var(--text-faint);
  transition: color 0.3s;
}
.rf-strength-label.weak   { color: #f87171; }
.rf-strength-label.medium { color: #c9960a; }
.rf-strength-label.strong { color: var(--green-bright); }

/* Checkbox syarat */
.rf-terms-wrap {
  display: flex; align-items: flex-start; gap: 10px;
  font-size: 13px; color: var(--text-muted);
  line-height: 1.55;
}
.rf-checkbox {
  width: 16px; height: 16px; border-radius: 4px;
  accent-color: var(--green-mid);
  cursor: pointer; flex-shrink: 0;
  margin-top: 2px;
}
.rf-terms-wrap a {
  color: var(--green-mid); font-weight: 600; text-decoration: none;
}
.rf-terms-wrap a:hover { text-decoration: underline; }

/* Submit */
.rf-submit {
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
.rf-submit::before {
  content: '';
  position: absolute; inset: 0;
  background: linear-gradient(135deg, var(--green-mid), var(--green-dark));
  opacity: 0; transition: opacity 0.25s;
}
.rf-submit:hover::before { opacity: 1; }
.rf-submit:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(10,74,47,0.3); }
.rf-submit:active { transform: translateY(0); }
.rf-submit:disabled { opacity: 0.7; cursor: not-allowed; transform: none; }
.rf-submit span, .rf-submit svg { position: relative; z-index: 1; }

.rf-submit-shimmer {
  position: absolute; inset: 0; z-index: 0;
  background: linear-gradient(105deg, transparent 40%, rgba(255,255,255,0.12) 50%, transparent 60%);
  background-size: 200% 100%;
  animation: shimmer 3s ease-in-out infinite;
}
@keyframes shimmer {
  0%   { background-position: 200% 0; }
  100% { background-position: -200% 0; }
}

/* Alert error */
.rc-alert {
  padding: 12px 16px;
  background: #fff5f5; border: 1px solid #fecaca;
  border-radius: var(--radius-xs);
  font-size: 13px; color: #dc2626;
  display: flex; align-items: flex-start; gap: 10px;
  margin-bottom: 4px;
}
.rc-alert svg { flex-shrink: 0; margin-top: 1px; }

/* Alert success */
.rc-alert-success {
  padding: 12px 16px;
  background: #f0faf5; border: 1px solid #a7f3d0;
  border-radius: var(--radius-xs);
  font-size: 13px; color: var(--green-dark);
  display: flex; align-items: flex-start; gap: 10px;
  margin-bottom: 4px;
}

/* Trust badges */
.rc-trust {
  display: flex; align-items: center; justify-content: center;
  gap: 20px; margin-top: 20px;
}
.rc-trust-item {
  display: flex; align-items: center; gap: 5px;
  font-size: 11px; color: var(--text-faint);
}
.rc-trust-item svg { color: var(--green-bright); }

/* Login link */
.rc-login {
  text-align: center;
  margin-top: 24px;
  font-size: 13.5px; color: var(--text-muted);
  padding-top: 20px;
  border-top: 1px solid var(--border);
}
.rc-login a {
  color: var(--green-mid); font-weight: 700;
  text-decoration: none; margin-left: 4px;
}
.rc-login a:hover { text-decoration: underline; }

/* ══════════════════════════════════════
   MOBILE
══════════════════════════════════════ */
@media (max-width: 540px) {
  .register-card { padding: 36px 24px 32px; }
  .rf-row-2 { grid-template-columns: 1fr; }
  .rc-social { flex-direction: column; }
}
</style>
@endsection

@section('content')

<div class="register-wrapper">
  <div class="register-orb register-orb-1"></div>
  <div class="register-orb register-orb-2"></div>

  <div class="register-card">
    <div class="card-corner-accent"></div>
    <div class="card-corner-accent-2"></div>

    {{-- Logo --}}
    <a href="{{ url('/') }}" class="rc-logo">
      <div class="rc-logo-icon">🌿</div>
      <span class="rc-logo-text">Berka<span>hin</span></span>
    </a>

    {{-- Header --}}
    <div class="rc-header">
      <div class="rc-badge">
        <span class="rc-badge-dot"></span>
        Gratis & Mudah
      </div>
      <h1 class="rc-title">Buat Akun <em>Berkahin</em></h1>
      <p class="rc-sub">
        Sudah punya akun?
        <a href="{{ route('login') }}">Masuk di sini →</a>
      </p>
    </div>

    {{-- Social register --}}
    <div class="rc-social">
      <a href="{{ url('/auth/google') }}" class="rc-social-btn">
        <svg width="18" height="18" viewBox="0 0 24 24">
          <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
          <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
          <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
          <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
        </svg>
        Daftar dengan Google
      </a>
      <a href="{{ url('/auth/facebook') }}" class="rc-social-btn">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="#1877F2">
          <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
        </svg>
        Daftar dengan Facebook
      </a>
    </div>

    <div class="rc-divider">atau daftar dengan email</div>

    {{-- Error / Success --}}
    @if ($errors->any())
    <div class="rc-alert" style="margin-bottom:16px">
      <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
        <circle cx="8" cy="8" r="7" stroke="#dc2626" stroke-width="1.5"/>
        <path d="M8 5v3.5M8 10.5v.5" stroke="#dc2626" stroke-width="1.5" stroke-linecap="round"/>
      </svg>
      <span>{{ $errors->first() }}</span>
    </div>
    @endif

    @if (session('status'))
    <div class="rc-alert-success" style="margin-bottom:16px">
      <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
        <circle cx="8" cy="8" r="7" stroke="#0d6b42" stroke-width="1.5"/>
        <path d="M5 8l2 2 4-4" stroke="#0d6b42" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      <span>{{ session('status') }}</span>
    </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('register') }}" method="POST" class="rc-form" id="registerForm">
      @csrf

      {{-- Nama depan & belakang --}}
      <div class="rf-row-2">
        <div class="rf-group">
          <label class="rf-label" for="first_name">Nama Depan</label>
          <div class="rf-input-wrap">
            <span class="rf-input-icon">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                <circle cx="8" cy="5.5" r="2.5" stroke="currentColor" stroke-width="1.4"/>
                <path d="M2.5 13.5c0-3.038 2.462-5.5 5.5-5.5s5.5 2.462 5.5 5.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
              </svg>
            </span>
            <input
              type="text" id="first_name" name="first_name"
              class="rf-input"
              placeholder="Budi"
              value="{{ old('first_name') }}"
              autocomplete="given-name"
              required
            />
          </div>
        </div>

        <div class="rf-group">
          <label class="rf-label" for="last_name">Nama Belakang</label>
          <div class="rf-input-wrap">
            <span class="rf-input-icon">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                <circle cx="8" cy="5.5" r="2.5" stroke="currentColor" stroke-width="1.4"/>
                <path d="M2.5 13.5c0-3.038 2.462-5.5 5.5-5.5s5.5 2.462 5.5 5.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
              </svg>
            </span>
            <input
              type="text" id="last_name" name="last_name"
              class="rf-input"
              placeholder="Santoso"
              value="{{ old('last_name') }}"
              autocomplete="family-name"
            />
          </div>
        </div>
      </div>

      {{-- Email --}}
      <div class="rf-group">
        <label class="rf-label" for="email">Alamat Email</label>
        <div class="rf-input-wrap">
          <span class="rf-input-icon">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
              <rect x="1.5" y="3.5" width="13" height="9" rx="1.5" stroke="currentColor" stroke-width="1.4"/>
              <path d="M1.5 5.5l5.79 3.86a1.3 1.3 0 0 0 1.42 0L14.5 5.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
            </svg>
          </span>
          <input
            type="email" id="email" name="email"
            class="rf-input"
            placeholder="budi@email.com"
            value="{{ old('email') }}"
            autocomplete="email"
            required
          />
        </div>
      </div>

      {{-- No. HP (opsional) --}}
      <div class="rf-group">
        <label class="rf-label" for="phone">
          Nomor HP
          <span style="font-weight:400; color:var(--text-faint); font-size:12px;">(opsional)</span>
        </label>
        <div class="rf-input-wrap">
          <span class="rf-input-icon">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
              <rect x="4" y="1" width="8" height="14" rx="2" stroke="currentColor" stroke-width="1.4"/>
              <circle cx="8" cy="12" r="0.8" fill="currentColor"/>
            </svg>
          </span>
          <input
            type="tel" id="phone" name="phone"
            class="rf-input"
            placeholder="08xx-xxxx-xxxx"
            value="{{ old('phone') }}"
            autocomplete="tel"
          />
        </div>
      </div>

      {{-- Password --}}
      <div class="rf-group">
        <label class="rf-label" for="password">Kata Sandi</label>
        <div class="rf-input-wrap">
          <span class="rf-input-icon">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
              <rect x="3" y="7" width="10" height="7.5" rx="1.5" stroke="currentColor" stroke-width="1.4"/>
              <path d="M5.5 7V5a2.5 2.5 0 0 1 5 0v2" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
              <circle cx="8" cy="10.5" r="1" fill="currentColor"/>
            </svg>
          </span>
          <input
            type="password" id="password" name="password"
            class="rf-input"
            placeholder="Min. 8 karakter"
            autocomplete="new-password"
            required
          />
          <button type="button" class="rf-toggle-pw" id="togglePw1" aria-label="Tampilkan sandi">
            <svg id="eyeIcon1" width="16" height="16" viewBox="0 0 16 16" fill="none">
              <path d="M1 8s2.5-4.5 7-4.5S15 8 15 8s-2.5 4.5-7 4.5S1 8 1 8z" stroke="currentColor" stroke-width="1.4"/>
              <circle cx="8" cy="8" r="2" stroke="currentColor" stroke-width="1.4"/>
            </svg>
          </button>
        </div>

        {{-- Password strength --}}
        <div class="rf-strength" id="strengthWrap" style="display:none">
          <div class="rf-strength-bars">
            <div class="rf-strength-bar" id="bar1"></div>
            <div class="rf-strength-bar" id="bar2"></div>
            <div class="rf-strength-bar" id="bar3"></div>
            <div class="rf-strength-bar" id="bar4"></div>
          </div>
          <span class="rf-strength-label" id="strengthLabel">Terlalu pendek</span>
        </div>
      </div>

      {{-- Konfirmasi Password --}}
      <div class="rf-group">
        <label class="rf-label" for="password_confirmation">Konfirmasi Kata Sandi</label>
        <div class="rf-input-wrap">
          <span class="rf-input-icon">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
              <rect x="3" y="7" width="10" height="7.5" rx="1.5" stroke="currentColor" stroke-width="1.4"/>
              <path d="M5.5 7V5a2.5 2.5 0 0 1 5 0v2" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
              <path d="M6 10.5l1.5 1.5 2.5-2.5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
          <input
            type="password" id="password_confirmation" name="password_confirmation"
            class="rf-input"
            placeholder="Ulangi kata sandi"
            autocomplete="new-password"
            required
          />
          <button type="button" class="rf-toggle-pw" id="togglePw2" aria-label="Tampilkan sandi">
            <svg id="eyeIcon2" width="16" height="16" viewBox="0 0 16 16" fill="none">
              <path d="M1 8s2.5-4.5 7-4.5S15 8 15 8s-2.5 4.5-7 4.5S1 8 1 8z" stroke="currentColor" stroke-width="1.4"/>
              <circle cx="8" cy="8" r="2" stroke="currentColor" stroke-width="1.4"/>
            </svg>
          </button>
        </div>
      </div>

      {{-- Syarat & Ketentuan --}}
      <label class="rf-terms-wrap">
        <input type="checkbox" name="terms" class="rf-checkbox" id="terms" required>
        <span>
          Saya menyetujui
          <a href="{{ url('/terms') }}" target="_blank">Syarat & Ketentuan</a>
          serta
          <a href="{{ url('/privacy') }}" target="_blank">Kebijakan Privasi</a>
          Berkahin.
        </span>
      </label>

      {{-- Submit --}}
      <button type="submit" class="rf-submit" id="submitBtn">
        <div class="rf-submit-shimmer"></div>
        <span>Buat Akun Sekarang</span>
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
          <path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </button>

    </form>

    {{-- Trust badges --}}
    <div class="rc-trust">
      <div class="rc-trust-item">
        <svg width="13" height="13" viewBox="0 0 16 16" fill="none">
          <path d="M8 1.5C5.5 2.5 2 3 2 3s-.5 6 2 9c1 1.3 2.4 2.3 4 2.8 1.6-.5 3-1.5 4-2.8 2.5-3 2-9 2-9S10.5 2.5 8 1.5z" stroke="currentColor" stroke-width="1.4"/>
          <path d="M5.5 8l2 2 3-3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Data Aman
      </div>
      <div class="rc-trust-item">
        <svg width="13" height="13" viewBox="0 0 16 16" fill="none">
          <circle cx="8" cy="8" r="6.5" stroke="currentColor" stroke-width="1.4"/>
          <path d="M5.5 8l2 2 3-3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Gratis Selamanya
      </div>
      <div class="rc-trust-item">
        <svg width="13" height="13" viewBox="0 0 16 16" fill="none">
          <path d="M8 1.5l1.7 3.4 3.8.55-2.75 2.68.65 3.78L8 10.1l-3.4 1.79.65-3.78L2.5 5.45l3.8-.55L8 1.5z" stroke="currentColor" stroke-width="1.4" fill="currentColor"/>
        </svg>
        Terpercaya
      </div>
    </div>

    {{-- Login link --}}
    <div class="rc-login">
      Sudah punya akun?
      <a href="{{ route('login') }}">Masuk sekarang</a>
    </div>

  </div>{{-- end register-card --}}
</div>{{-- end register-wrapper --}}

@endsection

@push('scripts')
<script>
/* ── Toggle password 1 ── */
function makeToggle(btnId, inputId, iconId) {
  const btn   = document.getElementById(btnId);
  const input = document.getElementById(inputId);
  const icon  = document.getElementById(iconId);

  const eyeOpen = `<path d="M1 8s2.5-4.5 7-4.5S15 8 15 8s-2.5 4.5-7 4.5S1 8 1 8z" stroke="currentColor" stroke-width="1.4"/><circle cx="8" cy="8" r="2" stroke="currentColor" stroke-width="1.4"/>`;
  const eyeOff  = `<path d="M2 2l12 12M6.5 6.6A2 2 0 0 0 8 10a2 2 0 0 0 1.5-.6M4.2 4.3C2.5 5.4 1 8 1 8s2.5 4.5 7 4.5c1.2 0 2.3-.25 3.2-.67M10.8 10.9C12.5 9.7 15 8 15 8s-2.5-4.5-7-4.5c-.4 0-.8.03-1.2.08" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>`;

  btn.addEventListener('click', () => {
    const show = input.type === 'password';
    input.type = show ? 'text' : 'password';
    icon.innerHTML = show ? eyeOff : eyeOpen;
  });
}

makeToggle('togglePw1', 'password', 'eyeIcon1');
makeToggle('togglePw2', 'password_confirmation', 'eyeIcon2');

/* ── Password strength meter ── */
const pwInput      = document.getElementById('password');
const strengthWrap = document.getElementById('strengthWrap');
const strengthLbl  = document.getElementById('strengthLabel');
const bars         = [
  document.getElementById('bar1'),
  document.getElementById('bar2'),
  document.getElementById('bar3'),
  document.getElementById('bar4'),
];

function calcStrength(pw) {
  let score = 0;
  if (pw.length >= 8)  score++;
  if (pw.length >= 12) score++;
  if (/[A-Z]/.test(pw) && /[a-z]/.test(pw)) score++;
  if (/[0-9]/.test(pw)) score++;
  if (/[^A-Za-z0-9]/.test(pw)) score++;
  return Math.min(score, 4);
}

pwInput.addEventListener('input', () => {
  const val = pwInput.value;
  if (!val) { strengthWrap.style.display = 'none'; return; }

  strengthWrap.style.display = 'flex';
  const score = calcStrength(val);

  const levelClass = score <= 1 ? 'weak' : score <= 2 ? 'medium' : 'strong';
  const levelText  = score <= 1 ? 'Terlalu lemah' : score <= 2 ? 'Cukup kuat' : score === 3 ? 'Kuat' : 'Sangat kuat';

  bars.forEach((bar, i) => {
    bar.className = 'rf-strength-bar';
    if (i < score) bar.classList.add(levelClass);
  });

  strengthLbl.className = `rf-strength-label ${levelClass}`;
  strengthLbl.textContent = levelText;
});

/* ── Konfirmasi password match ── */
const pwConfirm = document.getElementById('password_confirmation');

pwConfirm.addEventListener('input', () => {
  if (!pwConfirm.value) {
    pwConfirm.classList.remove('is-valid', 'is-invalid');
    return;
  }
  const match = pwConfirm.value === pwInput.value;
  pwConfirm.classList.toggle('is-valid',   match);
  pwConfirm.classList.toggle('is-invalid', !match);
});

/* ── Submit loading state ── */
document.getElementById('registerForm').addEventListener('submit', function (e) {
  // Cek konfirmasi password sebelum submit
  if (pwInput.value !== pwConfirm.value) {
    e.preventDefault();
    pwConfirm.classList.add('is-invalid');
    pwConfirm.focus();
    return;
  }

  const btn = document.getElementById('submitBtn');
  btn.innerHTML = `
    <div class="rf-submit-shimmer"></div>
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" style="animation:spin .8s linear infinite">
      <circle cx="12" cy="12" r="9" stroke="rgba(255,255,255,.3)" stroke-width="2.5"/>
      <path d="M12 3a9 9 0 0 1 9 9" stroke="white" stroke-width="2.5" stroke-linecap="round"/>
    </svg>
    <span>Membuat akun...</span>
  `;
  btn.disabled = true;
});
</script>

<style>
@keyframes spin { to { transform: rotate(360deg); } }
</style>
@endpush