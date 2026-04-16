@extends('layouts.app')

@section('title', 'Berkahin')

@section('styles')
<style>
/* ══════════════════════════════════════
   HERO SLIDER
══════════════════════════════════════ */
.hero-slider {
  position: relative;
  height: 100vh;
  min-height: 600px; max-height: 860px;
  overflow: hidden; 
  z-index: 5;
}

.slides-track {
  display: flex; height: 100%;
  transition: transform 0.7s cubic-bezier(0.77,0,0.175,1);
}

.slide {
  flex-shrink: 0; width: 100%; height: 100%;
  position: relative; display: flex; align-items: center;
}

.slide-bg {
  position: absolute; inset: 0;
  background-size: cover; background-position: center;
}
.slide-overlay {
  position: absolute; inset: 0;
  background: linear-gradient(105deg, rgba(10,40,25,0.82) 0%, rgba(10,40,25,0.4) 60%, transparent 100%);
  z-index: 1;
}
.slide-pattern {
  position: absolute; inset: 0; opacity: 0.08; z-index: 1;
  background-image: repeating-linear-gradient(45deg, rgba(255,255,255,0.04) 0px, rgba(255,255,255,0.04) 1px, transparent 1px, transparent 20px);
}

.slide-content {
  position: relative; z-index: 2;
  max-width: 1100px; margin: 0 auto; width: 100%;
  padding: 0 80px;
}

.slide-badge {
  display: inline-flex; align-items: center; gap: 7px;
  background: rgba(255,255,255,0.15);
  border: 1px solid rgba(255,255,255,0.25);
  backdrop-filter: blur(8px);
  color: white; font-size: 12px; font-weight: 500;
  padding: 5px 14px; border-radius: 20px; margin-bottom: 20px;
  letter-spacing: 0.3px;
}
.slide-badge-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--accent-light); flex-shrink: 0; }

.slide-title {
  font-family: var(--font-serif);
  font-size: clamp(28px, 5vw, 52px);
  font-weight: 600; color: white; line-height: 1.2;
  margin-bottom: 16px; max-width: 560px;
}
.slide-title em { font-style: italic; color: var(--accent-light); }

.slide-desc {
  font-size: clamp(13px, 1.5vw, 16px);
  color: rgba(255,255,255,0.78);
  line-height: 1.75; margin-bottom: 32px;
  max-width: 440px;
}

.slide-actions { display: flex; align-items: center; gap: 14px; flex-wrap: wrap; }
.slide-btn-main {
  padding: 13px 28px; border-radius: var(--radius-xs);
  background: var(--accent); color: #1a0a00;
  border: none; font-size: 15px; font-weight: 700;
  cursor: pointer; font-family: var(--font-display);
  text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
  transition: all 0.2s;
}
.slide-btn-main:hover { background: var(--accent-light); transform: translateY(-2px); }
.slide-btn-ghost {
  padding: 13px 28px; border-radius: var(--radius-xs);
  background: rgba(255,255,255,0.12);
  border: 1px solid rgba(255,255,255,0.3);
  color: white; font-size: 15px; font-weight: 500;
  cursor: pointer; font-family: var(--font-display);
  text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
  transition: all 0.2s; backdrop-filter: blur(8px);
}
.slide-btn-ghost:hover { background: rgba(255,255,255,0.2); }

/* ── Arrow kiri & kanan ── */
#arrowPrev, #arrowNext {
  position: absolute;
  top: 50%; transform: translateY(-50%);
  z-index: 10;
}
#arrowPrev { left: 20px; }
#arrowNext { right: 20px; }
.slider-arrow {
  width: 44px; height: 44px; border-radius: 50%;
  background: rgba(255,255,255,0.12);
  border: 1px solid rgba(255,255,255,0.3);
  backdrop-filter: blur(8px);
  display: flex; align-items: center; justify-content: center;
  cursor: pointer; transition: all 0.2s;
}
.slider-arrow:hover { background: rgba(255,255,255,0.28); }

