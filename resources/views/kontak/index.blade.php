@extends('layouts.app')

@section('title', 'Kontak — Berkahin')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
/* ══════════════════════════════════════
   GLOBAL RESET & VARS
══════════════════════════════════════ */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
  --green-950: #052e16;
  --green-900: #14532d;
  --green-800: #166534;
  --green-700: #15803d;
  --green-600: #16a34a;
  --green-500: #22c55e;
  --green-400: #4ade80;
  --green-300: #86efac;
  --green-100: #dcfce7;
  --green-50:  #f0fdf4;
  --gold:      #d4a843;
  --gold-light:#fef3c7;
  --cream:     #fdfaf5;
  --dark:      #0f1a10;
  --font-display: 'Playfair Display', Georgia, serif;
  --font-body:    'DM Sans', sans-serif;
  --ease-out: cubic-bezier(0.16, 1, 0.3, 1);
}

body { font-family: var(--font-body); background: var(--cream); color: var(--dark); }

/* ══════════════════════════════════════
   HERO
══════════════════════════════════════ */
.hero {
  position: relative;
  background: var(--green-950);
  min-height: 88vh;
  display: flex;
  align-items: center;
  overflow: hidden;
  padding: 0 40px;
}

.hero-bg-rings {
  position: absolute; inset: 0; pointer-events: none;
}
.hero-ring {
  position: absolute;
  border-radius: 50%;
  border: 1px solid rgba(255,255,255,0.05);
}
.hero-ring:nth-child(1) { width: 600px; height: 600px; right: -200px; top: -200px; }
.hero-ring:nth-child(2) { width: 900px; height: 900px; right: -400px; top: -400px; border-color: rgba(255,255,255,0.03); }
.hero-ring:nth-child(3) { width: 400px; height: 400px; left: -100px; bottom: -150px; }

.hero-leaf {
  position: absolute;
  right: 8%;
  top: 50%;
  transform: translateY(-50%);
  width: 420px;
  height: 420px;
  opacity: 0.06;
  pointer-events: none;
}

.hero-inner {
  position: relative; z-index: 2;
  max-width: 760px; margin: 0 auto; width: 100%;
  text-align: center;
  padding: 120px 0 100px;
}

.hero-left {}
.hero-eyebrow {
  display: inline-flex; align-items: center; gap: 8px;
  background: rgba(255,255,255,0.06);
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: 100px;
  padding: 6px 16px;
  font-size: 11px; font-weight: 600;
  letter-spacing: 1.2px; text-transform: uppercase;
  color: var(--green-300);
  margin-bottom: 28px;
}
.hero-eyebrow-dot {
  width: 6px; height: 6px; border-radius: 50%;
  background: var(--green-400);
  animation: blink 2s ease-in-out infinite;
}
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.3} }

.hero-title {
  font-family: var(--font-display);
  font-size: clamp(36px, 4.5vw, 60px);
  font-weight: 700;
  color: #fff;
  line-height: 1.12;
  margin-bottom: 24px;
}
.hero-title em {
  font-style: italic;
  color: var(--green-400);
}
.hero-title .gold-word {
  color: var(--gold);
  font-style: italic;
}

.hero-desc {
  font-size: 16px;
  line-height: 1.8;
  color: rgba(255,255,255,0.55);
  max-width: 480px;
  margin: 0 auto 40px;
}

.hero-cta {
  display: inline-flex; align-items: center; gap: 10px;
  background: var(--green-600);
  color: white;
  text-decoration: none;
  border-radius: 100px;
  padding: 14px 28px;
  font-size: 14px; font-weight: 600;
  transition: all 0.25s var(--ease-out);
}
.hero-cta:hover { background: var(--green-500); transform: translateY(-2px); box-shadow: 0 12px 32px rgba(34,197,94,0.3); }
.hero-cta svg { transition: transform 0.2s; }
.hero-cta:hover svg { transform: translateX(4px); }

/* ══════════════════════════════════════
   SECTION: TENTANG KAMI
══════════════════════════════════════ */
.tentang {
  background: var(--cream);
  padding: 100px 40px;
  position: relative;
  overflow: hidden;
}
.tentang-bg-arc {
  position: absolute;
  bottom: -200px; right: -200px;
  width: 600px; height: 600px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(22,163,74,0.06) 0%, transparent 70%);
  pointer-events: none;
}

.tentang-inner {
  max-width: 1160px; margin: 0 auto;
}

.section-label {
  display: inline-flex; align-items: center; gap: 10px;
  margin-bottom: 20px;
}
.section-label-line { width: 32px; height: 2px; background: var(--green-600); border-radius: 2px; }
.section-label-text {
  font-size: 11px; font-weight: 600;
  letter-spacing: 1.5px; text-transform: uppercase;
  color: var(--green-700);
}

