@extends('layouts.app')

@section('title', 'Blog Islam — Cahaya Islam')

@section('styles')
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --green:        #1a9270;
    --green-light:  #e8f7f2;
    --green-mid:    #7dd4bc;
    --green-dark:   #074e3a;
    --teal:         #0d6652;
    --gold:         #b8720f;
    --gold-light:   #fdf3e3;
    --gold-mid:     #f5c878;
    --cream:        #fdfaf6;
    --warm-white:   #ffffff;
    --bg-secondary: #f5f2ee;
    --text:         #1c1c1a;
    --text-muted:   #5a5a55;
    --text-faint:   #9a9a93;
    --border:       rgba(0,0,0,0.09);
    --border-hover: rgba(0,0,0,0.20);
    --shadow-sm:    0 1px 3px rgba(0,0,0,0.07), 0 1px 2px rgba(0,0,0,0.05);
    --shadow-md:    0 4px 12px rgba(0,0,0,0.08), 0 2px 4px rgba(0,0,0,0.05);
    --radius-md: 8px;
    --radius-lg: 14px;
    --radius-xl: 18px;
    --font-body:    'Plus Jakarta Sans', sans-serif;
    --font-serif:   'Playfair Display', serif;
    --font-arabic:  'Amiri', serif;
  }

  /* ── GOOGLE FONTS ── */
  @import url('https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Playfair+Display:wght@500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap');

  .blog-page { font-family: var(--font-body); background: var(--bg-secondary); color: var(--text); font-size: 15px; line-height: 1.65; }
  .blog-page a { text-decoration: none; color: inherit; }

  /* ── BREAKING STRIP ── */
  .breaking-strip {
    background: var(--green-dark);
    color: white;
    padding: 0.45rem 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    overflow: hidden;
  }
  .breaking-label {
    background: var(--gold);
    color: white;
    padding: 2px 9px;
    border-radius: 3px;
    font-weight: 700;
    font-size: 9.5px;
    letter-spacing: 0.1em;
    white-space: nowrap;
    flex-shrink: 0;
  }
  .breaking-ticker { overflow: hidden; flex: 1; }
  .breaking-text {
    display: inline-block;
    white-space: nowrap;
    font-size: 12px;
    opacity: 0.92;
    animation: blog-ticker 30s linear infinite;
  }
  @keyframes blog-ticker { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }

  /* ── HEADER ── */
  .blog-header {
    background: var(--warm-white);
    text-align: center;
    padding: 2rem 1.5rem 1.6rem;
    border-bottom: 1px solid var(--border);
    position: relative;
    overflow: hidden;
  }
  .blog-header::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 60% 80% at 50% -10%, rgba(26,146,112,0.07) 0%, transparent 70%);
    pointer-events: none;
  }
  .arabic-deco {
    font-family: var(--font-arabic);
    font-size: 1.1rem;
    color: var(--gold);
    letter-spacing: 0.06em;
    margin-bottom: 0.5rem;
    position: relative;
  }
  .blog-site-name {
    font-family: var(--font-arabic);
    font-size: 3rem;
    font-weight: 700;
    color: var(--green-dark);
    line-height: 1.1;
    margin-bottom: 0.3rem;
    position: relative;
  }
  .blog-site-tagline {
    font-size: 11.5px;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--text-muted);
    position: relative;
  }

  /* ── NAV ── */
  .blog-nav {
    background: var(--warm-white);
    display: flex;
    justify-content: center;
    border-bottom: 1px solid var(--border);
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }
  .blog-nav::-webkit-scrollbar { display: none; }
  .blog-nav-item {
    padding: 0.85rem 1.25rem;
    font-size: 12.5px;
    font-weight: 600;
    cursor: pointer;
    border-bottom: 2.5px solid transparent;
    white-space: nowrap;
    color: var(--text-muted);
    transition: color 0.2s, border-color 0.2s;
    user-select: none;
    letter-spacing: 0.02em;
  }
  .blog-nav-item:hover { color: var(--green); }
  .blog-nav-item.active { color: var(--green-dark); border-bottom-color: var(--green); }

  /* ── HERO ── */
  .blog-hero {
    background: var(--warm-white);
    padding: 1.5rem;
    display: grid;
    grid-template-columns: 1.7fr 1fr;
    gap: 1rem;
    border-bottom: 1px solid var(--border);
    max-width: 1200px;
    margin: 0 auto;
  }
  @media (max-width: 700px) { .blog-hero { grid-template-columns: 1fr; } }

  .hero-main {
    border-radius: var(--radius-xl);
    overflow: hidden;
    cursor: pointer;
    box-shadow: var(--shadow-sm);
    transition: box-shadow 0.25s, transform 0.2s;
    background: var(--warm-white);
    border: 1px solid var(--border);
    text-decoration: none;
    display: block;
  }
  .hero-main:hover { box-shadow: var(--shadow-md); transform: translateY(-3px); }
  .hero-img {
    width: 100%;
    height: 220px;
    position: relative;
    overflow: hidden;
    background: linear-gradient(135deg, #074e3a 0%, #1a9270 60%, #7dd4bc 100%);
  }
  .hero-img img {
    width: 100%; height: 100%;
    object-fit: cover; opacity: 0;
    transition: opacity 0.5s;
  }
  .hero-img img.loaded { opacity: 1; }
  .hero-img-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to top, rgba(7,78,58,0.55) 0%, transparent 55%);
  }
  .hero-badge {
    position: absolute; top: 12px; left: 12px;
    background: var(--gold); color: white;
    padding: 3px 10px; border-radius: 4px;
    font-size: 10px; font-weight: 700; letter-spacing: 0.09em;
  }
  .hero-content { padding: 1.3rem 1.3rem 1.1rem; }
  .hero-cat {
    font-size: 10.5px; font-weight: 700; color: var(--green);
    text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 0.45rem;
  }
  .hero-title {
    font-family: var(--font-serif); font-size: 1.2rem; font-weight: 700;
    line-height: 1.4; color: var(--text); margin-bottom: 0.6rem;
  }
  .hero-excerpt { font-size: 13px; color: var(--text-muted); line-height: 1.7; margin-bottom: 0.9rem; }
  .hero-meta { font-size: 11px; color: var(--text-faint); display: flex; gap: 1rem; flex-wrap: wrap; }

  .hero-side { display: flex; flex-direction: column; gap: 0.85rem; }
  .side-card {
    display: flex; gap: 0.75rem;
    border-radius: var(--radius-lg); cursor: pointer;
    background: var(--warm-white);
    transition: box-shadow 0.2s, transform 0.15s;
    box-shadow: var(--shadow-sm); border: 1px solid var(--border);
    overflow: hidden; text-decoration: none;
  }
  .side-card:hover { box-shadow: var(--shadow-md); transform: translateX(3px); }
  .side-thumb {
    width: 90px; min-height: 70px; flex-shrink: 0;
    position: relative;
    background: linear-gradient(135deg, var(--green-light), var(--green-mid));
    overflow: hidden;
  }
  .side-thumb img {
    width: 100%; height: 100%; object-fit: cover;
    opacity: 0; transition: opacity 0.4s;
    position: absolute; inset: 0;
  }
  .side-thumb img.loaded { opacity: 1; }
  .side-thumb-icon {
    position: absolute; inset: 0;
    display: flex; align-items: center; justify-content: center; font-size: 26px;
  }
  .side-info { padding: 0.7rem 0.75rem 0.7rem 0; display: flex; flex-direction: column; justify-content: center; }
  .side-title { font-size: 12.5px; font-weight: 600; line-height: 1.4; color: var(--text); margin-bottom: 0.3rem; }
  .side-meta { font-size: 10.5px; color: var(--text-faint); }

  /* ── MAIN LAYOUT ── */
  .blog-main-layout {
    display: grid;
    grid-template-columns: 1fr 290px;
    gap: 1.5rem;
    padding: 1.5rem;
    max-width: 1200px;
    margin: 0 auto;
  }
  @media (max-width: 880px) { .blog-main-layout { grid-template-columns: 1fr; } }

  /* ── SECTION HEADER ── */
  .blog-section-hd {
    display: flex; align-items: center; gap: 0.75rem;
    margin-bottom: 1.1rem; padding-bottom: 0.65rem;
    border-bottom: 1px solid var(--border);
  }
  .blog-section-line { width: 28px; height: 3px; background: var(--green); border-radius: 2px; }
  .blog-section-ttl { font-family: var(--font-serif); font-size: 1.05rem; font-weight: 700; color: var(--text); }

  /* ── ARTICLES GRID ── */
  .articles-grid {
    display: grid; grid-template-columns: repeat(2, 1fr);
    gap: 1rem; margin-bottom: 1.2rem;
  }
  @media (max-width: 520px) { .articles-grid { grid-template-columns: 1fr; } }

  .article-card {
    background: var(--warm-white); border: 1px solid var(--border);
    border-radius: var(--radius-lg); overflow: hidden; cursor: pointer;
    transition: box-shadow 0.22s, transform 0.18s;
    box-shadow: var(--shadow-sm); text-decoration: none; display: block;
    animation: blogFadeIn 0.3s ease forwards;
  }
  @keyframes blogFadeIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
  .article-card:hover { box-shadow: var(--shadow-md); transform: translateY(-3px); }

  .card-thumb {
    height: 148px; position: relative; overflow: hidden;
    background: linear-gradient(135deg, var(--green-light), var(--green-mid));
  }
  .card-thumb img { width: 100%; height: 100%; object-fit: cover; opacity: 0; transition: opacity 0.5s; }
  .card-thumb img.loaded { opacity: 1; }
  .card-thumb-icon { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; font-size: 36px; }
  .card-img-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.25) 0%, transparent 50%); z-index: 1; }
  .card-cat-badge {
    position: absolute; top: 9px; left: 9px;
    font-size: 9.5px; font-weight: 700;
    padding: 2.5px 8px; border-radius: 3px;
    text-transform: uppercase; letter-spacing: 0.07em; z-index: 2;
  }
  .cat-berita  { background: var(--green-light); color: var(--teal); }
  .cat-kajian  { background: #e6f0fa; color: #1a5fa5; }
  .cat-sosial  { background: #fbeaf0; color: #993556; }
  .cat-zakat   { background: var(--gold-light); color: var(--gold); }
  .cat-haji    { background: var(--gold-light); color: var(--gold); }
  .cat-mualaf  { background: var(--green-light); color: var(--teal); }
  .cat-ekonomi { background: #eef7ee; color: #2d7a2d; }
  .cat-ramadhan{ background: #f3eafd; color: #6b21a8; }

  .card-body { padding: 0.95rem; }
  .card-title {
    font-size: 13px; font-weight: 600; line-height: 1.5; color: var(--text);
    margin-bottom: 0.55rem;
    display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;
  }
  .card-meta { font-size: 11px; color: var(--text-faint); display: flex; justify-content: space-between; align-items: center; }
  .card-read { color: var(--green); font-weight: 600; font-size: 11.5px; }

  /* ── LOAD MORE ── */
  .load-more-btn {
    width: 100%; padding: 0.75rem;
    border: 1.5px solid var(--green-mid);
    border-radius: var(--radius-md);
    background: transparent; color: var(--green);
    font-size: 13px; font-weight: 600; cursor: pointer;
    margin-top: 0.25rem;
    transition: background 0.2s, color 0.2s;
    font-family: var(--font-body); letter-spacing: 0.02em;
  }
  .load-more-btn:hover { background: var(--green-light); }

  /* ── SIDEBAR ── */
  .jadwal-widget {
    background: var(--green-dark); border-radius: var(--radius-lg);
    padding: 1.1rem 1.2rem; margin-bottom: 1rem; box-shadow: var(--shadow-sm);
  }
  .jadwal-title { font-family: var(--font-arabic); font-size: 1.15rem; color: var(--green-mid); margin-bottom: 0.15rem; }
  .jadwal-city { font-size: 10.5px; color: rgba(255,255,255,0.45); margin-bottom: 0.85rem; }
  .jadwal-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0.42rem; }
  .jadwal-item {
    background: rgba(255,255,255,0.07); border-radius: 6px; padding: 0.45rem 0.65rem;
    display: flex; justify-content: space-between; font-size: 12px;
  }
  .jadwal-item.aktif { background: rgba(125,212,188,0.2); }
  .jadwal-label { color: rgba(255,255,255,0.6); }
  .jadwal-time { font-weight: 600; color: white; }

  .quran-widget {
    background: var(--gold-light); border: 1px solid #f0d8a0;
    border-radius: var(--radius-lg); padding: 1.1rem 1.15rem;
    margin-bottom: 1rem; text-align: center; box-shadow: var(--shadow-sm);
  }
  .quran-top { font-size: 10px; font-weight: 700; color: var(--gold); text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 0.65rem; }
  .quran-arabic { font-family: var(--font-arabic); font-size: 1.4rem; color: var(--green-dark); line-height: 2; margin-bottom: 0.5rem; }
  .quran-trans { font-size: 12px; color: var(--text-muted); font-style: italic; line-height: 1.6; }
  .quran-ref { font-size: 11px; color: var(--gold); margin-top: 0.45rem; font-weight: 700; }

  .sidebar-widget {
    background: var(--warm-white); border: 1px solid var(--border);
    border-radius: var(--radius-lg); padding: 1rem 1.1rem;
    margin-bottom: 1rem; box-shadow: var(--shadow-sm);
  }
  .widget-title {
    font-size: 12.5px; font-weight: 700; color: var(--text);
    margin-bottom: 0.8rem; padding-bottom: 0.55rem;
    border-bottom: 1px solid var(--border); letter-spacing: 0.02em;
  }
  .trending-item {
    display: flex; gap: 0.65rem; padding: 0.55rem 0;
    border-bottom: 1px solid var(--border);
    cursor: pointer; transition: opacity 0.2s; text-decoration: none;
  }
  .trending-item:last-child { border-bottom: none; }
  .trending-item:hover { opacity: 0.7; }
  .trending-num { font-size: 18px; font-weight: 700; color: rgba(0,0,0,0.12); line-height: 1; min-width: 24px; padding-top: 2px; }
  .trending-text { font-size: 12.5px; line-height: 1.45; color: var(--text); }
  .trending-meta { font-size: 11px; color: var(--text-faint); margin-top: 2px; }

  .tag-cloud { display: flex; flex-wrap: wrap; gap: 0.4rem; }
  .tag {
    background: var(--bg-secondary); border: 1px solid var(--border);
    padding: 4px 11px; border-radius: 20px; font-size: 11px;
    cursor: pointer; color: var(--text-muted);
    transition: background 0.2s, color 0.2s, border-color 0.2s; font-weight: 500;
  }
  .tag:hover { background: var(--green-light); color: var(--teal); border-color: var(--green-mid); }

  .shimmer {
    background: linear-gradient(90deg, #f0ede8 25%, #e8e5e0 50%, #f0ede8 75%);
    background-size: 200% 100%;
    animation: blog-shimmer 1.4s infinite;
  }
  @keyframes blog-shimmer { 0% { background-position: 200% 0; } 100% { background-position: -200% 0; } }
</style>
@endsection

@section('content')
<div class="blog-page">

  {{-- BREAKING STRIP --}}
  <div class="breaking-strip">
    <span class="breaking-label">TERKINI</span>
    <div class="breaking-ticker">
      <span class="breaking-text">
        Masjid Istiqlal Jakarta Kembali Gelar Kajian Bulanan &nbsp;•&nbsp;
        MUI Rilis Panduan Digital untuk Generasi Muda Muslim &nbsp;•&nbsp;
        Program Wakaf Produktif Hasilkan 2.000 Lapangan Kerja &nbsp;•&nbsp;
        Beasiswa Santri Berprestasi 2026 Dibuka Pendaftarannya &nbsp;•&nbsp;
        BAZNAS Distribusi Bantuan ke 500 Keluarga Dhuafa Jatim &nbsp;•&nbsp;
        Masjid Istiqlal Jakarta Kembali Gelar Kajian Bulanan &nbsp;•&nbsp;
        MUI Rilis Panduan Digital untuk Generasi Muda Muslim &nbsp;•&nbsp;
        Program Wakaf Produktif Hasilkan 2.000 Lapangan Kerja &nbsp;•&nbsp;
        Beasiswa Santri Berprestasi 2026 Dibuka Pendaftarannya &nbsp;•&nbsp;
        BAZNAS Distribusi Bantuan ke 500 Keluarga Dhuafa Jatim
      </span>
    </div>
  </div>

  {{-- HEADER --}}
  <header class="blog-header">
    <div class="arabic-deco">بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ</div>
    <div class="blog-site-name">Cahaya Islam</div>
    <div class="blog-site-tagline">Portal Berita Islam Terpercaya</div>
  </header>

  {{-- NAV --}}
  <nav class="blog-nav">
    <div class="blog-nav-item active" data-tab="semua">Semua</div>
    <div class="blog-nav-item" data-tab="berita">Berita</div>
    <div class="blog-nav-item" data-tab="kajian">Kajian</div>
    <div class="blog-nav-item" data-tab="ramadhan">Ramadhan</div>
    <div class="blog-nav-item" data-tab="mualaf">Mualaf</div>
    <div class="blog-nav-item" data-tab="ekonomi">Ekonomi Syariah</div>
  </nav>

  {{-- HERO --}}
  <section style="background:var(--warm-white); border-bottom:1px solid var(--border);">
    <div class="blog-hero" id="hero-section">
      <div style="height:320px;border-radius:var(--radius-xl);" class="shimmer"></div>
      <div style="display:flex;flex-direction:column;gap:.85rem;">
        <div class="shimmer" style="height:90px;border-radius:var(--radius-lg);"></div>
        <div class="shimmer" style="height:90px;border-radius:var(--radius-lg);"></div>
        <div class="shimmer" style="height:90px;border-radius:var(--radius-lg);"></div>
      </div>
    </div>
  </section>

  {{-- MAIN --}}
  <div class="blog-main-layout">
    <main>
      <div class="blog-section-hd">
        <div class="blog-section-line"></div>
        <h2 class="blog-section-ttl" id="section-title">Berita &amp; Artikel Terbaru</h2>
      </div>
      <div class="articles-grid" id="articles-grid">
        <div class="shimmer" style="height:260px;border-radius:var(--radius-lg);"></div>
        <div class="shimmer" style="height:260px;border-radius:var(--radius-lg);"></div>
        <div class="shimmer" style="height:260px;border-radius:var(--radius-lg);"></div>
        <div class="shimmer" style="height:260px;border-radius:var(--radius-lg);"></div>
      </div>
      <button class="load-more-btn" id="load-more-btn" onclick="loadMore()">Muat Lebih Banyak Artikel ↗</button>
    </main>

    {{-- SIDEBAR --}}
    <aside>
      <div class="jadwal-widget">
        <div class="jadwal-title">Jadwal Sholat</div>
        <div class="jadwal-city">Surabaya, Jawa Timur</div>
        <div class="jadwal-grid">
          <div class="jadwal-item"><span class="jadwal-label">Subuh</span><span class="jadwal-time">04:20</span></div>
          <div class="jadwal-item aktif"><span class="jadwal-label">Dzuhur</span><span class="jadwal-time">11:45</span></div>
          <div class="jadwal-item"><span class="jadwal-label">Ashar</span><span class="jadwal-time">15:07</span></div>
          <div class="jadwal-item"><span class="jadwal-label">Maghrib</span><span class="jadwal-time">17:46</span></div>
          <div class="jadwal-item"><span class="jadwal-label">Isya</span><span class="jadwal-time">19:00</span></div>
          <div class="jadwal-item"><span class="jadwal-label">Jum'at</span><span class="jadwal-time">11:30</span></div>
        </div>
      </div>

      <div class="quran-widget">
        <div class="quran-top">Ayat Hari Ini</div>
        <div class="quran-arabic" lang="ar">وَأَنفِقُوا فِي سَبِيلِ اللَّهِ</div>
        <div class="quran-trans">"Dan infakkanlah (hartamu) di jalan Allah"</div>
        <div class="quran-ref">QS. Al-Baqarah: 195</div>
      </div>

      <div class="sidebar-widget">
        <div class="widget-title">Trending Hari Ini</div>
        <a class="trending-item" href="https://www.republika.co.id/berita/ramadhan" target="_blank" rel="noopener">
          <div class="trending-num">01</div>
          <div><div class="trending-text">Gerakan Sedekah Subuh Viral di Media Sosial</div><div class="trending-meta">2.3k pembaca</div></div>
        </a>
        <a class="trending-item" href="https://www.nu.or.id/nasional" target="_blank" rel="noopener">
          <div class="trending-num">02</div>
          <div><div class="trending-text">Pesantren Digital Pertama Indonesia Raih Pengakuan Dunia</div><div class="trending-meta">1.8k pembaca</div></div>
        </a>
        <a class="trending-item" href="https://islampos.com/hukum-investasi-saham-syariah" target="_blank" rel="noopener">
          <div class="trending-num">03</div>
          <div><div class="trending-text">Hukum Investasi Saham Syariah Menurut Ulama</div><div class="trending-meta">1.2k pembaca</div></div>
        </a>
        <a class="trending-item" href="https://mui.or.id" target="_blank" rel="noopener">
          <div class="trending-num">04</div>
          <div><div class="trending-text">Indonesia Tuan Rumah Konferensi Islam Internasional 2026</div><div class="trending-meta">980 pembaca</div></div>
        </a>
      </div>

      <div class="sidebar-widget">
        <div class="widget-title">Topik Populer</div>
        <div class="tag-cloud">
          <a class="tag" href="https://www.republika.co.id/tag/Gaza" target="_blank" rel="noopener">Gaza</a>
          <a class="tag" href="https://baznas.go.id/zakat" target="_blank" rel="noopener">Zakat</a>
          <a class="tag" href="https://www.nu.or.id/kajian" target="_blank" rel="noopener">Kajian</a>
          <a class="tag" href="https://bwi.go.id" target="_blank" rel="noopener">Wakaf</a>
          <a class="tag" href="https://www.republika.co.id/tag/halal" target="_blank" rel="noopener">Halal</a>
          <a class="tag" href="https://www.nu.or.id/pendidikan" target="_blank" rel="noopener">Pesantren</a>
          <a class="tag" href="https://haji.kemenag.go.id" target="_blank" rel="noopener">Haji &amp; Umroh</a>
          <a class="tag" href="https://www.ojk.go.id/id/kanal/syariah" target="_blank" rel="noopener">Ekonomi Syariah</a>
          <a class="tag" href="https://islampos.com" target="_blank" rel="noopener">Mualaf</a>
          <a class="tag" href="https://www.republika.co.id/tag/dakwah" target="_blank" rel="noopener">Dakwah</a>
        </div>
      </div>
    </aside>
  </div>

</div>{{-- end .blog-page --}}
@endsection

@push('scripts')
<script>
  const ALL_ARTICLES = {
    semua: [
      { url:'https://www.republika.co.id/berita/qquap1440/solidaritas-umat-islam-indonesia-untuk-gaza', img:'https://images.unsplash.com/photo-1609743522471-83c84ce23e32?w=800&q=80', icon:'🕌', cat:'Berita', catClass:'cat-berita', bg:'linear-gradient(135deg,#e8f7f2,#1a9270)', title:'Solidaritas Umat Islam Indonesia untuk Gaza: Donasi Melebihi Target', date:'17 Apr 2026', isHero:true, excerpt:'Umat Islam di seluruh Indonesia menunjukkan kepedulian luar biasa melalui berbagai gerakan donasi kemanusiaan yang terkoordinasi lintas ormas Islam besar.' },
      { url:'https://www.nu.or.id/nasional/wakaf-produktif-dorong-ekonomi-umat', img:'https://images.unsplash.com/photo-1564890369478-c89ca6d9cde9?w=400&q=80', icon:'🕌', cat:'Ekonomi Islam', catClass:'cat-ekonomi', title:'Wakaf Produktif Dorong Ekonomi Umat di 12 Provinsi', date:'3 jam lalu', isSide:true },
      { url:'https://mui.or.id/berita/panduan-ai-dakwah', img:'https://images.unsplash.com/photo-1620712943543-bcc4688e7485?w=400&q=80', icon:'📱', cat:'Fatwa & Hukum', catClass:'cat-kajian', title:'MUI Keluarkan Panduan Penggunaan AI dalam Dakwah Digital', date:'5 jam lalu', isSide:true },
      { url:'https://kemenag.go.id/berita/beasiswa-santri-2026', img:'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=400&q=80', icon:'📖', cat:'Pendidikan', catClass:'cat-kajian', title:'Beasiswa Penuh untuk 1.000 Santri Berprestasi Dibuka', date:'8 jam lalu', isSide:true },
      { url:'https://www.republika.co.id/berita/ekonomi/perbankan/bsi-laba-tertinggi', img:'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=600&q=80', icon:'🏦', bg:'linear-gradient(135deg,#d4f0e8,#7dd4bc)', cat:'Ekonomi', catClass:'cat-ekonomi', title:'Bank Syariah Indonesia Raih Laba Tertinggi Sepanjang Sejarah', date:'16 Apr 2026' },
      { url:'https://baznas.go.id/berita/panduan-zakat-penghasilan-2026', img:'https://images.unsplash.com/photo-1553729459-efe14ef6055d?w=600&q=80', icon:'💰', bg:'linear-gradient(135deg,#fdf3e3,#f5c878)', cat:'Zakat', catClass:'cat-zakat', title:'Panduan Lengkap Zakat Penghasilan Profesi 2026', date:'15 Apr 2026' },
      { url:'https://www.ojk.go.id/id/kanal/syariah/berita/fintech-syariah-2026', img:'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?w=600&q=80', icon:'💻', bg:'linear-gradient(135deg,#e6f0fa,#b5d4f4)', cat:'Kajian', catClass:'cat-kajian', title:'Fintech Syariah: Antara Peluang dan Tantangan Hukum Islam', date:'14 Apr 2026' },
      { url:'https://baznas.go.id/berita/bantuan-dhuafa-jatim', img:'https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?w=600&q=80', icon:'❤️', bg:'linear-gradient(135deg,#fbeaf0,#f4c0d1)', cat:'Sosial', catClass:'cat-sosial', title:'BAZNAS Salurkan Bantuan ke 500 Keluarga Dhuafa di Jawa Timur', date:'13 Apr 2026' },
      { url:'https://islampos.com/kisah-mualaf-menemukan-islam', img:'https://images.unsplash.com/photo-1564769625905-50e93615e769?w=600&q=80', icon:'🌙', bg:'linear-gradient(135deg,#e1f5ee,#5dcaa5)', cat:'Mualaf', catClass:'cat-mualaf', title:'Kisah Inspiratif Mualaf: Perjalanan Menemukan Islam di Tengah Kota', date:'12 Apr 2026' },
      { url:'https://haji.kemenag.go.id/berita/kuota-haji-2026', img:'https://images.unsplash.com/photo-1570194065650-d99fb4bedf0a?w=600&q=80', icon:'🕋', bg:'linear-gradient(135deg,#faeeda,#ef9f27)', cat:'Haji', catClass:'cat-haji', title:'Kuota Haji Indonesia 2026 Bertambah: Ini Info Lengkapnya', date:'11 Apr 2026' },
    ],
    berita: [
      { url:'https://www.republika.co.id/berita/qquap1440/solidaritas-umat-islam-indonesia-untuk-gaza', img:'https://images.unsplash.com/photo-1609743522471-83c84ce23e32?w=800&q=80', icon:'🕌', cat:'Berita', catClass:'cat-berita', bg:'linear-gradient(135deg,#e8f7f2,#1a9270)', title:'Solidaritas Umat Islam Indonesia untuk Gaza: Donasi Melebihi Target', date:'17 Apr 2026', isHero:true, excerpt:'Umat Islam di seluruh Indonesia menunjukkan kepedulian luar biasa melalui berbagai gerakan donasi kemanusiaan yang terkoordinasi lintas ormas Islam besar.' },
      { url:'https://www.nu.or.id/nasional/mui-sambut-delegasi-oic', img:'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=400&q=80', icon:'🌍', cat:'Berita', catClass:'cat-berita', title:'MUI Sambut Delegasi OIC, Bahas Peran Islam di Panggung Global', date:'2 jam lalu', isSide:true },
      { url:'https://kemenag.go.id/berita/moderasi-beragama-2026', img:'https://images.unsplash.com/photo-1543269865-cbf427effbad?w=400&q=80', icon:'🤝', cat:'Berita', catClass:'cat-berita', title:'Kemenag Perkuat Program Moderasi Beragama di Sekolah-Sekolah', date:'6 jam lalu', isSide:true },
      { url:'https://www.republika.co.id/berita/nasional/umum/indonesia-kirim-bantuan-sudan', img:'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=400&q=80', icon:'✈️', cat:'Berita', catClass:'cat-berita', title:'Indonesia Kirim Bantuan Kemanusiaan Senilai 5 Juta USD ke Sudan', date:'9 jam lalu', isSide:true },
      { url:'https://www.republika.co.id/berita/konferensi-islam-internasional', img:'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=600&q=80', icon:'🏛️', bg:'linear-gradient(135deg,#e8f7f2,#7dd4bc)', cat:'Berita', catClass:'cat-berita', title:'Indonesia Tuan Rumah Konferensi Islam Internasional 2026 di Surabaya', date:'16 Apr 2026' },
      { url:'https://www.nu.or.id/nasional/pesantren-digital-pertama', img:'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=600&q=80', icon:'💡', bg:'linear-gradient(135deg,#e6f0fa,#b5d4f4)', cat:'Berita', catClass:'cat-berita', title:'Pesantren Digital Pertama Indonesia Raih Pengakuan UNESCO', date:'15 Apr 2026' },
      { url:'https://www.republika.co.id/berita/sidang-isbat-2026', img:'https://images.unsplash.com/photo-1517483000871-1dbf64a6e1c6?w=600&q=80', icon:'🌙', bg:'linear-gradient(135deg,#1a1a3e,#4a3f8e)', cat:'Berita', catClass:'cat-berita', title:'Sidang Isbat Penetapan 1 Dzulhijjah 1447 H Digelar Besok', date:'14 Apr 2026' },
      { url:'https://kemenag.go.id/berita/masjid-istiqlal-renovasi', img:'https://images.unsplash.com/photo-1549497538-303791108f95?w=600&q=80', icon:'🕌', bg:'linear-gradient(135deg,#fdf3e3,#f5c878)', cat:'Berita', catClass:'cat-berita', title:'Renovasi Tahap II Masjid Istiqlal Rampung, Kapasitas Naik 3x Lipat', date:'13 Apr 2026' },
    ],
    kajian: [
      { url:'https://www.nu.or.id/kajian/hukum-media-sosial-islam', img:'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=800&q=80', icon:'📚', cat:'Kajian', catClass:'cat-kajian', bg:'linear-gradient(135deg,#e6f0fa,#1a5fa5)', title:'Hukum Penggunaan Media Sosial dalam Pandangan Islam: Kajian Mendalam', date:'17 Apr 2026', isHero:true, excerpt:'Para ulama mengkaji secara mendalam bagaimana media sosial harus digunakan oleh umat Islam, mulai dari konten yang diposting hingga adab berinteraksi di dunia maya.' },
      { url:'https://mui.or.id/kajian/tafsir-surah-al-hujurat', img:'https://images.unsplash.com/photo-1585036156171-384164a8c675?w=400&q=80', icon:'📖', cat:'Tafsir', catClass:'cat-kajian', title:'Tafsir Surah Al-Hujurat: Panduan Islam dalam Bermasyarakat', date:'4 jam lalu', isSide:true },
      { url:'https://www.nu.or.id/kajian/fiqih-muamalah-kontemporer', img:'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=400&q=80', icon:'⚖️', cat:'Fiqih', catClass:'cat-kajian', title:'Fiqih Muamalah Kontemporer: Dari E-Commerce hingga Kripto', date:'7 jam lalu', isSide:true },
      { url:'https://islampos.com/kajian-hadits-kebersihan', img:'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=400&q=80', icon:'🌿', cat:'Hadits', catClass:'cat-kajian', title:'Kajian Hadits: Kebersihan Sebagian dari Iman dalam Kehidupan Modern', date:'10 jam lalu', isSide:true },
      { url:'https://www.nu.or.id/kajian/akidah-aswaja', img:'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&q=80', icon:'🔵', bg:'linear-gradient(135deg,#e6f0fa,#b5d4f4)', cat:'Akidah', catClass:'cat-kajian', title:'Memahami Akidah Ahlus Sunnah wal Jamaah di Tengah Arus Modern', date:'16 Apr 2026' },
      { url:'https://www.republika.co.id/kajian/sholat-khusyuk', img:'https://images.unsplash.com/photo-1519817914152-22d216bb9170?w=600&q=80', icon:'🙏', bg:'linear-gradient(135deg,#f3eafd,#c4b5fd)', cat:'Ibadah', catClass:'cat-kajian', title:'Tips Meraih Kekhusyukan dalam Sholat dari Para Ulama Salaf', date:'15 Apr 2026' },
      { url:'https://islampos.com/kajian-zikir-pagi-petang', img:'https://images.unsplash.com/photo-1465101162946-4377e57745c3?w=600&q=80', icon:'🌅', bg:'linear-gradient(135deg,#fdf3e3,#f5c878)', cat:'Amalan', catClass:'cat-kajian', title:'Keutamaan Zikir Pagi dan Petang: Amalan Ringan Berpahala Besar', date:'14 Apr 2026' },
      { url:'https://www.nu.or.id/kajian/hukum-wakaf-uang', img:'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=600&q=80', icon:'🏦', bg:'linear-gradient(135deg,#d4f0e8,#7dd4bc)', cat:'Fiqih', catClass:'cat-kajian', title:'Hukum Wakaf Uang dalam Islam dan Implementasinya di Indonesia', date:'13 Apr 2026' },
    ],
    ramadhan: [
      { url:'https://www.republika.co.id/ramadhan/persiapan-ramadhan-2027', img:'https://images.unsplash.com/photo-1532453288672-3a17ac2d533e?w=800&q=80', icon:'🌙', cat:'Ramadhan', catClass:'cat-ramadhan', bg:'linear-gradient(135deg,#2d1b69,#7c3aed)', title:'Mempersiapkan Ramadhan 2027: Panduan Spiritual dan Amaliyah', date:'17 Apr 2026', isHero:true, excerpt:'Dengan Ramadhan yang sudah terlewati, kini saatnya umat Islam mulai mempersiapkan diri secara spiritual, fisik, dan finansial untuk menyambut Ramadhan berikutnya dengan lebih baik.' },
      { url:'https://www.republika.co.id/ramadhan/evaluasi-ramadhan-2026', img:'https://images.unsplash.com/photo-1547036967-23d11aacaee0?w=400&q=80', icon:'✅', cat:'Ramadhan', catClass:'cat-ramadhan', title:'Evaluasi Ibadah Pasca-Ramadhan: Bagaimana Menjaga Momentum?', date:'5 jam lalu', isSide:true },
      { url:'https://islampos.com/tradisi-lebaran-nusantara', img:'https://images.unsplash.com/photo-1565785755547-d4fbd1e4d6c6?w=400&q=80', icon:'🎊', cat:'Ramadhan', catClass:'cat-ramadhan', title:'Tradisi Lebaran di Nusantara yang Kaya Nilai Islami', date:'8 jam lalu', isSide:true },
      { url:'https://www.nu.or.id/ramadhan/puasa-syawal', img:'https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=400&q=80', icon:'🌟', cat:'Ramadhan', catClass:'cat-ramadhan', title:'Keutamaan Puasa 6 Hari di Bulan Syawal: Setara Puasa Setahun', date:'11 jam lalu', isSide:true },
      { url:'https://www.republika.co.id/ramadhan/zakat-fitrah-2026', img:'https://images.unsplash.com/photo-1553729459-efe14ef6055d?w=600&q=80', icon:'💰', bg:'linear-gradient(135deg,#fdf3e3,#f5c878)', cat:'Zakat', catClass:'cat-zakat', title:'Rekap Zakat Fitrah 2026: Terkumpul Rp 2,3 Triliun Nasional', date:'16 Apr 2026' },
      { url:'https://islampos.com/amalan-setelah-ramadhan', img:'https://images.unsplash.com/photo-1591985666643-9d4a3f8a5b12?w=600&q=80', icon:'🌱', bg:'linear-gradient(135deg,#e1f5ee,#5dcaa5)', cat:'Amalan', catClass:'cat-ramadhan', title:'7 Amalan yang Harus Dipertahankan Setelah Ramadhan Berakhir', date:'15 Apr 2026' },
      { url:'https://www.nu.or.id/ramadhan/fidyah-dan-qadha', img:'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=600&q=80', icon:'📋', bg:'linear-gradient(135deg,#f3eafd,#c4b5fd)', cat:'Fiqih', catClass:'cat-ramadhan', title:"Panduan Qadha dan Fidyah Puasa Ramadhan Menurut Mazhab Syafi'i", date:'14 Apr 2026' },
    ],
    mualaf: [
      { url:'https://islampos.com/kisah-mualaf-profesor-jerman', img:'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=800&q=80', icon:'🌟', cat:'Mualaf', catClass:'cat-mualaf', bg:'linear-gradient(135deg,#074e3a,#1a9270)', title:'Profesor Jerman Memeluk Islam Setelah Meneliti Al-Quran Selama 10 Tahun', date:'17 Apr 2026', isHero:true, excerpt:'Prof. Dr. Andreas Müller, seorang akademisi ternama dari Universitas Munich, resmi mengucapkan syahadat setelah satu dekade meneliti Al-Quran dari perspektif ilmiah.' },
      { url:'https://islampos.com/mualaf-artis-korea', img:'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=400&q=80', icon:'🎭', cat:'Mualaf', catClass:'cat-mualaf', title:'Artis Korea Selatan Ramai Memeluk Islam, Ini Kisah Perjalanan Mereka', date:'3 jam lalu', isSide:true },
      { url:'https://www.republika.co.id/mualaf/komunitas-pembinaan-mualaf', img:'https://images.unsplash.com/photo-1543269865-cbf427effbad?w=400&q=80', icon:'🤝', cat:'Komunitas', catClass:'cat-mualaf', title:'Komunitas Pembinaan Mualaf di Surabaya Berkembang Pesat', date:'6 jam lalu', isSide:true },
      { url:'https://islampos.com/tips-mualaf-belajar-sholat', img:'https://images.unsplash.com/photo-1585036156171-384164a8c675?w=400&q=80', icon:'📖', cat:'Panduan', catClass:'cat-mualaf', title:'Panduan Lengkap Belajar Sholat untuk Mualaf Pemula', date:'9 jam lalu', isSide:true },
      { url:'https://islampos.com/mualaf-atlet-olimpiade', img:'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=600&q=80', icon:'🏅', bg:'linear-gradient(135deg,#fdf3e3,#f5c878)', cat:'Mualaf', catClass:'cat-mualaf', title:'Atlet Olimpiade dari Brasil Ceritakan Ketenangan Setelah Masuk Islam', date:'16 Apr 2026' },
      { url:'https://www.republika.co.id/mualaf/dukungan-komunitas', img:'https://images.unsplash.com/photo-1491497895121-1334fc14d8c9?w=600&q=80', icon:'💛', bg:'linear-gradient(135deg,#e1f5ee,#5dcaa5)', cat:'Sosial', catClass:'cat-mualaf', title:'Peran Komunitas Muslim dalam Mendampingi Mualaf Baru di Indonesia', date:'15 Apr 2026' },
      { url:'https://islampos.com/pertanyaan-umum-mualaf', img:'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=600&q=80', icon:'❓', bg:'linear-gradient(135deg,#e6f0fa,#b5d4f4)', cat:'FAQ', catClass:'cat-mualaf', title:'10 Pertanyaan Paling Umum dari Mualaf Baru dan Jawabannya', date:'14 Apr 2026' },
    ],
    ekonomi: [
      { url:'https://www.ojk.go.id/id/kanal/syariah/berita/ekonomi-syariah-2026', img:'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?w=800&q=80', icon:'📈', cat:'Ekonomi Syariah', catClass:'cat-ekonomi', bg:'linear-gradient(135deg,#1a3a1a,#2d7a2d)', title:'Pertumbuhan Ekonomi Syariah Indonesia 2026 Lampaui Target Nasional', date:'17 Apr 2026', isHero:true, excerpt:'OJK melaporkan pertumbuhan ekonomi syariah Indonesia pada kuartal pertama 2026 mencapai 8,7%, melampaui target yang ditetapkan sebesar 7,5% dan memimpin di ASEAN.' },
      { url:'https://www.republika.co.id/ekonomi/bsi-ekspansi-global', img:'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=400&q=80', icon:'🌍', cat:'Perbankan', catClass:'cat-ekonomi', title:'Bank Syariah Indonesia Buka Cabang di Dubai dan Kuala Lumpur', date:'2 jam lalu', isSide:true },
      { url:'https://bwi.go.id/berita/wakaf-produktif-milestone', img:'https://images.unsplash.com/photo-1564890369478-c89ca6d9cde9?w=400&q=80', icon:'🏗️', cat:'Wakaf', catClass:'cat-ekonomi', title:'Aset Wakaf Produktif Indonesia Tembus Rp 500 Triliun', date:'5 jam lalu', isSide:true },
      { url:'https://baznas.go.id/berita/zakat-nasional-2026', img:'https://images.unsplash.com/photo-1553729459-efe14ef6055d?w=400&q=80', icon:'💰', cat:'Zakat', catClass:'cat-zakat', title:'Penghimpunan Zakat Nasional 2026 Capai Rp 45 Triliun', date:'8 jam lalu', isSide:true },
      { url:'https://www.ojk.go.id/id/kanal/syariah/berita/fintech-syariah-2026', img:'https://images.unsplash.com/photo-1563986768609-322da13575f3?w=600&q=80', icon:'💻', bg:'linear-gradient(135deg,#e6f0fa,#b5d4f4)', cat:'Fintech', catClass:'cat-ekonomi', title:'Fintech Syariah Jangkau 30 Juta Pengguna, Terbesar di Asia Tenggara', date:'16 Apr 2026' },
      { url:'https://www.republika.co.id/ekonomi/saham-syariah-rekomendasi', img:'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?w=600&q=80', icon:'📊', bg:'linear-gradient(135deg,#eef7ee,#5aad5a)', cat:'Investasi', catClass:'cat-ekonomi', title:'Saham Syariah Pilihan 2026: Analisis Teknikal dan Fundamental', date:'15 Apr 2026' },
      { url:'https://www.ojk.go.id/id/kanal/syariah/berita/asuransi-syariah-2026', img:'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=600&q=80', icon:'🛡️', bg:'linear-gradient(135deg,#fdf3e3,#f5c878)', cat:'Asuransi', catClass:'cat-ekonomi', title:'Takaful: Mengapa Asuransi Syariah Makin Diminati Generasi Muda', date:'14 Apr 2026' },
      { url:'https://www.republika.co.id/ekonomi/obligasi-syariah-sukuk', img:'https://images.unsplash.com/photo-1600880292089-90a7e086ee0c?w=600&q=80', icon:'📜', bg:'linear-gradient(135deg,#d4f0e8,#7dd4bc)', cat:'Sukuk', catClass:'cat-ekonomi', title:'Sukuk Ritel SR020 Tawarkan Imbal Hasil 6,85%, Buka Pendaftaran Hari Ini', date:'13 Apr 2026' },
    ],
  };

  const TAB_TITLES = {
    semua:   'Berita & Artikel Terbaru',
    berita:  'Berita Terkini',
    kajian:  'Kajian & Ilmu Islam',
    ramadhan:'Ramadhan & Syawal',
    mualaf:  'Kisah & Panduan Mualaf',
    ekonomi: 'Ekonomi & Keuangan Syariah',
  };

  function loadImg(imgEl, src) {
    if (!imgEl || !src) return;
    const temp = new Image();
    temp.onload = () => {
      imgEl.src = src;
      imgEl.classList.add('loaded');
      // Sembunyikan emoji icon jika gambar berhasil dimuat
      const icon = imgEl.parentElement.querySelector(
        '.card-thumb-icon, .side-thumb-icon, .hero-img .hero-icon'
      );
      if (icon) icon.style.display = 'none';
    };
    temp.src = src;
  }

  function esc(s) {
    return String(s||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
  }

  let currentTab = 'semua';
  let gridPage = 0;

  function renderHero(tab) {
    const data = ALL_ARTICLES[tab] || ALL_ARTICLES.semua;
    const hero = data.find(a => a.isHero) || data[0];
    const sides = data.filter(a => a.isSide).slice(0, 3);
    const heroEl = document.getElementById('hero-section');
    heroEl.innerHTML = `
      <a class="hero-main" href="${esc(hero.url)}" target="_blank" rel="noopener">
        <div class="hero-img">
          <img id="hero-img-main" src="" alt="${esc(hero.title)}" loading="lazy" />
          <div class="hero-img-overlay"></div>
          <span class="hero-badge">BERITA UTAMA</span>
        </div>
        <div class="hero-content">
          <div class="hero-cat">${esc(hero.cat)}</div>
          <h2 class="hero-title">${esc(hero.title)}</h2>
          <p class="hero-excerpt">${esc(hero.excerpt || '')}</p>
          <div class="hero-meta"><span>Tim Redaksi</span><span>${esc(hero.date)}</span><span>5 menit baca</span></div>
        </div>
      </a>
      <div class="hero-side">
        ${sides.map((a, i) => `
          <a class="side-card" href="${esc(a.url)}" target="_blank" rel="noopener">
            <div class="side-thumb">
              <div class="side-thumb-icon">${a.icon}</div>
              <img id="side-img-${i}" src="" alt="${esc(a.title)}" loading="lazy" />
            </div>
            <div class="side-info">
              <div class="side-title">${esc(a.title)}</div>
              <div class="side-meta">${esc(a.cat)} &nbsp;·&nbsp; ${esc(a.date)}</div>
            </div>
          </a>
        `).join('')}
      </div>
    `;
    loadImg(document.getElementById('hero-img-main'), hero.img);
    sides.forEach((a, i) => loadImg(document.getElementById(`side-img-${i}`), a.img));
  }

  function renderGrid(tab, reset) {
    const data = (ALL_ARTICLES[tab] || ALL_ARTICLES.semua).filter(a => !a.isHero && !a.isSide);
    const grid = document.getElementById('articles-grid');
    if (reset) { grid.innerHTML = ''; }
    const perPage = 6;
    const items = data.slice(0, (gridPage + 1) * perPage);
    items.forEach((a, i) => {
      if (document.getElementById(`art-card-${i}`)) return;
      const card = document.createElement('a');
      card.className = 'article-card';
      card.href = a.url;
      card.target = '_blank';
      card.rel = 'noopener';
      card.id = `art-card-${i}`;
      card.style.animationDelay = (i * 0.05) + 's';
      card.innerHTML = `
        <div class="card-thumb" style="background:${a.bg || 'linear-gradient(135deg,#e8f7f2,#7dd4bc)'}">
          <div class="card-thumb-icon">${a.icon}</div>
          <img id="grid-img-${i}" src="" alt="${esc(a.title)}" loading="lazy" />
          <div class="card-img-overlay"></div>
          <span class="card-cat-badge ${a.catClass}">${esc(a.cat)}</span>
        </div>
        <div class="card-body">
          <div class="card-title">${esc(a.title)}</div>
          <div class="card-meta"><span>${esc(a.date)}</span><span class="card-read">Baca →</span></div>
        </div>
      `;
      grid.appendChild(card);
      loadImg(document.getElementById(`grid-img-${i}`), a.img);
    });
    document.getElementById('load-more-btn').style.display = items.length < data.length ? 'block' : 'none';
  }

  function switchTab(tab) {
    currentTab = tab;
    gridPage = 0;
    document.getElementById('section-title').textContent = TAB_TITLES[tab] || 'Artikel';
    renderHero(tab);
    renderGrid(tab, true);
    document.querySelector('.blog-hero').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  }

  function loadMore() {
    gridPage++;
    renderGrid(currentTab, false);
  }

  document.querySelectorAll('.blog-nav-item').forEach(el => {
    el.addEventListener('click', () => {
      document.querySelectorAll('.blog-nav-item').forEach(n => n.classList.remove('active'));
      el.classList.add('active');
      switchTab(el.dataset.tab);
    });
  });

  renderHero('semua');
  renderGrid('semua', true);
</script>
@endpush