/* ── Dots — tengah bawah, di dalam hero, di atas progress bar ── */
.slider-dots {
  position: absolute;
  bottom: 10px; /* Naikkan dari 18px ke 30px atau 40px */
  left: 50%; transform: translateX(-50%);
  display: flex; align-items: center; gap: 10px;
  z-index: 10;
}
.slider-dot {
  width: 8px; height: 8px; border-radius: 20px;
  background: rgba(255,255,255,0.4);
  cursor: pointer; transition: all 0.3s;
  border: none; padding: 0; flex-shrink: 0;
}
.slider-dot.active { background: var(--accent-light); width: 24px; }

.slide-progress-wrapper {
  width: 100%;
  height: 4px;
  background: rgba(0, 0, 0, 0.08); /* Warna dasar track progress (bisa disesuaikan) */
  position: relative; /* Menghilangkan absolute agar tidak melayang */
  z-index: 10;
}

/* ── Progress bar — menempel di batas paling bawah .hero-slider ── */
.slide-progress-bar {
  height: 100%;
  background: var(--accent-light);
  width: 0;
  transition: width linear;
}


/* ══════════════════════════════════════
   DONASI CARDS
══════════════════════════════════════ */


.donasi-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 24px;
}
.donasi-card {
  background: var(--surface); border-radius: var(--radius);
  border: 1px solid var(--border); overflow: hidden;
  transition: all 0.25s; text-decoration: none; color: inherit; display: block;
}
.donasi-card:hover { transform: translateY(-4px); box-shadow: 0 12px 40px rgba(0,0,0,0.1); border-color: var(--primary-pale2); }
.donasi-thumb { width: 100%; height: 180px; position: relative; overflow: hidden; }
.donasi-thumb-bg { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 64px; transition: transform 0.4s; }
.donasi-card:hover .donasi-thumb-bg { transform: scale(1.08); }
.donasi-thumb-cat { position: absolute; top: 12px; left: 12px; background: white; color: var(--primary); font-size: 11px; font-weight: 600; letter-spacing: 0.3px; padding: 4px 10px; border-radius: 20px; border: 1px solid var(--primary-pale2); }
.donasi-thumb-urgent { position: absolute; top: 12px; right: 12px; background: #dc2626; color: white; font-size: 10px; font-weight: 600; padding: 3px 9px; border-radius: 20px; }
.donasi-body { padding: 18px; }
.donasi-org { font-size: 11px; color: var(--text-hint); margin-bottom: 6px; display: flex; align-items: center; gap: 5px; }
.donasi-org-dot { width: 14px; height: 14px; border-radius: 50%; background: var(--primary-pale2); flex-shrink: 0; display: flex; align-items: center; justify-content: center; }
.donasi-org-dot svg { width: 8px; height: 8px; }
.donasi-title { font-size: 15px; font-weight: 600; line-height: 1.45; margin-bottom: 14px; color: var(--text); }
.donasi-bar-wrap { background: var(--bg2); border-radius: 10px; height: 6px; margin-bottom: 10px; overflow: hidden; }
.donasi-bar { height: 100%; border-radius: 10px; background: var(--primary); }
.donasi-meta { display: flex; align-items: center; justify-content: space-between; font-size: 12px; color: var(--text-muted); margin-bottom: 14px; }
.donasi-meta-collected { font-weight: 600; color: var(--primary); font-size: 13px; }
.donasi-footer { display: flex; align-items: center; justify-content: space-between; padding-top: 14px; border-top: 1px solid var(--border); }
.donasi-price { font-size: 13px; color: var(--text-muted); }
.donasi-price strong { font-size: 15px; color: var(--text); font-weight: 600; }
.donasi-btn { padding: 8px 16px; border-radius: var(--radius-xs); background: var(--primary-pale); color: var(--primary); font-size: 13px; font-weight: 600; border: none; cursor: pointer; font-family: var(--font-display); transition: all 0.18s; }
.donasi-btn:hover { background: var(--primary); color: white; }

/* ══════════════════════════════════════
   CTA BANNER
══════════════════════════════════════ */
.cta-banner { background: var(--primary); border-radius: var(--radius); padding: 56px 48px; position: relative; overflow: hidden; display: flex; align-items: center; justify-content: space-between; gap: 32px; flex-wrap: wrap; }
.cta-bg-pattern { position: absolute; inset: 0; opacity: 0.06; background: repeating-linear-gradient(45deg, white 0px, white 1px, transparent 1px, transparent 28px), repeating-linear-gradient(-45deg, white 0px, white 1px, transparent 1px, transparent 28px); }
.cta-circle { position: absolute; right: -80px; top: -80px; width: 320px; height: 320px; border-radius: 50%; background: rgba(255,255,255,0.05); pointer-events: none; }
.cta-circle2 { position: absolute; right: 80px; bottom: -120px; width: 240px; height: 240px; border-radius: 50%; background: rgba(255,255,255,0.04); pointer-events: none; }
.cta-left { position: relative; z-index: 1; }
.cta-eyebrow { font-size: 12px; color: rgba(255,255,255,0.6); letter-spacing: 0.5px; margin-bottom: 10px; }
.cta-title { font-family: var(--font-serif); font-size: clamp(22px, 3vw, 32px); font-weight: 600; color: white; line-height: 1.3; margin-bottom: 12px; }
.cta-title em { font-style: italic; color: var(--accent-light); }
.cta-desc { font-size: 14px; color: rgba(255,255,255,0.72); line-height: 1.7; max-width: 400px; }
.cta-right { position: relative; z-index: 1; display: flex; gap: 12px; flex-wrap: wrap; }
.btn-accent { padding: 13px 28px; border-radius: var(--radius-xs); background: var(--accent); color: #1a0a00; border: none; font-size: 14px; font-weight: 700; cursor: pointer; font-family: var(--font-display); text-decoration: none; display: inline-flex; align-items: center; gap: 7px; transition: all 0.2s; }
.btn-accent:hover { background: var(--accent-light); transform: translateY(-1px); }
.btn-white-ghost { padding: 13px 24px; border-radius: var(--radius-xs); background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.25); color: white; font-size: 14px; font-weight: 500; cursor: pointer; font-family: var(--font-display); text-decoration: none; display: inline-flex; align-items: center; gap: 7px; transition: all 0.2s; backdrop-filter: blur(8px); }
.btn-white-ghost:hover { background: rgba(255,255,255,0.2); }

/* ══════════════════════════════════════
   BLOG CARDS
══════════════════════════════════════ */
.blog-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 24px; }
.blog-card { background: var(--surface); border-radius: var(--radius); border: 1px solid var(--border); overflow: hidden; transition: all 0.25s; text-decoration: none; color: inherit; display: block; }
.blog-card:hover { transform: translateY(-4px); box-shadow: 0 12px 40px rgba(0,0,0,0.09); }
.blog-thumb { width: 100%; height: 200px; display: flex; align-items: center; justify-content: center; font-size: 72px; position: relative; overflow: hidden; transition: transform 0.4s; }
.blog-card:hover .blog-thumb { transform: scale(1.04); }
.blog-body { padding: 20px; }
.blog-cat { font-size: 11px; font-weight: 600; letter-spacing: 0.5px; text-transform: uppercase; color: var(--primary); margin-bottom: 8px; }
.blog-title { font-size: 16px; font-weight: 600; line-height: 1.45; margin-bottom: 10px; color: var(--text); }
.blog-excerpt { font-size: 13px; color: var(--text-muted); line-height: 1.7; margin-bottom: 16px; }
.blog-footer { display: flex; align-items: center; justify-content: space-between; padding-top: 14px; border-top: 1px solid var(--border); font-size: 12px; color: var(--text-hint); }
.blog-author { display: flex; align-items: center; gap: 6px; }
.blog-author-avatar { width: 24px; height: 24px; border-radius: 50%; background: var(--primary-pale2); display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: 600; color: var(--primary); }
.blog-date { font-size: 11px; color: var(--text-hint); }