.tentang-header {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 60px;
  align-items: start;
  margin-bottom: 64px;
}
.tentang-title {
  font-family: var(--font-display);
  font-size: clamp(28px, 3.5vw, 46px);
  font-weight: 700;
  color: var(--dark);
  line-height: 1.15;
}
.tentang-title em { font-style: italic; color: var(--green-700); }

.tentang-right-text {
  padding-top: 12px;
}
.tentang-right-text p {
  font-size: 15px;
  line-height: 1.85;
  color: #4a5568;
  margin-bottom: 16px;
}
.tentang-right-text p:last-child { margin-bottom: 0; }

.tentang-pillars {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
}

.pillar-card {
  background: white;
  border: 1px solid #e8f5ee;
  border-radius: 20px;
  padding: 32px 26px;
  position: relative;
  overflow: hidden;
  transition: all 0.3s var(--ease-out);
}
.pillar-card::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 3px;
  background: var(--green-600);
  transform: scaleX(0);
  transform-origin: left;
  transition: transform 0.35s var(--ease-out);
}
.pillar-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 20px 50px rgba(22,163,74,0.10);
  border-color: var(--green-300);
}
.pillar-card:hover::before { transform: scaleX(1); }

.pillar-icon-wrap {
  width: 56px; height: 56px;
  border-radius: 14px;
  background: var(--green-50);
  display: flex; align-items: center; justify-content: center;
  font-size: 26px;
  margin-bottom: 20px;
}
.pillar-num {
  font-size: 11px; font-weight: 700;
  color: var(--green-600);
  letter-spacing: 1px;
  text-transform: uppercase;
  margin-bottom: 8px;
}
.pillar-title {
  font-family: var(--font-display);
  font-size: 20px; font-weight: 700;
  color: var(--dark);
  margin-bottom: 12px;
  line-height: 1.2;
}
.pillar-desc {
  font-size: 13.5px;
  line-height: 1.75;
  color: #5a7a6a;
}

/* Highlight strip */
.tentang-highlight {
  margin-top: 48px;
  background: var(--green-950);
  border-radius: 24px;
  padding: 48px 52px;
  text-align: center;
  position: relative;
  overflow: hidden;
}
.tentang-highlight::before {
  content: '';
  position: absolute; inset: 0;
  background-image: repeating-linear-gradient(
    45deg,
    rgba(255,255,255,0.02) 0px,
    rgba(255,255,255,0.02) 1px,
    transparent 1px,
    transparent 24px
  );
}
.th-quote {
  font-family: var(--font-display);
  font-size: clamp(18px, 2.5vw, 28px);
  font-style: italic;
  color: white;
  line-height: 1.5;
  max-width: 720px;
  margin: 0 auto;
  position: relative; z-index: 1;
}
.th-quote strong { color: var(--green-400); font-style: normal; }

/* ══════════════════════════════════════
   SECTION: KONFIRMASI DONASI
══════════════════════════════════════ */
.konfirmasi {
  background: white;
  padding: 100px 40px;
  position: relative;
  overflow: hidden;
}
.konfirmasi-bg {
  position: absolute;
  top: -120px; left: -120px;
  width: 500px; height: 500px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(22,163,74,0.05) 0%, transparent 70%);
  pointer-events: none;
}

.konfirmasi-inner {
  max-width: 1160px; margin: 0 auto;
}

.konfirmasi-header {
  text-align: center;
  margin-bottom: 56px;
}
.konfirmasi-title {
  font-family: var(--font-display);
  font-size: clamp(26px, 3.5vw, 44px);
  font-weight: 700;
  color: var(--dark);
  margin-top: 16px;
  margin-bottom: 16px;
  line-height: 1.15;
}
.konfirmasi-title em { font-style: italic; color: var(--green-700); }
.konfirmasi-subtitle {
  font-size: 15px;
  color: #6b7280;
  max-width: 520px;
  margin: 0 auto;
  line-height: 1.75;
}

.konfirmasi-layout {
  display: grid;
  grid-template-columns: 1fr 1.1fr;
  gap: 40px;
  align-items: start;
}

/* Langkah-langkah */
.steps-list { display: flex; flex-direction: column; gap: 0; }
.step-item {
  display: flex;
  gap: 20px;
  position: relative;
  padding-bottom: 32px;
}
.step-item:last-child { padding-bottom: 0; }
.step-item:last-child .step-line { display: none; }

.step-left { position: relative; flex-shrink: 0; }
.step-num {
  width: 44px; height: 44px;
  border-radius: 50%;
  background: var(--green-600);
  display: flex; align-items: center; justify-content: center;
  font-weight: 700; font-size: 15px;
  color: white;
  position: relative; z-index: 1;
}
.step-line {
  position: absolute;
  top: 44px; left: 50%;
  transform: translateX(-50%);
  width: 2px;
  bottom: 0;
  background: linear-gradient(to bottom, var(--green-300), transparent);
}
.step-body { padding-top: 10px; }
.step-title {
  font-size: 15px; font-weight: 600;
  color: var(--dark);
  margin-bottom: 6px;
}
.step-desc {
  font-size: 13px;
  color: #6b7280;
  line-height: 1.7;
}
.step-tag {
  display: inline-flex; align-items: center; gap: 5px;
  background: var(--green-50);
  border: 1px solid var(--green-100);
  border-radius: 100px;
  padding: 3px 10px;
  font-size: 11px; font-weight: 600;
  color: var(--green-700);
  margin-top: 8px;
}

/* WA Card */
.wa-card {
  background: var(--green-950);
  border-radius: 24px;
  overflow: hidden;
  position: relative;
}
.wa-card-pattern {
  position: absolute; inset: 0; opacity: 0.05;
  background-image:
    repeating-linear-gradient(45deg, rgba(255,255,255,0.1) 0px, rgba(255,255,255,0.1) 1px, transparent 1px, transparent 22px),
    repeating-linear-gradient(-45deg, rgba(255,255,255,0.1) 0px, rgba(255,255,255,0.1) 1px, transparent 1px, transparent 22px);
}
.wa-card-top {
  padding: 36px 36px 28px;
  position: relative; z-index: 1;
  border-bottom: 1px solid rgba(255,255,255,0.07);
}
.wa-app-bar {
  display: flex; align-items: center; gap: 12px;
  margin-bottom: 24px;
}
.wa-avatar {
  width: 42px; height: 42px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--green-600), var(--green-400));
  display: flex; align-items: center; justify-content: center;
  font-size: 18px;
}
.wa-contact-info {}
.wa-contact-name { font-size: 14px; font-weight: 600; color: white; }
.wa-contact-status {
  font-size: 11px; color: rgba(255,255,255,0.45);
  display: flex; align-items: center; gap: 5px;
}
.wa-status-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--green-400); flex-shrink: 0; animation: blink 2s infinite; }

/* Chat bubbles */
.wa-chat { display: flex; flex-direction: column; gap: 10px; margin-bottom: 16px; }
.bubble {
  max-width: 80%;
  padding: 10px 14px;
  border-radius: 12px;
  font-size: 13px;
  line-height: 1.6;
  position: relative;
}
.bubble-in {
  background: rgba(255,255,255,0.08);
  color: rgba(255,255,255,0.85);
  align-self: flex-start;
  border-radius: 4px 12px 12px 12px;
}
.bubble-out {
  background: var(--green-700);
  color: white;
  align-self: flex-end;
  border-radius: 12px 4px 12px 12px;
}
.bubble-time { font-size: 10px; opacity: 0.45; margin-top: 3px; text-align: right; }