/* ══════════════════════════════════════
   RESPONSIVE
══════════════════════════════════════ */
@media (max-width: 768px) {
  .slide-content { padding: 0 24px; }
  #arrowPrev { left: 12px; }
  #arrowNext { right: 12px; }
  .cta-banner { padding: 36px 24px; }
}
@media (max-width: 640px) {
  .stats-grid { grid-template-columns: repeat(2, 1fr); }
  .stat-item { border-bottom: 1px solid rgba(255,255,255,0.15); }
  .stat-item:nth-child(2n) { border-right: none; }
  .stat-item:nth-last-child(-n+2) { border-bottom: none; }
}
</style>
@endsection

@section('content')

{{-- ══════════════════════════════════════
     HERO SLIDER
══════════════════════════════════════ --}}
<section class="hero-slider" id="heroSlider">
{{-- Dots — tengah bawah, di dalam hero --}}
  <div class="slider-dots">
    <button class="slider-dot active" onclick="goToSlide(0)"></button>
    <button class="slider-dot" onclick="goToSlide(1)"></button>
    <button class="slider-dot" onclick="goToSlide(2)"></button>
    <button class="slider-dot" onclick="goToSlide(3)"></button>
  </div>


  <div class="slides-track" id="slidesTrack">

    {{-- Slide 1: Qurban --}}
    <div class="slide">
      <div class="slide-bg" style="background-image:url('https://images.unsplash.com/photo-1609599006353-e629aaabfeae?w=1600&q=80')"></div>
      <div class="slide-overlay"></div>
      <div class="slide-pattern"></div>
      <div class="slide-content">
        <div class="slide-badge"><span class="slide-badge-dot"></span>Program Qurban 1446 H</div>
        <h1 class="slide-title">Tunaikan Qurban,<br><em>Raih Keberkahan</em><br>Bersama Kami</h1>
        <p class="slide-desc">Bergabunglah dengan ribuan donatur yang telah mempercayakan ibadah qurban mereka kepada Berkahin. Mulai dari Rp 1.399.000.</p>
        <div class="slide-actions">
          <a href="{{ url('/#donasi') }}" class="slide-btn-main">
            Qurban Sekarang
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </a>
          <a href="{{ url('/program/qurban') }}" class="slide-btn-ghost">Pelajari Program</a>
        </div>
      </div>
    </div>

    {{-- Slide 2: Zakat --}}
    <div class="slide">
      <div class="slide-bg" style="background-image:url('https://images.unsplash.com/photo-1532375810709-75b1da00537c?w=1600&q=80')"></div>
      <div class="slide-overlay" style="background:linear-gradient(105deg,rgba(8,28,52,0.85) 0%,rgba(8,28,52,0.4) 60%,transparent 100%)"></div>
      <div class="slide-pattern"></div>
      <div class="slide-content">
        <div class="slide-badge"><span class="slide-badge-dot"></span>Zakat Fitrah & Maal</div>
        <h1 class="slide-title">Tunaikan Zakat,<br><em>Sucikan Harta</em><br>dan Jiwa</h1>
        <p class="slide-desc">Bayar zakat fitrah dan zakat maal dengan mudah, transparan, dan tersalurkan tepat sasaran kepada mustahik yang membutuhkan.</p>
        <div class="slide-actions">
          <a href="{{ url('/#zakat') }}" class="slide-btn-main" style="background:#3b82f6;color:white">
            Bayar Zakat
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </a>
          <a href="{{ url('/kalkulator-zakat') }}" class="slide-btn-ghost">Kalkulator Zakat</a>
        </div>
      </div>
    </div>

    {{-- Slide 3: Donasi Darurat --}}
    <div class="slide">
      <div class="slide-bg" style="background-image:url('https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=1600&q=80')"></div>
      <div class="slide-overlay" style="background:linear-gradient(105deg,rgba(40,15,0,0.88) 0%,rgba(40,15,0,0.4) 60%,transparent 100%)"></div>
      <div class="slide-pattern"></div>
      <div class="slide-content">
        <div class="slide-badge"><span class="slide-badge-dot" style="background:#fb923c"></span>Donasi Darurat</div>
        <h1 class="slide-title">Ringankan Beban<br>Saudara di <em>Palestina</em><br>dan Dunia</h1>
        <p class="slide-desc">Salurkan kepedulian Anda untuk membantu korban konflik dan bencana di berbagai penjuru dunia melalui program donasi darurat kami.</p>
        <div class="slide-actions">
          <a href="{{ url('/#donasi') }}" class="slide-btn-main" style="background:#ea580c">
            Donasi Sekarang
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </a>
          <a href="{{ url('/donasi') }}" class="slide-btn-ghost">Lihat Campaign</a>
        </div>
      </div>
    </div>

    {{-- Slide 4: Beasiswa --}}
    <div class="slide">
      <div class="slide-bg" style="background-image:url('https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?w=1600&q=80')"></div>
      <div class="slide-overlay" style="background:linear-gradient(105deg,rgba(18,8,42,0.88) 0%,rgba(18,8,42,0.4) 60%,transparent 100%)"></div>
      <div class="slide-pattern"></div>
      <div class="slide-content">
        <div class="slide-badge"><span class="slide-badge-dot" style="background:#c084fc"></span>Program Beasiswa</div>
        <h1 class="slide-title">Wujudkan Impian<br>Generasi <em>Penerus</em><br>Bangsa</h1>
        <p class="slide-desc">Bantu anak-anak berprestasi yang kurang mampu meraih pendidikan terbaik melalui program beasiswa berkelanjutan Berkahin.</p>
        <div class="slide-actions">
          <a href="{{ url('/#donasi') }}" class="slide-btn-main" style="background:#7c3aed">
            Donasi Beasiswa
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </a>
          <a href="{{ url('/program/beasiswa') }}" class="slide-btn-ghost">Lihat Penerima</a>
        </div>
      </div>
    </div>

  </div>{{-- end slides-track --}}

  {{-- Arrow kiri --}}
  <button class="slider-arrow" id="arrowPrev" onclick="prevSlide()">
    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M10 3L5 8l5 5" stroke="white" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
  </button>

  {{-- Arrow kanan --}}
  <button class="slider-arrow" id="arrowNext" onclick="nextSlide()">
    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M6 3l5 5-5 5" stroke="white" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
  </button>

  