.wa-card-bottom {
  padding: 24px 36px 32px;
  position: relative; z-index: 1;
}
.wa-cta {
  display: flex; align-items: center; justify-content: center; gap: 10px;
  background: #25d366;
  color: white;
  text-decoration: none;
  border-radius: 14px;
  padding: 16px 28px;
  font-size: 15px; font-weight: 600;
  transition: all 0.25s var(--ease-out);
  width: 100%;
}
.wa-cta:hover { background: #1eb955; transform: translateY(-2px); box-shadow: 0 16px 40px rgba(37,211,102,0.35); }

.wa-numbers {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 10px;
  margin-top: 14px;
}
.wa-num-item {
  display: flex; align-items: center; gap: 8px;
  background: rgba(255,255,255,0.05);
  border: 1px solid rgba(255,255,255,0.07);
  border-radius: 10px;
  padding: 10px 12px;
  text-decoration: none;
  transition: background 0.18s;
}
.wa-num-item:hover { background: rgba(255,255,255,0.09); }
.wa-num-label { font-size: 10px; color: rgba(255,255,255,0.4); }
.wa-num-val { font-size: 12.5px; font-weight: 600; color: white; }
.wa-num-icon { font-size: 16px; flex-shrink: 0; }

/* ══════════════════════════════════════
   SECTION: SOSIAL MEDIA
══════════════════════════════════════ */
.sosmed {
  background: var(--cream);
  padding: 100px 40px 120px;
  position: relative;
  overflow: hidden;
}
.sosmed-bg-grid {
  position: absolute; inset: 0; pointer-events: none;
  background-image:
    linear-gradient(rgba(22,163,74,0.04) 1px, transparent 1px),
    linear-gradient(90deg, rgba(22,163,74,0.04) 1px, transparent 1px);
  background-size: 40px 40px;
}

.sosmed-inner {
  max-width: 1160px; margin: 0 auto; position: relative; z-index: 1;
}
.sosmed-header {
  text-align: center;
  margin-bottom: 56px;
}
.sosmed-title {
  font-family: var(--font-display);
  font-size: clamp(26px, 3.5vw, 44px);
  font-weight: 700;
  color: var(--dark);
  margin-top: 16px;
  margin-bottom: 14px;
}
.sosmed-title em { font-style: italic; color: var(--green-700); }
.sosmed-sub {
  font-size: 15px; color: #6b7280;
  max-width: 440px; margin: 0 auto; line-height: 1.7;
}

.sosmed-featured {
  display: grid;
  grid-template-columns: 1.6fr 1fr 1fr;
  gap: 16px;
  margin-bottom: 16px;
}

.sosmed-card {
  border-radius: 20px;
  padding: 32px 28px;
  display: flex;
  flex-direction: column;
  text-decoration: none;
  position: relative;
  overflow: hidden;
  transition: all 0.3s var(--ease-out);
  min-height: 200px;
}
.sosmed-card:hover { transform: translateY(-5px); }
.sosmed-card-pattern {
  position: absolute; inset: 0;
  background-image: repeating-linear-gradient(
    -45deg,
    rgba(255,255,255,0.04) 0px,
    rgba(255,255,255,0.04) 1px,
    transparent 1px,
    transparent 18px
  );
}
.sosmed-card-icon {
  width: 52px; height: 52px;
  border-radius: 14px;
  background: rgba(255,255,255,0.15);
  display: flex; align-items: center; justify-content: center;
  margin-bottom: auto;
  position: relative; z-index: 1;
}
.sosmed-card-body { position: relative; z-index: 1; margin-top: 32px; }
.sosmed-card-name {
  font-size: 18px; font-weight: 600;
  color: white;
  margin-bottom: 4px;
}
.sosmed-card-handle { font-size: 13px; color: rgba(255,255,255,0.55); }
.sosmed-card-arrow {
  position: absolute; top: 24px; right: 24px;
  color: rgba(255,255,255,0.4);
  transition: all 0.2s;
}
.sosmed-card:hover .sosmed-card-arrow { color: white; transform: translate(3px,-3px); }

.sc-wa   { background: linear-gradient(135deg, #075e54, #25d366); }
.sc-ig   { background: linear-gradient(135deg, #833ab4, #fd1d1d, #f77737); }
.sc-yt   { background: linear-gradient(135deg, #cc0000, #ff0000); }
.sc-fb   { background: linear-gradient(135deg, #1877f2, #3b5998); }
.sc-tt   { background: linear-gradient(135deg, #010101, #333); }
.sc-tw   { background: linear-gradient(135deg, #1da1f2, #0d8ecf); }

.sosmed-mini {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 16px;
}

/* Follow banner */
.sosmed-banner {
  margin-top: 40px;
  background: var(--green-950);
  border-radius: 24px;
  padding: 40px 52px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 32px;
  position: relative;
  overflow: hidden;
}
.sosmed-banner::before {
  content: '';
  position: absolute; inset: 0;
  background-image: repeating-linear-gradient(
    45deg, rgba(255,255,255,0.02) 0px, rgba(255,255,255,0.02) 1px,
    transparent 1px, transparent 24px
  );
}
.sb-text { position: relative; z-index: 1; }
.sb-title {
  font-family: var(--font-display);
  font-size: 22px; font-weight: 700;
  color: white; margin-bottom: 6px;
}
.sb-title em { font-style: italic; color: var(--green-400); }
.sb-desc { font-size: 14px; color: rgba(255,255,255,0.5); }
.sb-cta {
  position: relative; z-index: 1;
  display: inline-flex; align-items: center; gap: 8px;
  background: var(--green-600);
  color: white;
  text-decoration: none;
  border-radius: 100px;
  padding: 12px 24px;
  font-size: 14px; font-weight: 600;
  white-space: nowrap;
  transition: all 0.2s;
  flex-shrink: 0;
}
.sb-cta:hover { background: var(--green-500); transform: translateY(-2px); }

/* ══════════════════════════════════════
   KANTOR — under konfirmasi (simpan)
══════════════════════════════════════ */
.lokasi-strip {
  background: var(--green-50);
  border-top: 1px solid #d1fae5;
  padding: 28px 40px;
}
.lokasi-strip-inner {
  max-width: 1160px; margin: 0 auto;
  display: flex; align-items: center;
  justify-content: space-between;
  gap: 24px;
  flex-wrap: wrap;
}
.lokasi-item {
  display: flex; align-items: center; gap: 10px;
  font-size: 13px;
}
.lokasi-item-icon {
  width: 32px; height: 32px;
  border-radius: 8px;
  background: var(--green-100);
  display: flex; align-items: center; justify-content: center;
  font-size: 14px;
  flex-shrink: 0;
}
.lokasi-item-label { font-size: 10px; color: var(--green-700); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
.lokasi-item-val { font-weight: 600; color: var(--dark); }
.lokasi-link {
  color: var(--green-700);
  font-weight: 600; font-size: 13px;
  text-decoration: none;
  display: inline-flex; align-items: center; gap: 5px;
  border: 1px solid var(--green-300);
  border-radius: 100px;
  padding: 7px 16px;
  transition: all 0.18s;
}
.lokasi-link:hover { background: var(--green-600); color: white; border-color: var(--green-600); }

/* ══════════════════════════════════════
   REVEAL ANIMATION
══════════════════════════════════════ */
@keyframes fadeUp {
  from { opacity: 0; transform: translateY(24px); }
  to   { opacity: 1; transform: translateY(0); }
}
.reveal { opacity: 0; }
.reveal.visible { animation: fadeUp 0.6s var(--ease-out) forwards; }
.rd1.visible { animation-delay: 0.05s; }
.rd2.visible { animation-delay: 0.12s; }
.rd3.visible { animation-delay: 0.19s; }
.rd4.visible { animation-delay: 0.26s; }

/* ══════════════════════════════════════
   RESPONSIVE
══════════════════════════════════════ */
@media (max-width: 900px) {
  .hero-inner { padding: 80px 0 64px; }
  .hero-leaf { display: none; }
  .tentang-header { grid-template-columns: 1fr; gap: 32px; }
  .tentang-pillars { grid-template-columns: 1fr 1fr; }
  .konfirmasi-layout { grid-template-columns: 1fr; }
  .wa-numbers { grid-template-columns: 1fr; }
  .sosmed-featured { grid-template-columns: 1fr 1fr; }
  .sosmed-featured .sosmed-card:first-child { grid-column: span 2; }
  .sosmed-mini { grid-template-columns: 1fr 1fr; }
  .sosmed-mini .sosmed-card:last-child { grid-column: span 2; }
  .sosmed-banner { flex-direction: column; text-align: center; padding: 32px 28px; }
}
@media (max-width: 600px) {
  .hero, .tentang, .konfirmasi, .sosmed, .lokasi-strip { padding-left: 20px; padding-right: 20px; }
  .tentang-pillars { grid-template-columns: 1fr; }
  .sosmed-featured { grid-template-columns: 1fr; }
  .sosmed-featured .sosmed-card:first-child { grid-column: span 1; }
  .sosmed-mini { grid-template-columns: 1fr; }
  .sosmed-mini .sosmed-card:last-child { grid-column: span 1; }
  .wa-numbers { grid-template-columns: 1fr; }
}
</style>
@endsection


@section('content')

{{-- ══════════════════════════════════════
     HERO
══════════════════════════════════════ --}}
<section class="hero">
  <div class="hero-bg-rings">
    <div class="hero-ring"></div>
    <div class="hero-ring"></div>
    <div class="hero-ring"></div>
  </div>

  {{-- Daun dekoratif SVG --}}
  <svg class="hero-leaf" viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M200 20 C320 60, 380 180, 360 300 C340 380, 200 400, 100 360 C20 320, -20 200, 40 100 C80 20, 160 -10, 200 20Z" fill="white"/>
    <path d="M200 20 L200 380" stroke="white" stroke-width="2" opacity="0.3"/>
    <path d="M200 20 C240 80, 300 160, 280 260" stroke="white" stroke-width="1" opacity="0.2"/>
    <path d="M200 20 C160 80, 100 160, 120 260" stroke="white" stroke-width="1" opacity="0.2"/>
  </svg>

  <div class="hero-inner">
    <div class="hero-left reveal">
      <div class="hero-eyebrow">
        <span class="hero-eyebrow-dot"></span>
        Platform Donasi Amanah
      </div>
      <h1 class="hero-title">
        Hubungi Kami,<br>
        Bersama <em>Berbagi</em><br>
        <span class="gold-word">Kebaikan</span>
      </h1>
      <p class="hero-desc">
        Tim Berkahin siap membantu setiap pertanyaan, konfirmasi donasi, dan kebutuhan lainnya. Kami hadir dengan penuh amanah.
      </p>
      <a href="https://wa.me/6281122334455" class="hero-cta" target="_blank" rel="noopener">
        Hubungi via WhatsApp
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </a>
    </div>
  </div>
</section>


{{-- ══════════════════════════════════════
     TENTANG KAMI
══════════════════════════════════════ --}}
<section class="tentang">
  <div class="tentang-bg-arc"></div>
  <div class="tentang-inner">

    <div class="tentang-header">
      <div class="reveal">
        <div class="section-label">
          <div class="section-label-line"></div>
          <span class="section-label-text">Tentang Kami</span>
        </div>
        <h2 class="tentang-title">
          Platform Donasi<br>
          yang <em>Amanah</em><br>
          & Transparan
        </h2>
      </div>
      <div class="tentang-right-text reveal rd1">
        <p>Berkahin adalah lembaga pengelola donasi berbasis digital yang lahir dari semangat untuk menghadirkan cara baru berinfaq yang <strong>aman, mudah, dan terukur dampaknya</strong>.</p>
        <p>Kami percaya bahwa setiap rupiah yang diamanahkan donatur harus sampai kepada yang berhak, dengan laporan nyata dan proses yang sepenuhnya transparan.</p>
        <p>Sejak berdiri, Berkahin telah mengelola ratusan program — mulai dari zakat, infaq, sedekah, qurban, hingga beasiswa — dengan standar tata kelola yang ketat dan tim yang berdedikasi.</p>
      </div>
    </div>

    <div class="tentang-pillars">
      <div class="pillar-card reveal">
        <div class="pillar-icon-wrap">🛡️</div>
        <div class="pillar-num">01 — Prinsip</div>
        <div class="pillar-title">Amanah & Terpercaya</div>
        <div class="pillar-desc">Setiap donasi dikelola dengan penuh tanggung jawab. Kami tidak mengambil keuntungan dari dana donatur. Transparansi adalah janji kami.</div>
      </div>
      <div class="pillar-card reveal rd1">
        <div class="pillar-icon-wrap">📊</div>
        <div class="pillar-num">02 — Laporan</div>
        <div class="pillar-title">Transparan & Akuntabel</div>
        <div class="pillar-desc">Setiap program dilengkapi laporan berkala yang dapat diakses donatur kapan saja. Tidak ada yang tersembunyi.</div>
      </div>
      <div class="pillar-card reveal rd2">
        <div class="pillar-icon-wrap">⚡</div>
        <div class="pillar-num">03 — Penyaluran</div>
        <div class="pillar-title">Cepat & Tepat Sasaran</div>
        <div class="pillar-desc">Proses penyaluran yang efisien memastikan bantuan sampai kepada penerima manfaat dalam waktu sesingkat mungkin.</div>
      </div>
    </div>

    <div class="tentang-highlight reveal">
      <div class="th-quote">
        "Kami bukan sekadar platform. Kami adalah <strong>jembatan amanah</strong> antara kebaikan Anda dan mereka yang membutuhkan."
      </div>
    </div>

  </div>
</section>


{{-- ══════════════════════════════════════
     KANTOR — lokasi strip
══════════════════════════════════════ --}}
<div class="lokasi-strip">
  <div class="lokasi-strip-inner">
    <div class="lokasi-item">
      <div class="lokasi-item-icon">📍</div>
      <div>
        <div class="lokasi-item-label">Kantor Pusat</div>
        <div class="lokasi-item-val">Jl. Kebaikan No. 12, Surabaya, Jawa Timur</div>
      </div>
    </div>
    <div class="lokasi-item">
      <div class="lokasi-item-icon">🕐</div>
      <div>
        <div class="lokasi-item-label">Jam Kerja</div>
        <div class="lokasi-item-val">Senin–Jum'at 08.00–17.00 · Sabtu 08.00–13.00</div>
      </div>
    </div>
    <div class="lokasi-item">
      <div class="lokasi-item-icon">📱</div>
      <div>
        <div class="lokasi-item-label">WhatsApp 24/7</div>
        <div class="lokasi-item-val">0811-2233-4455</div>
      </div>
    </div>
    <a class="lokasi-link" href="https://maps.google.com/?q=Surabaya" target="_blank" rel="noopener">
      Buka Maps
      <svg width="12" height="12" viewBox="0 0 16 16" fill="none"><path d="M6 3l5 5-5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </a>
  </div>
</div>


{{-- ══════════════════════════════════════
     KONFIRMASI DONASI
══════════════════════════════════════ --}}
<section class="konfirmasi">
  <div class="konfirmasi-bg"></div>
  <div class="konfirmasi-inner">

    <div class="konfirmasi-header reveal">
      <div class="section-label" style="justify-content:center">
        <div class="section-label-line"></div>
        <span class="section-label-text">Konfirmasi Donasi</span>
        <div class="section-label-line"></div>
      </div>
      <h2 class="konfirmasi-title">Konfirmasi Donasi<br><em>via WhatsApp</em></h2>
      <p class="konfirmasi-subtitle">Sudah transfer? Konfirmasi donasi Anda cukup lewat WhatsApp. Mudah, cepat, dan langsung kami proses.</p>
    </div>

    <div class="konfirmasi-layout">

      {{-- Langkah-langkah --}}
      <div class="steps-list reveal">
        <div class="step-item">
          <div class="step-left">
            <div class="step-num">1</div>
            <div class="step-line"></div>
          </div>
          <div class="step-body">
            <div class="step-title">Lakukan Transfer Donasi</div>
            <div class="step-desc">Transfer ke rekening resmi Berkahin. Pastikan nominal sesuai dengan program yang Anda pilih.</div>
            <div class="step-tag">
              <svg width="10" height="10" viewBox="0 0 16 16" fill="none"><path d="M13 4L6.5 11 3 7.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
              Cek rekening di website
            </div>
          </div>
        </div>
        <div class="step-item">
          <div class="step-left">
            <div class="step-num">2</div>
            <div class="step-line"></div>
          </div>
          <div class="step-body">
            <div class="step-title">Simpan Bukti Transfer</div>
            <div class="step-desc">Screenshot atau foto bukti transfer dari aplikasi bank/e-wallet Anda.</div>
          </div>
        </div>
        <div class="step-item">
          <div class="step-left">
            <div class="step-num">3</div>
            <div class="step-line"></div>
          </div>
          <div class="step-body">
            <div class="step-title">Kirim ke WhatsApp Berkahin</div>
            <div class="step-desc">Kirim bukti transfer beserta nama, nominal, dan program yang dituju ke nomor WhatsApp kami.</div>
          </div>
        </div>
        <div class="step-item">
          <div class="step-left">
            <div class="step-num">4</div>
          </div>
          <div class="step-body">
            <div class="step-title">Terima Konfirmasi & Laporan</div>
            <div class="step-desc">Tim kami akan membalas dalam hitungan menit, memberikan konfirmasi resmi dan nomor donasi Anda.</div>
            <div class="step-tag">
              <span style="width:6px;height:6px;border-radius:50%;background:var(--green-600);display:inline-block;animation:blink 2s infinite"></span>
              Respons ≤ 30 menit
            </div>
          </div>
        </div>
      </div>

      {{-- WA Mockup Card --}}
      <div class="wa-card reveal rd1">
        <div class="wa-card-pattern"></div>
        <div class="wa-card-top">
          <div class="wa-app-bar">
            <div class="wa-avatar">🤲</div>
            <div class="wa-contact-info">
              <div class="wa-contact-name">Berkahin — Helpdesk</div>
              <div class="wa-contact-status">
                <span class="wa-status-dot"></span>
                Online 24 jam / 7 hari
              </div>
            </div>
          </div>
          <div class="wa-chat">
            <div class="bubble bubble-in">
              Assalamu'alaikum 🙏 Saya ingin konfirmasi donasi untuk Program Beasiswa Santri.
              <div class="bubble-time">08:42</div>
            </div>
            <div class="bubble bubble-out">
              Wa'alaikumsalam! Terima kasih sudah berdonasi 💚 Silakan kirim bukti transfernya ya, kami proses segera.
              <div class="bubble-time">08:43 ✓✓</div>
            </div>
            <div class="bubble bubble-in">
              [foto bukti transfer]<br>Nominal Rp 500.000 atas nama Budi Santoso.
              <div class="bubble-time">08:45</div>
            </div>
            <div class="bubble bubble-out">
              Alhamdulillah ✅ Donasi Anda telah kami terima & dicatat. Nomor donasi: <strong>BRK-2025-07841</strong>. Jazakallah khair 🤲
              <div class="bubble-time">08:46 ✓✓</div>
            </div>
          </div>
        </div>
        <div class="wa-card-bottom">
          <a class="wa-cta" href="https://wa.me/6281122334455?text=Assalamualaikum%2C%20saya%20ingin%20konfirmasi%20donasi" target="_blank" rel="noopener">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            Konfirmasi Donasi Sekarang
          </a>
          <div class="wa-numbers">
            <a class="wa-num-item" href="https://wa.me/6281122334455" target="_blank" rel="noopener">
              <span class="wa-num-icon">📱</span>
              <div>
                <div class="wa-num-label">WhatsApp Utama</div>
                <div class="wa-num-val">0811-2233-4455</div>
              </div>
            </a>
            <a class="wa-num-item" href="https://wa.me/6281234567890" target="_blank" rel="noopener">
              <span class="wa-num-icon">📲</span>
              <div>
                <div class="wa-num-label">WhatsApp Donasi</div>
                <div class="wa-num-val">0812-3456-7890</div>
              </div>
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


{{-- ══════════════════════════════════════
     SOSIAL MEDIA
══════════════════════════════════════ --}}
<section class="sosmed">
  <div class="sosmed-bg-grid"></div>
  <div class="sosmed-inner">

    <div class="sosmed-header reveal">
      <div class="section-label" style="justify-content:center">
        <div class="section-label-line"></div>
        <span class="section-label-text">Media Sosial</span>
        <div class="section-label-line"></div>
      </div>
      <h2 class="sosmed-title">Ikuti Kami di<br><em>Sosial Media</em></h2>
      <p class="sosmed-sub">Dapatkan update program, laporan donasi, dan konten inspiratif seputar kebaikan setiap harinya.</p>
    </div>

    {{-- Featured row --}}
    <div class="sosmed-featured">
      {{-- WhatsApp — besar --}}
      <a class="sosmed-card sc-wa reveal" href="https://wa.me/6281122334455" target="_blank" rel="noopener">
        <div class="sosmed-card-pattern"></div>
        <div class="sosmed-card-icon">
          <svg width="26" height="26" viewBox="0 0 24 24" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
        </div>
        <svg class="sosmed-card-arrow" width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M7 17L17 7M7 7h10v10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <div class="sosmed-card-body">
          <div class="sosmed-card-name">WhatsApp</div>
          <div class="sosmed-card-handle">Chat & konfirmasi donasi langsung</div>
        </div>
      </a>
      {{-- Instagram --}}
      <a class="sosmed-card sc-ig reveal rd1" href="https://instagram.com/berkahin.id" target="_blank" rel="noopener">
        <div class="sosmed-card-pattern"></div>
        <div class="sosmed-card-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="white"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
        </div>
        <svg class="sosmed-card-arrow" width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M7 17L17 7M7 7h10v10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <div class="sosmed-card-body">
          <div class="sosmed-card-name">Instagram</div>
          <div class="sosmed-card-handle">@berkahin.id</div>
        </div>
      </a>
      {{-- YouTube --}}
      <a class="sosmed-card sc-yt reveal rd2" href="https://youtube.com/@berkahin" target="_blank" rel="noopener">
        <div class="sosmed-card-pattern"></div>
        <div class="sosmed-card-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="white"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
        </div>
        <svg class="sosmed-card-arrow" width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M7 17L17 7M7 7h10v10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <div class="sosmed-card-body">
          <div class="sosmed-card-name">YouTube</div>
          <div class="sosmed-card-handle">@berkahin</div>
        </div>
      </a>
    </div>

    {{-- Mini row --}}
    <div class="sosmed-mini">
      <a class="sosmed-card sc-fb reveal" href="https://facebook.com/berkahin" target="_blank" rel="noopener">
        <div class="sosmed-card-pattern"></div>
        <div class="sosmed-card-icon">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="white"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
        </div>
        <svg class="sosmed-card-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M7 17L17 7M7 7h10v10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <div class="sosmed-card-body">
          <div class="sosmed-card-name">Facebook</div>
          <div class="sosmed-card-handle">/berkahin</div>
        </div>
      </a>
      <a class="sosmed-card sc-tt reveal rd1" href="https://tiktok.com/@berkahin" target="_blank" rel="noopener">
        <div class="sosmed-card-pattern"></div>
        <div class="sosmed-card-icon">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="white"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.75a8.28 8.28 0 004.84 1.55V6.85a4.85 4.85 0 01-1.07-.16z"/></svg>
        </div>
        <svg class="sosmed-card-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M7 17L17 7M7 7h10v10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <div class="sosmed-card-body">
          <div class="sosmed-card-name">TikTok</div>
          <div class="sosmed-card-handle">@berkahin</div>
        </div>
      </a>
      <a class="sosmed-card sc-tw reveal rd2" href="https://twitter.com/berkahin_id" target="_blank" rel="noopener">
        <div class="sosmed-card-pattern"></div>
        <div class="sosmed-card-icon">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="white"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.748l7.73-8.835L1.254 2.25H8.08l4.261 5.636zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
        </div>
        <svg class="sosmed-card-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M7 17L17 7M7 7h10v10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <div class="sosmed-card-body">
          <div class="sosmed-card-name">Twitter / X</div>
          <div class="sosmed-card-handle">@berkahin_id</div>
        </div>
      </a>
    </div>

    {{-- Follow banner --}}
    <div class="sosmed-banner reveal">
      <div class="sb-text">
        <div class="sb-title">Jangan lewatkan <em>cerita kebaikan</em> kami</div>
        <div class="sb-desc">Follow semua akun Berkahin dan jadilah bagian dari gerakan donasi amanah Indonesia.</div>
      </div>
      <a class="sb-cta" href="https://instagram.com/berkahin.id" target="_blank" rel="noopener">
        Follow Sekarang
        <svg width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </a>
    </div>

  </div>
</section>

@endsection


@push('scripts')
<script>
const io = new IntersectionObserver((entries) => {
  entries.forEach(e => {
    if (e.isIntersecting) {
      e.target.classList.add('visible');
      io.unobserve(e.target);
    }
  });
}, { threshold: 0.08 });
document.querySelectorAll('.reveal').forEach(el => io.observe(el));
</script>
@endpush