</section>
<div class="slide-progress-wrapper">
  <div class="slide-progress-bar" id="progressBar"></div>
</div>
{{-- ══════════════════════════════════════
     DONASI SECTION
══════════════════════════════════════ --}}
<section class="section" id="donasi">
  <div class="container">
    <div class="section-header-row">
      <div class="section-header" style="margin-bottom:0">
        <div class="section-eyebrow reveal">Berbagi Kebaikan</div>
        <h2 class="section-title reveal reveal-delay-1">Rekomendasi <em>Campaign</em><br>Terpilih</h2>
        <p class="section-desc reveal reveal-delay-2">Pilih campaign yang sesuai dengan niat baik Anda. Setiap rupiah tersalurkan dengan transparan dan tepat sasaran.</p>
      </div>
      <a href="{{ url('/donasi') }}" class="btn-see-all reveal reveal-delay-1">
        Lihat Semua
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </a>
    </div>

    <div style="height:40px"></div>

    <div class="donasi-grid">

      <a href="{{ url('/donasi/qurban') }}" class="donasi-card reveal">
        <div class="donasi-thumb">
          <div class="donasi-thumb-bg" style="background:linear-gradient(135deg,#0d3d26,#1a6b4a)">🐑</div>
          <span class="donasi-thumb-cat">Qurban</span>
          <span class="donasi-thumb-urgent">Promo</span>
        </div>
        <div class="donasi-body">
          <div class="donasi-org">
            <div class="donasi-org-dot"><svg viewBox="0 0 8 8" fill="#1a6b4a"><circle cx="4" cy="4" r="3"/></svg></div>
            Laznas BMH
          </div>
          <div class="donasi-title">Semua Bisa Berqurban — Promo Terbatas 1446 H</div>
          <div class="donasi-bar-wrap"><div class="donasi-bar" style="width:62%"></div></div>
          <div class="donasi-meta">
            <span class="donasi-meta-collected">Rp 187.500.000</span>
            <span>62% dari Rp 300 Juta</span>
          </div>
          <div class="donasi-footer">
            <div class="donasi-price">Mulai <strong>Rp 1.399.000</strong></div>
            <button class="donasi-btn">Qurban</button>
          </div>
        </div>
      </a>

      <a href="{{ url('/donasi/palestina') }}" class="donasi-card reveal reveal-delay-1">
        <div class="donasi-thumb">
          <div class="donasi-thumb-bg" style="background:linear-gradient(135deg,#7c1a1a,#c0392b)">🇵🇸</div>
          <span class="donasi-thumb-cat">Darurat</span>
          <span class="donasi-thumb-urgent">Mendesak</span>
        </div>
        <div class="donasi-body">
          <div class="donasi-org">
            <div class="donasi-org-dot"><svg viewBox="0 0 8 8" fill="#1a6b4a"><circle cx="4" cy="4" r="3"/></svg></div>
            Yayasan Kemanusiaan
          </div>
          <div class="donasi-title">Bantuan Darurat Pengungsi Palestina Gaza</div>
          <div class="donasi-bar-wrap"><div class="donasi-bar" style="width:78%;background:#dc2626"></div></div>
          <div class="donasi-meta">
            <span class="donasi-meta-collected" style="color:#dc2626">Rp 624.000.000</span>
            <span>78% dari Rp 800 Juta</span>
          </div>
          <div class="donasi-footer">
            <div class="donasi-price">Mulai <strong>Rp 10.000</strong></div>
            <button class="donasi-btn">Donasi</button>
          </div>
        </div>
      </a>

      <a href="{{ url('/donasi/beasiswa') }}" class="donasi-card reveal reveal-delay-2">
        <div class="donasi-thumb">
          <div class="donasi-thumb-bg" style="background:linear-gradient(135deg,#1a3a6b,#2d6a9f)">📚</div>
          <span class="donasi-thumb-cat">Pendidikan</span>
        </div>
        <div class="donasi-body">
          <div class="donasi-org">
            <div class="donasi-org-dot"><svg viewBox="0 0 8 8" fill="#1a6b4a"><circle cx="4" cy="4" r="3"/></svg></div>
            Yayasan Cendekia
          </div>
          <div class="donasi-title">Beasiswa Penuh untuk 100 Siswa Berprestasi</div>
          <div class="donasi-bar-wrap"><div class="donasi-bar" style="width:45%;background:#2563eb"></div></div>
          <div class="donasi-meta">
            <span class="donasi-meta-collected" style="color:#2563eb">Rp 225.000.000</span>
            <span>45% dari Rp 500 Juta</span>
          </div>
          <div class="donasi-footer">
            <div class="donasi-price">Mulai <strong>Rp 50.000</strong></div>
            <button class="donasi-btn">Donasi</button>
          </div>
        </div>
      </a>

    </div>
  </div>
</section>

{{-- ══════════════════════════════════════
     CTA BANNER — ZAKAT
══════════════════════════════════════ --}}
<div style="background:var(--bg2);padding:0 0 80px" id="zakat">
  <div class="container">
    <div class="cta-banner reveal">
      <div class="cta-bg-pattern"></div>
      <div class="cta-circle"></div>
      <div class="cta-circle2"></div>
      <div class="cta-left">
        <div class="cta-eyebrow">Zakat & Infaq</div>
        <h2 class="cta-title">Tunaikan Zakat Anda<br>Bersama <em>Berkahin</em></h2>
        <p class="cta-desc">Hitung dan bayar zakat fitrah serta zakat maal dengan mudah. Tersalurkan langsung kepada 8 golongan mustahik yang berhak.</p>
      </div>
      <div class="cta-right">
        <a href="{{ url('/zakat') }}" class="btn-accent">
          <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M8 1v14M1 8h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
          Bayar Zakat
        </a>
        <a href="{{ url('/kalkulator-zakat') }}" class="btn-white-ghost">Kalkulator Zakat</a>
      </div>
    </div>
  </div>
</div>

{{-- ══════════════════════════════════════
     BLOG SECTION
══════════════════════════════════════ --}}
<section class="section section-alt" id="blog">
  <div class="container">
    <div class="section-header-row">
      <div class="section-header" style="margin-bottom:0">
        <div class="section-eyebrow reveal">Artikel & Inspirasi</div>
        <h2 class="section-title reveal reveal-delay-1">Tulisan Terbaru<br>dari <em>Berkahin</em></h2>
        <p class="section-desc reveal reveal-delay-2">Temukan inspirasi, panduan, dan cerita kebaikan dari komunitas donatur dan penerima manfaat kami.</p>
      </div>
      <a href="{{ url('/blog') }}" class="btn-see-all reveal reveal-delay-1">
        Lihat Semua
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </a>
    </div>

    <div style="height:40px"></div>

    <div class="blog-grid">

      <a href="{{ url('/blog/panduan-qurban') }}" class="blog-card reveal">
        <div class="blog-thumb" style="background:linear-gradient(135deg,#064e3b,#065f46)">🌙</div>
        <div class="blog-body">
          <div class="blog-cat">Fiqih & Ibadah</div>
          <div class="blog-title">Panduan Lengkap Ibadah Qurban: Syarat, Waktu, dan Tata Cara yang Benar</div>
          <div class="blog-excerpt">Memahami ibadah qurban secara menyeluruh agar pelaksanaannya sesuai syariat dan mendapatkan keberkahan yang optimal...</div>
          <div class="blog-footer">
            <div class="blog-author">
              <div class="blog-author-avatar">US</div>
              <span>Ust. Salim</span>
            </div>
            <div class="blog-date">3 Apr 2025</div>
          </div>
        </div>
      </a>

      <a href="{{ url('/blog/tips-donasi') }}" class="blog-card reveal reveal-delay-1">
        <div class="blog-thumb" style="background:linear-gradient(135deg,#1e3a5f,#2563a8)">💡</div>
        <div class="blog-body">
          <div class="blog-cat">Tips Donasi</div>
          <div class="blog-title">5 Tips Memilih Program Donasi yang Tepat dan Terpercaya di Era Digital</div>
          <div class="blog-excerpt">Dengan banyaknya platform donasi online, penting untuk mengetahui cara memilih lembaga yang amanah dan transparan...</div>
          <div class="blog-footer">
            <div class="blog-author">
              <div class="blog-author-avatar">RD</div>
              <span>Redaksi</span>
            </div>
            <div class="blog-date">1 Apr 2025</div>
          </div>
        </div>
      </a>

      <a href="{{ url('/blog/kisah-beasiswa') }}" class="blog-card reveal reveal-delay-2">
        <div class="blog-thumb" style="background:linear-gradient(135deg,#4a1a00,#7c3d00)">❤️</div>
        <div class="blog-body">
          <div class="blog-cat">Cerita Kebaikan</div>
          <div class="blog-title">Dari Donatur ke Harapan: Kisah Inspiratif Penerima Beasiswa Berkahin</div>
          <div class="blog-excerpt">Perkenalkan Ahmad, siswa berprestasi dari pelosok Sulawesi yang kini berkuliah di universitas impiannya berkat dukungan donatur...</div>
          <div class="blog-footer">
            <div class="blog-author">
              <div class="blog-author-avatar">NR</div>
              <span>Nur Rahmah</span>
            </div>
            <div class="blog-date">28 Mar 2025</div>
          </div>
        </div>
      </a>

    </div>
  </div>
</section>

@endsection

@push('scripts')
<script>
// ── SLIDER ──
let current = 0;
const total = 4;
const DURATION = 5000;
let autoTimer = null;

function goToSlide(n) {
  current = (n + total) % total;
  document.getElementById('slidesTrack').style.transform = `translateX(-${current * 100}%)`;
  document.querySelectorAll('.slider-dot').forEach((d, i) => d.classList.toggle('active', i === current));
  resetProgress();
}

function nextSlide() { goToSlide(current + 1); }
function prevSlide() { goToSlide(current - 1); }

function resetProgress() {
  clearTimeout(autoTimer);
  const bar = document.getElementById('progressBar');
  bar.style.transition = 'none';
  bar.style.width = '0%';
  void bar.offsetWidth;
  bar.style.transition = `width ${DURATION}ms linear`;
  bar.style.width = '100%';
  autoTimer = setTimeout(nextSlide, DURATION);
}

resetProgress();

// Pause on hover
document.getElementById('heroSlider').addEventListener('mouseenter', () => {
  clearTimeout(autoTimer);
  const bar = document.getElementById('progressBar');
  const computed = getComputedStyle(bar).width;
  const parent = bar.parentElement.offsetWidth;
  const frozen = (parseFloat(computed) / parent * 100).toFixed(2) + '%';
  bar.style.transition = 'none';
  bar.style.width = frozen;
});
document.getElementById('heroSlider').addEventListener('mouseleave', resetProgress);

// Touch / swipe
let touchStartX = 0;
document.getElementById('heroSlider').addEventListener('touchstart', e => {
  touchStartX = e.changedTouches[0].clientX;
}, { passive: true });
document.getElementById('heroSlider').addEventListener('touchend', e => {
  const diff = touchStartX - e.changedTouches[0].clientX;
  if (Math.abs(diff) > 50) diff > 0 ? nextSlide() : prevSlide();
});
</script>
@endpush