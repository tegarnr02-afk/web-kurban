

@extends('layouts.app')

@section('title', 'Zakat — Berkahin')

@section('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
  :root {
    --z-green:       #0B5E35;
    --z-green-mid:   #1A8A52;
    --z-green-soft:  #34C579;
    --z-green-pale:  #D4F0E2;
    --z-gold:        #C8902E;
    --z-gold-light:  #FDF3DC;
    --z-cream:       #FAFBF8;
    --z-white:       #FFFFFF;
    --z-text:        #1C1C1E;
    --z-muted:       #52606D;
    --z-faint:       #9AA5B1;
    --z-border:      rgba(11,94,53,0.1);
    --z-radius:      14px;
    --z-shadow:      0 2px 20px rgba(11,94,53,0.07);
  }
  .z-page { font-family: 'DM Sans', sans-serif; background: var(--z-cream); color: var(--z-text); }

  /* ── HERO ── */
  .z-hero {
    position: relative; overflow: hidden;
    padding: 5rem 1.5rem 4rem;
    background: linear-gradient(160deg, #EAF7EF 0%, #FDF9F0 60%, #FAFBF8 100%);
    text-align: center;
  }
  .z-hero::before {
    content:''; position:absolute; inset:0;
    background-image: url("data:image/svg+xml,%3Csvg width='52' height='52' viewBox='0 0 52 52' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M26 2L31 10h10l-8 6 3 10-10-7-10 7 3-10-8-6h10z' fill='%230B5E35' fill-opacity='0.03'/%3E%3C/svg%3E");
    pointer-events: none;
  }
  .z-hero-inner { position:relative; max-width:680px; margin:0 auto; }
  .z-arabic {
    font-family:'Amiri',serif; font-size:1.75rem;
    color: var(--z-gold); margin-bottom:.75rem; line-height:1.6;
    animation: zFadeUp .7s .1s both;
  }
  .z-hero h1 {
    font-family:'Amiri',serif; font-size: clamp(2.2rem,5vw,3.6rem);
    font-weight:700; color: var(--z-green); line-height:1.15;
    margin-bottom:1rem; animation: zFadeUp .7s .25s both;
  }
  .z-hero h1 em { color: var(--z-gold); font-style:normal; }
  .z-hero p {
    font-size:1rem; color: var(--z-muted); line-height:1.75;
    max-width:500px; margin:0 auto 2rem;
    animation: zFadeUp .7s .4s both;
  }
  .z-hero-btns {
    display:flex; gap:.75rem; justify-content:center; flex-wrap:wrap;
    animation: zFadeUp .7s .55s both;
  }
  .z-btn {
    display:inline-flex; align-items:center; gap:.45rem;
    padding:.75rem 1.6rem; border-radius:99px;
    font-family:'DM Sans',sans-serif; font-size:.9rem; font-weight:600;
    cursor:pointer; border:none; text-decoration:none; transition: transform .2s, box-shadow .2s;
  }
  .z-btn:hover { transform:translateY(-2px); box-shadow:0 6px 20px rgba(11,94,53,.18); }
  .z-btn-primary { background: var(--z-green); color:#fff; }
  .z-btn-outline  { background:transparent; color: var(--z-green); border:1.5px solid var(--z-green); }
  .z-btn-outline:hover { background: var(--z-green-pale); }
  .z-hero-stats {
    display:flex; justify-content:center; gap:2.5rem; flex-wrap:wrap;
    margin-top:3.5rem; padding-top:2.5rem;
    border-top:1px solid var(--z-border);
    animation: zFadeUp .7s .7s both;
  }
  .z-stat-num { font-family:'Amiri',serif; font-size:1.8rem; font-weight:700; color: var(--z-green); }
  .z-stat-lbl { font-size:.75rem; color: var(--z-faint); margin-top:2px; }

  /* ── SECTION SHELL ── */
  .z-section { padding:5rem 1.5rem; }
  .z-section-alt { background: var(--z-white); }
  .z-container { max-width:1080px; margin:0 auto; }
  .z-section-head { text-align:center; margin-bottom:3rem; }
  .z-tag {
    display:inline-block; font-size:.7rem; font-weight:600;
    letter-spacing:.08em; text-transform:uppercase;
    padding:.3rem .9rem; border-radius:99px;
    background: var(--z-green-pale); color: var(--z-green-mid);
    margin-bottom:.75rem;
  }
  .z-section-head h2 {
    font-family:'Amiri',serif; font-size:clamp(1.6rem,3.5vw,2.4rem);
    color: var(--z-green); margin-bottom:.5rem; line-height:1.25;
  }
  .z-section-head p { font-size:.9rem; color: var(--z-muted); max-width:480px; margin:0 auto; line-height:1.7; }

  /* ── JENIS ZAKAT ── */
  .z-tabs { display:flex; gap:.5rem; flex-wrap:wrap; justify-content:center; margin-bottom:2rem; }
  .z-tab {
    padding:.45rem 1.1rem; border-radius:99px;
    border:1.5px solid var(--z-border); background:transparent;
    font-family:'DM Sans',sans-serif; font-size:.82rem; font-weight:500;
    color: var(--z-muted); cursor:pointer; transition:all .2s;
  }
  .z-tab.active, .z-tab:hover { background: var(--z-green); color:#fff; border-color: var(--z-green); }
  .z-cards-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(260px,1fr)); gap:1rem; }
  .z-card {
    background: var(--z-cream); border:1px solid var(--z-border);
    border-radius: var(--z-radius); padding:1.5rem;
    transition:transform .2s, box-shadow .2s; cursor:default;
  }
  .z-card:hover { transform:translateY(-3px); box-shadow: var(--z-shadow); }
  .z-card.z-hidden { display:none; }
  .z-card-ico {
    width:46px; height:46px; border-radius:12px;
    background: var(--z-green-pale); display:flex;
    align-items:center; justify-content:center;
    font-size:1.3rem; margin-bottom:1rem;
  }
  .z-card h3 { font-size:.95rem; font-weight:600; color: var(--z-green); margin-bottom:.4rem; }
  .z-card p { font-size:.82rem; color: var(--z-muted); line-height:1.65; }
  .z-card-nisab {
    margin-top:.9rem; padding-top:.9rem;
    border-top:1px solid var(--z-border);
    font-size:.76rem; color: var(--z-faint);
  }
  .z-card-nisab strong { color: var(--z-gold); }

  /* ── KALKULATOR ── */
  .z-calc-wrap {
    max-width:760px; margin:0 auto;
    background: var(--z-white); border:1px solid var(--z-border);
    border-radius:20px; overflow:hidden; box-shadow: var(--z-shadow);
  }
  .z-calc-tabs { display:grid; grid-template-columns:repeat(4,1fr); }
  .z-calc-tab {
    padding:1.1rem .5rem; text-align:center; cursor:pointer;
    border:none; background:transparent;
    font-family:'DM Sans',sans-serif; font-size:.78rem; font-weight:500;
    color: var(--z-muted); border-right:1px solid var(--z-border);
    border-bottom:1px solid var(--z-border); transition:all .2s;
  }
  .z-calc-tab:last-child { border-right:none; }
  .z-calc-tab.active { background: var(--z-green-pale); color: var(--z-green); font-weight:600; }
  .z-calc-tab .ico { font-size:1.3rem; display:block; margin-bottom:4px; }
  .z-calc-body { padding:2rem; }
  .z-form { display:grid; gap:1.1rem; }
  .z-lbl { font-size:.8rem; font-weight:600; color: var(--z-text); display:block; margin-bottom:.4rem; }
  .z-input, .z-select {
    width:100%; padding:.8rem 1rem;
    border:1.5px solid var(--z-border); border-radius:10px;
    font-family:'DM Sans',sans-serif; font-size:.9rem;
    color: var(--z-text); background: var(--z-cream);
    outline:none; transition:border-color .2s;
  }
  .z-input:focus, .z-select:focus { border-color: var(--z-green-mid); }
  .z-row { display:grid; grid-template-columns:1fr 1fr; gap:1rem; }
  .z-prefix { position:relative; }
  .z-prefix span {
    position:absolute; left:.9rem; top:50%; transform:translateY(-50%);
    font-size:.82rem; color: var(--z-faint); pointer-events:none;
  }
  .z-prefix .z-input { padding-left:3rem; }
  .z-info-box {
    background: var(--z-gold-light); border-radius:10px;
    padding:.8rem 1rem; font-size:.78rem; color:#7A5510; line-height:1.55;
  }
  .z-info-box strong { font-weight:600; }
  .z-calc-actions { display:flex; gap:.75rem; margin-top:.5rem; }
  .z-btn-calc {
    flex:1; background: var(--z-green); color:#fff;
    border:none; padding:.85rem; border-radius:10px;
    font-family:'DM Sans',sans-serif; font-size:.9rem; font-weight:600;
    cursor:pointer; transition:background .2s;
  }
  .z-btn-calc:hover { background: var(--z-green-mid); }
  .z-btn-reset {
    padding:.85rem 1.4rem; border-radius:10px;
    border:1.5px solid var(--z-border); background:transparent;
    font-family:'DM Sans',sans-serif; font-size:.9rem; font-weight:500;
    color: var(--z-muted); cursor:pointer; transition:background .2s;
  }
  .z-btn-reset:hover { background: var(--z-green-pale); }
  .z-result {
    background: var(--z-green); border-radius:14px;
    padding:1.5rem; margin-top:1.25rem; display:none;
  }
  .z-result.show { display:block; }
  .z-result-lbl { font-size:.75rem; color:rgba(255,255,255,.65); margin-bottom:.4rem; font-weight:500; }
  .z-result-num { font-family:'Amiri',serif; font-size:2rem; color:#fff; font-weight:700; }
  .z-result-num small { font-size:1rem; margin-right:4px; opacity:.75; }
  .z-result-grid { display:grid; grid-template-columns:1fr 1fr; gap:.65rem; margin-top:1rem; }
  .z-result-box { background:rgba(255,255,255,.1); border-radius:10px; padding:.7rem 1rem; }
  .z-result-box-lbl { font-size:.72rem; color:rgba(255,255,255,.55); margin-bottom:2px; }
  .z-result-box-val { font-size:.9rem; color:#fff; font-weight:600; }

  /* ── PANDUAN ── */
  .z-guide-grid { display:grid; grid-template-columns:1fr 1.1fr; gap:2.5rem; align-items:start; }
  .z-steps { display:flex; flex-direction:column; }
  .z-step {
    display:flex; gap:1rem; padding:1.25rem 0;
    border-bottom:1px solid var(--z-border);
    cursor:pointer; transition:background .15s;
    border-radius:8px; padding-left:.5rem;
  }
  .z-step:last-child { border-bottom:none; }
  .z-step-num {
    width:36px; height:36px; min-width:36px; border-radius:50%;
    background: var(--z-green-pale); color: var(--z-green-mid);
    display:flex; align-items:center; justify-content:center;
    font-size:.8rem; font-weight:700; transition:all .2s;
  }
  .z-step.active .z-step-num { background: var(--z-green); color:#fff; }
  .z-step h4 { font-size:.9rem; font-weight:600; color: var(--z-text); margin-bottom:.25rem; }
  .z-step p { font-size:.8rem; color: var(--z-muted); line-height:1.55; }
  .z-guide-panel {
    background: var(--z-cream); border:1px solid var(--z-border);
    border-radius: var(--z-radius); padding:1.75rem;
    position:sticky; top:90px;
  }
  .z-guide-panel h3 { font-family:'Amiri',serif; font-size:1.4rem; color: var(--z-green); margin-bottom:.6rem; }
  .z-guide-panel p { font-size:.85rem; color: var(--z-muted); line-height:1.7; }
  .z-guide-list { list-style:none; padding:0; margin:1rem 0 0; display:flex; flex-direction:column; gap:.55rem; }
  .z-guide-list li { display:flex; gap:.6rem; font-size:.83rem; color: var(--z-muted); align-items:flex-start; }
  .z-guide-list li::before { content:'✓'; color: var(--z-green-soft); font-weight:700; min-width:1rem; margin-top:1px; }

  /* FAQ */
  .z-faq { margin-top:3.5rem; }
  .z-faq-item { border:1px solid var(--z-border); border-radius:12px; margin-bottom:.65rem; overflow:hidden; }
  .z-faq-q {
    width:100%; padding:1.1rem 1.4rem; display:flex; justify-content:space-between; align-items:center;
    background: var(--z-white); border:none; cursor:pointer;
    font-family:'DM Sans',sans-serif; font-size:.88rem; font-weight:600; color: var(--z-text);
    text-align:left; transition:background .2s;
  }
  .z-faq-q:hover { background: var(--z-cream); }
  .z-faq-arrow { font-size:.7rem; color: var(--z-faint); transition:transform .25s; }
  .z-faq-q.open .z-faq-arrow { transform:rotate(180deg); }
  .z-faq-a {
    max-height:0; overflow:hidden; padding:0 1.4rem;
    font-size:.85rem; color: var(--z-muted); line-height:1.75;
    background: var(--z-white); transition:max-height .3s ease, padding .3s;
  }
  .z-faq-a.open { max-height:320px; padding:.1rem 1.4rem 1.2rem; }

  /* ── BAYAR ZAKAT ── */
  .z-bayar-section { background: var(--z-green); }
  .z-bayar-section .z-tag { background:rgba(255,255,255,.15); color:rgba(255,255,255,.9); }
  .z-bayar-section .z-section-head h2 { color:#fff; }
  .z-bayar-section .z-section-head p { color:rgba(255,255,255,.65); }
  .z-bayar-grid { display:grid; grid-template-columns:1fr 1.15fr; gap:2.5rem; align-items:start; }
  .z-method { display:flex; flex-direction:column; gap:.65rem; }
  .z-method-card {
    background:rgba(255,255,255,.08); border:1px solid rgba(255,255,255,.15);
    border-radius:14px; padding:1.1rem 1.4rem;
    display:flex; align-items:center; gap:1rem;
    cursor:pointer; transition:all .2s;
  }
  .z-method-card:hover, .z-method-card.sel { background:rgba(255,255,255,.16); border-color: var(--z-gold); }
  .z-method-ico { font-size:1.5rem; }
  .z-method-name { font-size:.88rem; font-weight:600; color:#fff; margin-bottom:2px; }
  .z-method-sub { font-size:.76rem; color:rgba(255,255,255,.55); }
  .z-laz { margin-top:1.5rem; }
  .z-laz-title { font-size:.72rem; color:rgba(255,255,255,.5); letter-spacing:.06em; font-weight:500; margin-bottom:.75rem; }
  .z-laz-list { display:flex; gap:.5rem; flex-wrap:wrap; }
  .z-laz-badge {
    padding:.35rem .9rem; border-radius:99px; font-size:.78rem;
    border:1px solid rgba(255,255,255,.2); color:#fff; background:rgba(255,255,255,.08);
    cursor:pointer; transition:all .2s;
  }
  .z-laz-badge.sel, .z-laz-badge:hover { background: var(--z-gold); border-color: var(--z-gold); color: var(--z-green); font-weight:600; }
  .z-trust { display:flex; gap:1.25rem; flex-wrap:wrap; margin-top:2rem; }
  .z-trust-item { display:flex; align-items:center; gap:.4rem; font-size:.75rem; color:rgba(255,255,255,.5); }
  .z-trust-dot { width:5px; height:5px; border-radius:50%; background: var(--z-gold); }

  .z-form-card { background:#fff; border-radius:18px; padding:2.25rem; }
  .z-form-card h3 { font-family:'Amiri',serif; font-size:1.4rem; color: var(--z-green); margin-bottom:.25rem; }
  .z-form-card > p { font-size:.82rem; color: var(--z-muted); margin-bottom:1.5rem; }
  .z-presets { display:flex; gap:.4rem; flex-wrap:wrap; margin-top:.5rem; }
  .z-preset {
    padding:.35rem .85rem; border-radius:99px; font-size:.76rem; font-weight:500;
    border:1.5px solid var(--z-border); background:transparent; color: var(--z-muted);
    cursor:pointer; font-family:'DM Sans',sans-serif; transition:all .2s;
  }
  .z-preset:hover { background: var(--z-green-pale); border-color: var(--z-green-soft); color: var(--z-green); }
  .z-summary {
    background: var(--z-cream); border-radius:10px;
    padding:.9rem 1.1rem; margin:.5rem 0; display:none;
  }
  .z-sum-row { display:flex; justify-content:space-between; font-size:.83rem; color: var(--z-muted); padding:.25rem 0; }
  .z-sum-row.tot { font-weight:700; color: var(--z-green); border-top:1px solid var(--z-border); margin-top:.4rem; padding-top:.7rem; }
  .z-btn-pay {
    width:100%; background: var(--z-green); color:#fff;
    border:none; padding:.95rem; border-radius:12px; margin-top:.5rem;
    font-family:'DM Sans',sans-serif; font-size:.95rem; font-weight:700;
    cursor:pointer; transition:background .2s, transform .2s;
  }
  .z-btn-pay:hover { background: var(--z-green-mid); transform:translateY(-2px); }

  /* ── MODAL ── */
  .z-modal-wrap {
    position:fixed; inset:0; z-index:9999; display:none;
    align-items:center; justify-content:center;
    background:rgba(0,0,0,.45); padding:1rem;
  }
  .z-modal-wrap.open { display:flex; }
  .z-modal {
    background:#fff; border-radius:22px; padding:2.75rem 2.25rem;
    text-align:center; max-width:420px; width:100%;
    animation: zScale .3s ease both;
  }
  .z-modal-ico { font-size:3.5rem; margin-bottom:.75rem; }
  .z-modal h3 { font-family:'Amiri',serif; font-size:1.7rem; color: var(--z-green); margin-bottom:.4rem; }
  .z-modal p { font-size:.88rem; color: var(--z-muted); line-height:1.7; margin-bottom:1.25rem; }

  /* ── ANIMATIONS ── */
  @keyframes zFadeUp { from{opacity:0;transform:translateY(18px)} to{opacity:1;transform:translateY(0)} }
  @keyframes zScale  { from{opacity:0;transform:scale(.92)}         to{opacity:1;transform:scale(1)}   }

  /* ── RESPONSIVE ── */
  @media(max-width:768px){
    .z-row           { grid-template-columns:1fr; }
    .z-guide-grid    { grid-template-columns:1fr; }
    .z-bayar-grid    { grid-template-columns:1fr; }
    .z-calc-tabs     { grid-template-columns:repeat(2,1fr); }
    .z-guide-panel   { position:static; }
    .z-hero-stats    { gap:1.5rem; }
  }
</style>
@endsection

@section('content')
<div class="z-page">

  {{-- ════════════════════════════════════════════
       HERO
  ════════════════════════════════════════════ --}}
  <div class="z-hero">
    <div class="z-hero-inner">
      <p class="z-arabic">وَأَقِيمُوا الصَّلَاةَ وَآتُوا الزَّكَاةَ</p>
      <h1>Tunaikan Zakat,<br><em>Sucikan Hartamu</em></h1>
      <p>Hitung dan bayar zakat dengan mudah, cepat, dan tersalur ke mustahiq yang tepat melalui lembaga amil terpercaya.</p>
      <div class="z-hero-btns">
        <a href="#kalkulator" class="z-btn z-btn-primary">🧮 Hitung Zakat</a>
        <a href="#bayar"      class="z-btn z-btn-outline">💚 Bayar Sekarang</a>
      </div>
    </div>
  </div>

  {{-- ════════════════════════════════════════════
       JENIS ZAKAT
  ════════════════════════════════════════════ --}}
  <section class="z-section z-section-alt" id="jenis">
    <div class="z-container">
      <div class="z-section-head">
        <span class="z-tag">Jenis Zakat</span>
        <h2>Zakat yang Wajib Ditunaikan</h2>
        <p>Kenali berbagai jenis zakat beserta syarat, nisab, dan kadar yang harus dikeluarkan.</p>
      </div>
      <div class="z-tabs">
        <button class="z-tab active" onclick="zFilterJenis('semua',this)">Semua</button>
        <button class="z-tab" onclick="zFilterJenis('wajib',this)">Wajib</button>
        <button class="z-tab" onclick="zFilterJenis('maal',this)">Zakat Maal</button>
        <button class="z-tab" onclick="zFilterJenis('fitrah',this)">Zakat Fitrah</button>
      </div>
      <div class="z-cards-grid" id="zJenisGrid">
        <div class="z-card" data-type="fitrah wajib">
          <div class="z-card-ico">🌙</div>
          <h3>Zakat Fitrah</h3>
          <p>Zakat jiwa yang wajib dikeluarkan setiap muslim di bulan Ramadan hingga sebelum shalat Idul Fitri.</p>
          <div class="z-card-nisab">Kadar: <strong>2,5 kg beras</strong> atau senilai harganya per jiwa</div>
        </div>
        <div class="z-card" data-type="maal wajib">
          <div class="z-card-ico">💰</div>
          <h3>Zakat Maal (Harta)</h3>
          <p>Zakat atas harta yang dimiliki selama satu tahun (haul) dan telah mencapai nisab yang ditetapkan.</p>
          <div class="z-card-nisab">Nisab: <strong>85 g emas</strong> — Kadar: 2,5%</div>
        </div>
        <div class="z-card" data-type="maal wajib">
          <div class="z-card-ico">💼</div>
          <h3>Zakat Profesi</h3>
          <p>Zakat atas penghasilan dari pekerjaan atau profesi, dihitung dari pendapatan bersih maupun kotor.</p>
          <div class="z-card-nisab">Nisab: <strong>≈ 520 kg beras</strong> — Kadar: 2,5%</div>
        </div>
        <div class="z-card" data-type="maal">
          <div class="z-card-ico">🏅</div>
          <h3>Zakat Emas & Perak</h3>
          <p>Zakat atas kepemilikan emas dan perak yang telah mencapai haul dan nisab tertentu.</p>
          <div class="z-card-nisab">Emas: <strong>85g</strong> | Perak: <strong>595g</strong> — Kadar: 2,5%</div>
        </div>
        <div class="z-card" data-type="maal">
          <div class="z-card-ico">🏪</div>
          <h3>Zakat Perdagangan</h3>
          <p>Zakat atas harta yang diputar dalam usaha perdagangan barang dan jasa selama setahun.</p>
          <div class="z-card-nisab">Nisab: <strong>85 g emas</strong> — Kadar: 2,5% dari total aset</div>
        </div>
        <div class="z-card" data-type="maal">
          <div class="z-card-ico">🌾</div>
          <h3>Zakat Pertanian</h3>
          <p>Zakat dari hasil panen tanaman yang menjadi makanan pokok atau bernilai ekonomi tinggi.</p>
          <div class="z-card-nisab">Nisab: <strong>653 kg</strong> — Kadar: 5% (irigasi) / 10% (tadah hujan)</div>
        </div>
        <div class="z-card" data-type="maal">
          <div class="z-card-ico">📈</div>
          <h3>Zakat Saham & Investasi</h3>
          <p>Zakat atas kepemilikan saham, reksa dana, dan instrumen investasi lain yang telah mencapai nisab.</p>
          <div class="z-card-nisab">Nisab: <strong>85 g emas</strong> — Kadar: 2,5% nilai pasar</div>
        </div>
        <div class="z-card" data-type="maal">
          <div class="z-card-ico">🏦</div>
          <h3>Zakat Tabungan</h3>
          <p>Zakat atas saldo tabungan, deposito, dan simpanan di bank atau lembaga keuangan.</p>
          <div class="z-card-nisab">Nisab: <strong>85 g emas</strong> — Kadar: 2,5%</div>
        </div>
      </div>
    </div>
  </section>

  {{-- ════════════════════════════════════════════
       KALKULATOR ZAKAT
  ════════════════════════════════════════════ --}}
  <section class="z-section" id="kalkulator">
    <div class="z-container">
      <div class="z-section-head">
        <span class="z-tag">Kalkulator</span>
        <h2>Hitung Zakat dengan Mudah</h2>
        <p>Masukkan data harta Anda dan kalkulator akan menghitung kewajiban zakat secara otomatis.</p>
      </div>
      <div class="z-calc-wrap">
        <div class="z-calc-tabs">
          <button class="z-calc-tab active" onclick="zSwitchCalc('fitrah',this)"><span class="ico">🌙</span>Fitrah</button>
          <button class="z-calc-tab"        onclick="zSwitchCalc('profesi',this)"><span class="ico">💼</span>Profesi</button>
          <button class="z-calc-tab"        onclick="zSwitchCalc('maal',this)"><span class="ico">💰</span>Maal</button>
          <button class="z-calc-tab"        onclick="zSwitchCalc('emas',this)"><span class="ico">🏅</span>Emas/Perak</button>
        </div>
        <div class="z-calc-body">

          {{-- FITRAH --}}
          <div id="zc-fitrah" class="z-form">
            <div>
              <label class="z-lbl">Jumlah jiwa dalam tanggungan</label>
              <input class="z-input" type="number" id="zf-jiwa" placeholder="Contoh: 4" min="1" value="1">
            </div>
            <div>
              <label class="z-lbl">Harga beras per kg (Rp)</label>
              <div class="z-prefix"><span>Rp</span><input class="z-input" type="number" id="zf-harga" value="15000"></div>
            </div>
            <div class="z-info-box">ℹ️ Zakat fitrah = <strong>2,5 kg beras × jumlah jiwa</strong>. Dibayarkan paling lambat sebelum shalat Idul Fitri.</div>
            <div class="z-calc-actions">
              <button class="z-btn-calc" onclick="zHitungFitrah()">Hitung Zakat Fitrah</button>
              <button class="z-btn-reset" onclick="zReset()">Reset</button>
            </div>
            <div class="z-result" id="zr-fitrah">
              <div class="z-result-lbl">Total Zakat Fitrah yang Harus Dibayar</div>
              <div class="z-result-num"><small>Rp</small><span id="zrv-fitrah">0</span></div>
              <div class="z-result-grid">
                <div class="z-result-box"><div class="z-result-box-lbl">Jumlah Jiwa</div><div class="z-result-box-val" id="zrv-jiwa">—</div></div>
                <div class="z-result-box"><div class="z-result-box-lbl">Per Jiwa</div><div class="z-result-box-val" id="zrv-per">—</div></div>
              </div>
            </div>
          </div>

          {{-- PROFESI --}}
          <div id="zc-profesi" class="z-form" style="display:none">
            <div class="z-row">
              <div>
                <label class="z-lbl">Penghasilan kotor per bulan</label>
                <div class="z-prefix"><span>Rp</span><input class="z-input" type="number" id="zp-gaji" placeholder="5000000"></div>
              </div>
              <div>
                <label class="z-lbl">Penghasilan lain per bulan</label>
                <div class="z-prefix"><span>Rp</span><input class="z-input" type="number" id="zp-lain" value="0"></div>
              </div>
            </div>
            <div>
              <label class="z-lbl">Hutang jatuh tempo per bulan</label>
              <div class="z-prefix"><span>Rp</span><input class="z-input" type="number" id="zp-hutang" value="0"></div>
            </div>
            <div>
              <label class="z-lbl">Metode perhitungan</label>
              <select class="z-select" id="zp-metode">
                <option value="kotor">Dari penghasilan kotor (2,5%)</option>
                <option value="bersih">Dari penghasilan bersih setelah kebutuhan pokok</option>
              </select>
            </div>
            <div class="z-info-box">ℹ️ Nisab zakat profesi ≈ <strong>Rp 6.500.000/bulan</strong> (setara 520 kg beras @ Rp 12.500/kg)</div>
            <div class="z-calc-actions">
              <button class="z-btn-calc" onclick="zHitungProfesi()">Hitung Zakat Profesi</button>
              <button class="z-btn-reset" onclick="zReset()">Reset</button>
            </div>
            <div class="z-result" id="zr-profesi">
              <div class="z-result-lbl">Zakat Profesi per Bulan</div>
              <div class="z-result-num"><small>Rp</small><span id="zrv-profesi">0</span></div>
              <div class="z-result-grid">
                <div class="z-result-box"><div class="z-result-box-lbl">Total Penghasilan</div><div class="z-result-box-val" id="zrv-ptotal">—</div></div>
                <div class="z-result-box"><div class="z-result-box-lbl">Status Nisab</div><div class="z-result-box-val" id="zrv-pnisab">—</div></div>
              </div>
            </div>
          </div>

          {{-- MAAL --}}
          <div id="zc-maal" class="z-form" style="display:none">
            <div class="z-row">
              <div>
                <label class="z-lbl">Total tabungan & deposito</label>
                <div class="z-prefix"><span>Rp</span><input class="z-input" type="number" id="zm-tab" value="0"></div>
              </div>
              <div>
                <label class="z-lbl">Piutang yang bisa dicairkan</label>
                <div class="z-prefix"><span>Rp</span><input class="z-input" type="number" id="zm-piu" value="0"></div>
              </div>
            </div>
            <div class="z-row">
              <div>
                <label class="z-lbl">Nilai aset investasi</label>
                <div class="z-prefix"><span>Rp</span><input class="z-input" type="number" id="zm-inv" value="0"></div>
              </div>
              <div>
                <label class="z-lbl">Hutang jatuh tempo</label>
                <div class="z-prefix"><span>Rp</span><input class="z-input" type="number" id="zm-hut" value="0"></div>
              </div>
            </div>
            <div class="z-info-box">ℹ️ Nisab zakat maal = <strong>85 gram emas ≈ Rp 85.000.000</strong> (asumsi Rp 1.000.000/gram)</div>
            <div class="z-calc-actions">
              <button class="z-btn-calc" onclick="zHitungMaal()">Hitung Zakat Maal</button>
              <button class="z-btn-reset" onclick="zReset()">Reset</button>
            </div>
            <div class="z-result" id="zr-maal">
              <div class="z-result-lbl">Zakat Maal per Tahun</div>
              <div class="z-result-num"><small>Rp</small><span id="zrv-maal">0</span></div>
              <div class="z-result-grid">
                <div class="z-result-box"><div class="z-result-box-lbl">Harta Bersih</div><div class="z-result-box-val" id="zrv-mbersih">—</div></div>
                <div class="z-result-box"><div class="z-result-box-lbl">Status Wajib</div><div class="z-result-box-val" id="zrv-mstatus">—</div></div>
              </div>
            </div>
          </div>

          {{-- EMAS --}}
          <div id="zc-emas" class="z-form" style="display:none">
            <div>
              <label class="z-lbl">Jenis logam mulia</label>
              <select class="z-select" id="ze-jenis">
                <option value="emas">Emas (nisab 85 gram)</option>
                <option value="perak">Perak (nisab 595 gram)</option>
              </select>
            </div>
            <div class="z-row">
              <div>
                <label class="z-lbl">Berat yang dimiliki (gram)</label>
                <input class="z-input" type="number" id="ze-berat" placeholder="100">
              </div>
              <div>
                <label class="z-lbl">Harga per gram saat ini</label>
                <div class="z-prefix"><span>Rp</span><input class="z-input" type="number" id="ze-harga" value="1000000"></div>
              </div>
            </div>
            <div class="z-info-box">ℹ️ Kadar zakat emas dan perak adalah <strong>2,5%</strong> dari nilai pasar saat ini</div>
            <div class="z-calc-actions">
              <button class="z-btn-calc" onclick="zHitungEmas()">Hitung Zakat Emas/Perak</button>
              <button class="z-btn-reset" onclick="zReset()">Reset</button>
            </div>
            <div class="z-result" id="zr-emas">
              <div class="z-result-lbl">Zakat Emas / Perak per Tahun</div>
              <div class="z-result-num"><small>Rp</small><span id="zrv-emas">0</span></div>
              <div class="z-result-grid">
                <div class="z-result-box"><div class="z-result-box-lbl">Nilai Total</div><div class="z-result-box-val" id="zrv-enilai">—</div></div>
                <div class="z-result-box"><div class="z-result-box-lbl">Status Nisab</div><div class="z-result-box-val" id="zrv-enisab">—</div></div>
              </div>
            </div>
          </div>

        </div>{{-- end calc-body --}}
      </div>{{-- end calc-wrap --}}
    </div>
  </section>

  {{-- ════════════════════════════════════════════
       PANDUAN ZAKAT
  ════════════════════════════════════════════ --}}
  <section class="z-section z-section-alt" id="panduan">
    <div class="z-container">
      <div class="z-section-head">
        <span class="z-tag">Panduan</span>
        <h2>Cara Menunaikan Zakat</h2>
        <p>Pahami syarat, rukun, dan tata cara menunaikan zakat sesuai tuntunan Islam.</p>
      </div>
      <div class="z-guide-grid">
        <div class="z-steps" id="zGuideSteps">
          <div class="z-step active" onclick="zSelectStep(0)">
            <div class="z-step-num">1</div>
            <div><h4>Pahami Syarat Wajib Zakat</h4><p>Kenali syarat seseorang diwajibkan mengeluarkan zakat</p></div>
          </div>
          <div class="z-step" onclick="zSelectStep(1)">
            <div class="z-step-num">2</div>
            <div><h4>Tentukan Jenis Zakat</h4><p>Pilih jenis zakat sesuai harta yang dimiliki</p></div>
          </div>
          <div class="z-step" onclick="zSelectStep(2)">
            <div class="z-step-num">3</div>
            <div><h4>Hitung Nisab dan Haul</h4><p>Periksa apakah harta sudah mencapai batas minimal</p></div>
          </div>
          <div class="z-step" onclick="zSelectStep(3)">
            <div class="z-step-num">4</div>
            <div><h4>Hitung Kadar Zakat</h4><p>Kalkulasi jumlah yang wajib dikeluarkan</p></div>
          </div>
          <div class="z-step" onclick="zSelectStep(4)">
            <div class="z-step-num">5</div>
            <div><h4>Pilih Mustahiq / Lembaga</h4><p>Tentukan kepada siapa zakat akan disalurkan</p></div>
          </div>
          <div class="z-step" onclick="zSelectStep(5)">
            <div class="z-step-num">6</div>
            <div><h4>Niat & Bayarkan Zakat</h4><p>Tunaikan zakat disertai niat yang benar</p></div>
          </div>
        </div>
        <div class="z-guide-panel">
          <h3 id="zgp-title">Syarat Wajib Zakat</h3>
          <p id="zgp-desc">Seseorang wajib menunaikan zakat apabila telah memenuhi syarat-syarat berikut ini.</p>
          <ul class="z-guide-list" id="zgp-list">
            <li>Muslim (beragama Islam)</li>
            <li>Merdeka (bukan budak/hamba sahaya)</li>
            <li>Baligh dan berakal</li>
            <li>Memiliki harta yang mencapai nisab</li>
            <li>Harta telah mencapai haul (1 tahun) untuk zakat maal</li>
            <li>Harta bersifat berkembang atau berpotensi berkembang</li>
          </ul>
        </div>
      </div>

      {{-- FAQ --}}
      <div class="z-faq">
        <div class="z-section-head" style="margin-bottom:1.75rem">
          <span class="z-tag">FAQ</span>
          <h2>Pertanyaan Umum</h2>
        </div>
        <div class="z-faq-item">
          <button class="z-faq-q" onclick="zToggleFaq(this)">Apa perbedaan zakat fitrah dan zakat maal? <span class="z-faq-arrow">▼</span></button>
          <div class="z-faq-a">Zakat fitrah adalah zakat jiwa yang wajib dikeluarkan setiap muslim menjelang Idul Fitri sebesar 2,5 kg bahan makanan pokok per jiwa. Sementara zakat maal adalah zakat atas harta yang dimiliki selama satu tahun dan telah mencapai nisab, dengan kadar 2,5% dari total harta.</div>
        </div>
        <div class="z-faq-item">
          <button class="z-faq-q" onclick="zToggleFaq(this)">Siapa saja yang berhak menerima zakat (mustahiq)? <span class="z-faq-arrow">▼</span></button>
          <div class="z-faq-a">Terdapat 8 golongan (asnaf) yang berhak menerima zakat: Fakir, Miskin, Amil (pengelola zakat), Mualaf (yang baru masuk Islam), Riqab (memerdekakan budak), Gharimin (terlilit hutang), Fisabilillah (di jalan Allah), dan Ibnus Sabil (musafir yang kehabisan bekal).</div>
        </div>
        <div class="z-faq-item">
          <button class="z-faq-q" onclick="zToggleFaq(this)">Apakah zakat bisa mengurangi pajak penghasilan? <span class="z-faq-arrow">▼</span></button>
          <div class="z-faq-a">Ya. Berdasarkan UU No. 23 Tahun 2011, zakat yang dibayarkan melalui BAZNAS atau LAZ resmi dapat dikurangkan dari Penghasilan Kena Pajak (PKP). Simpan bukti pembayaran zakat untuk keperluan pelaporan SPT tahunan Anda.</div>
        </div>
        <div class="z-faq-item">
          <button class="z-faq-q" onclick="zToggleFaq(this)">Bagaimana cara menghitung nisab zakat emas saat ini? <span class="z-faq-arrow">▼</span></button>
          <div class="z-faq-a">Nisab zakat emas adalah 85 gram emas murni. Kalikan 85 gram dengan harga emas hari ini untuk mendapat nilai nisab dalam rupiah. Jika total harta melampaui nilai tersebut setelah satu tahun (haul), Anda wajib berzakat sebesar 2,5%.</div>
        </div>
        <div class="z-faq-item">
          <button class="z-faq-q" onclick="zToggleFaq(this)">Apakah penghasilan freelance atau wirausaha wajib zakat? <span class="z-faq-arrow">▼</span></button>
          <div class="z-faq-a">Ya. Penghasilan dari freelance, wirausaha, dan profesi apapun termasuk dalam zakat profesi/penghasilan. Jika total penghasilan telah melewati nisab (setara 520 kg beras atau 85 gram emas), maka wajib mengeluarkan zakat sebesar 2,5%.</div>
        </div>
      </div>
    </div>
  </section>

  {{-- ════════════════════════════════════════════
       BAYAR ZAKAT
  ════════════════════════════════════════════ --}}
  <section class="z-section z-bayar-section" id="bayar">
    <div class="z-container">
      <div class="z-section-head">
        <span class="z-tag">Bayar Zakat</span>
        <h2>Tunaikan Zakat Sekarang</h2>
        <p>Bayar zakat dengan mudah, aman, dan tersalur ke mustahiq yang tepat.</p>
      </div>
      <div class="z-bayar-grid">

        {{-- Kiri: metode & LAZ --}}
        <div>
          <div class="z-method">
            <div class="z-method-card sel" onclick="zSelMethod(this)">
              <div class="z-method-ico">💳</div>
              <div><div class="z-method-name">Transfer Bank</div><div class="z-method-sub">BCA, Mandiri, BNI, BRI, BSI</div></div>
            </div>
            <div class="z-method-card" onclick="zSelMethod(this)">
              <div class="z-method-ico">📱</div>
              <div><div class="z-method-name">E-Wallet</div><div class="z-method-sub">GoPay, OVO, Dana, ShopeePay</div></div>
            </div>
            <div class="z-method-card" onclick="zSelMethod(this)">
              <div class="z-method-ico">⬛</div>
              <div><div class="z-method-name">QRIS</div><div class="z-method-sub">Scan dari semua dompet digital</div></div>
            </div>
            <div class="z-method-card" onclick="zSelMethod(this)">
              <div class="z-method-ico">🏧</div>
              <div><div class="z-method-name">Virtual Account</div><div class="z-method-sub">Bayar via ATM atau m-banking</div></div>
            </div>
          </div>
          <div class="z-laz">
            <div class="z-laz-title">SALURKAN KE LEMBAGA</div>
            <div class="z-laz-list">
              <span class="z-laz-badge sel" onclick="zSelLaz(this)">BAZNAS</span>
              <span class="z-laz-badge" onclick="zSelLaz(this)">Rumah Zakat</span>
              <span class="z-laz-badge" onclick="zSelLaz(this)">Dompet Dhuafa</span>
              <span class="z-laz-badge" onclick="zSelLaz(this)">Yatim Mandiri</span>
              <span class="z-laz-badge" onclick="zSelLaz(this)">NU Care-LAZISNU</span>
              <span class="z-laz-badge" onclick="zSelLaz(this)">LAZISMU</span>
            </div>
          </div>
          <div class="z-trust">
            <div class="z-trust-item"><div class="z-trust-dot"></div>Terdaftar Kemenag RI</div>
            <div class="z-trust-item"><div class="z-trust-dot"></div>SSL Terenkripsi</div>
            <div class="z-trust-item"><div class="z-trust-dot"></div>Laporan Transparan</div>
          </div>
        </div>

        {{-- Kanan: form --}}
        <div class="z-form-card">
          <h3>Form Pembayaran Zakat</h3>
          <p>Isi data di bawah untuk memproses pembayaran zakat Anda</p>

          {{-- Gunakan route Laravel untuk form action --}}
          <form id="zBayarForm" onsubmit="zBayar(event)">
            @csrf
            <div class="z-form" style="gap:.9rem">
              <div>
                <label class="z-lbl">Nama Lengkap</label>
                <input class="z-input" type="text" name="nama" id="zb-nama" placeholder="Masukkan nama lengkap" required>
              </div>
              <div>
                <label class="z-lbl">Nomor HP / Email</label>
                <input class="z-input" type="text" name="kontak" id="zb-kontak" placeholder="08xx atau email@gmail.com" required>
              </div>
              <div>
                <label class="z-lbl">Jenis Zakat</label>
                <select class="z-select" name="jenis_zakat" id="zb-jenis" required>
                  <option value="">— Pilih Jenis Zakat —</option>
                  <option value="fitrah">Zakat Fitrah</option>
                  <option value="profesi">Zakat Profesi</option>
                  <option value="maal">Zakat Maal</option>
                  <option value="emas">Zakat Emas/Perak</option>
                  <option value="perdagangan">Zakat Perdagangan</option>
                </select>
              </div>
              <div>
                <label class="z-lbl">Nominal Zakat (Rp)</label>
                <div class="z-prefix"><span>Rp</span>
                  <input class="z-input" type="number" name="nominal" id="zb-nominal" placeholder="0" min="1000" oninput="zUpdateSummary()" required>
                </div>
                <div class="z-presets">
                  <button type="button" class="z-preset" onclick="zSetNominal(50000)">50.000</button>
                  <button type="button" class="z-preset" onclick="zSetNominal(100000)">100.000</button>
                  <button type="button" class="z-preset" onclick="zSetNominal(250000)">250.000</button>
                  <button type="button" class="z-preset" onclick="zSetNominal(500000)">500.000</button>
                  <button type="button" class="z-preset" onclick="zSetNominal(1000000)">1.000.000</button>
                </div>
              </div>
              <div class="z-summary" id="zSummary">
                <div class="z-sum-row"><span>Nominal Zakat</span><span id="zs-nominal">Rp 0</span></div>
                <div class="z-sum-row"><span>Biaya Admin</span><span>Rp 0</span></div>
                <div class="z-sum-row tot"><span>Total Pembayaran</span><span id="zs-total">Rp 0</span></div>
              </div>
              <button type="submit" class="z-btn-pay">💚 Bayar Zakat Sekarang</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </section>

</div>{{-- end z-page --}}

{{-- ════ SUCCESS MODAL ════ --}}
<div class="z-modal-wrap" id="zModal">
  <div class="z-modal">
    <div class="z-modal-ico">✅</div>
    <h3>Zakat Berhasil!</h3>
    <p><em>Jazakallahu Khairan.</em> Pembayaran zakat Anda sebesar <strong id="zm-nominal">Rp 0</strong> telah diterima dan akan segera disalurkan kepada yang berhak.</p>
    <p>Bukti pembayaran telah dikirim ke nomor/email yang Anda daftarkan.</p>
    <button class="z-btn z-btn-primary" style="width:100%;justify-content:center;margin-top:1.25rem" onclick="zCloseModal()">Kembali ke Beranda</button>
  </div>
</div>
@endsection

@push('scripts')       ← jadi ini
<script>
// ─── HELPERS ───────────────────────────────────────────────────
const zFmt = n => Math.round(n).toLocaleString('id-ID');

// ─── JENIS ZAKAT FILTER ────────────────────────────────────────
function zFilterJenis(type, btn) {
  document.querySelectorAll('.z-tab').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  document.querySelectorAll('#zJenisGrid .z-card').forEach(card => {
    card.classList.toggle('z-hidden', type !== 'semua' && !card.dataset.type.includes(type));
  });
}

// ─── KALKULATOR ───────────────────────────────────────────────
function zSwitchCalc(type, btn) {
  document.querySelectorAll('.z-calc-tab').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  ['fitrah','profesi','maal','emas'].forEach(t =>
    document.getElementById('zc-' + t).style.display = t === type ? 'grid' : 'none'
  );
  zReset();
}
function zReset() {
  document.querySelectorAll('.z-result').forEach(r => r.classList.remove('show'));
}
function zHitungFitrah() {
  const jiwa  = +document.getElementById('zf-jiwa').value || 1;
  const harga = +document.getElementById('zf-harga').value || 15000;
  const per   = 2.5 * harga;
  const total = jiwa * per;
  document.getElementById('zrv-fitrah').textContent = zFmt(total);
  document.getElementById('zrv-jiwa').textContent   = jiwa + ' jiwa';
  document.getElementById('zrv-per').textContent    = 'Rp ' + zFmt(per);
  document.getElementById('zr-fitrah').classList.add('show');
}
function zHitungProfesi() {
  const gaji   = +document.getElementById('zp-gaji').value   || 0;
  const lain   = +document.getElementById('zp-lain').value   || 0;
  const hutang = +document.getElementById('zp-hutang').value || 0;
  const metode = document.getElementById('zp-metode').value;
  const nisab  = 6500000;
  const total  = gaji + lain;
  const dasar  = metode === 'kotor' ? total : Math.max(0, total - hutang);
  const zakat  = dasar >= nisab ? dasar * 0.025 : 0;
  document.getElementById('zrv-profesi').textContent = zFmt(zakat);
  document.getElementById('zrv-ptotal').textContent  = 'Rp ' + zFmt(total);
  document.getElementById('zrv-pnisab').textContent  = total >= nisab ? '✓ Wajib Zakat' : '✗ Belum Nisab';
  document.getElementById('zr-profesi').classList.add('show');
}
function zHitungMaal() {
  const tab   = +document.getElementById('zm-tab').value || 0;
  const piu   = +document.getElementById('zm-piu').value || 0;
  const inv   = +document.getElementById('zm-inv').value || 0;
  const hut   = +document.getElementById('zm-hut').value || 0;
  const nisab = 85000000;
  const bersih = tab + piu + inv - hut;
  const zakat  = bersih >= nisab ? bersih * 0.025 : 0;
  document.getElementById('zrv-maal').textContent    = zFmt(Math.max(0, zakat));
  document.getElementById('zrv-mbersih').textContent = 'Rp ' + zFmt(Math.max(0, bersih));
  document.getElementById('zrv-mstatus').textContent = bersih >= nisab ? '✓ Wajib Zakat' : '✗ Belum Nisab';
  document.getElementById('zr-maal').classList.add('show');
}
function zHitungEmas() {
  const jenis     = document.getElementById('ze-jenis').value;
  const berat     = +document.getElementById('ze-berat').value || 0;
  const harga     = +document.getElementById('ze-harga').value || 1000000;
  const nisabGram = jenis === 'emas' ? 85 : 595;
  const nilai     = berat * harga;
  const nisabRp   = nisabGram * harga;
  const zakat     = nilai >= nisabRp ? nilai * 0.025 : 0;
  document.getElementById('zrv-emas').textContent   = zFmt(zakat);
  document.getElementById('zrv-enilai').textContent = 'Rp ' + zFmt(nilai);
  document.getElementById('zrv-enisab').textContent = berat >= nisabGram
    ? '✓ Wajib Zakat' : '✗ Belum Nisab (' + nisabGram + 'g)';
  document.getElementById('zr-emas').classList.add('show');
}

// ─── PANDUAN STEPS ────────────────────────────────────────────
const zStepData = [
  { title:'Syarat Wajib Zakat',   desc:'Seseorang wajib menunaikan zakat apabila memenuhi syarat-syarat berikut.',
    list:['Muslim (beragama Islam)','Merdeka (bukan budak/hamba sahaya)','Baligh dan berakal','Memiliki harta yang mencapai nisab','Harta telah mencapai haul (1 tahun)','Harta bersifat berkembang'] },
  { title:'Tentukan Jenis Zakat', desc:'Pilih jenis zakat yang sesuai dengan harta atau kondisi Anda saat ini.',
    list:['Zakat Fitrah: wajib setiap Ramadan','Zakat Profesi: dari penghasilan kerja','Zakat Maal: dari total harta','Zakat Emas/Perak: dari logam mulia','Zakat Perdagangan: dari usaha bisnis','Zakat Pertanian: dari hasil panen'] },
  { title:'Nisab dan Haul',       desc:'Nisab adalah batas minimal harta, haul adalah batas minimal waktu kepemilikan.',
    list:['Nisab emas: 85 gram emas murni','Nisab perak: 595 gram perak','Nisab profesi: setara 520 kg beras','Haul zakat maal: 1 tahun hijriyah','Zakat fitrah tidak memerlukan haul','Nilai nisab berubah mengikuti harga emas'] },
  { title:'Kadar Zakat',          desc:'Setelah memastikan wajib zakat, hitung jumlah yang harus dikeluarkan.',
    list:['Zakat maal, profesi, emas: 2,5%','Zakat pertanian (irigasi): 5%','Zakat pertanian (tadah hujan): 10%','Zakat fitrah: 2,5 kg beras per jiwa','Zakat rikaz (barang temuan): 20%','Gunakan kalkulator untuk hasil akurat'] },
  { title:'Pilih Mustahiq / Lembaga', desc:'8 golongan (asnaf) yang berhak menerima zakat menurut Al-Quran Surah At-Taubah:60.',
    list:['Fakir: tidak memiliki harta','Miskin: kekurangan harta','Amil: pengelola zakat','Mualaf: baru masuk Islam','Riqab: memerdekakan hamba sahaya','Gharimin: terlilit hutang','Fisabilillah: di jalan Allah','Ibnu Sabil: musafir kehabisan bekal'] },
  { title:'Niat & Bayarkan Zakat', desc:'Tunaikan zakat dengan niat ikhlas karena Allah SWT, disertai lafaz niat.',
    list:['Lafaz niat zakat maal: "Nawaitu an ukhrija zakaata maali fardhon lillahi ta\'ala"','Bayarkan kepada amil atau mustahiq','Minta bukti pembayaran resmi','Simpan bukti untuk keperluan pajak','Catat tanggal bayar untuk referensi haul berikutnya'] }
];
function zSelectStep(idx) {
  document.querySelectorAll('.z-step').forEach((el,i) => el.classList.toggle('active', i === idx));
  const d = zStepData[idx];
  document.getElementById('zgp-title').textContent = d.title;
  document.getElementById('zgp-desc').textContent  = d.desc;
  document.getElementById('zgp-list').innerHTML    = d.list.map(l => `<li>${l}</li>`).join('');
}

// ─── FAQ ──────────────────────────────────────────────────────
function zToggleFaq(btn) {
  const ans    = btn.nextElementSibling;
  const isOpen = ans.classList.contains('open');
  document.querySelectorAll('.z-faq-a').forEach(a => a.classList.remove('open'));
  document.querySelectorAll('.z-faq-q').forEach(q => q.classList.remove('open'));
  if (!isOpen) { ans.classList.add('open'); btn.classList.add('open'); }
}

// ─── BAYAR ────────────────────────────────────────────────────
function zSelMethod(el) {
  document.querySelectorAll('.z-method-card').forEach(c => c.classList.remove('sel'));
  el.classList.add('sel');
}
function zSelLaz(el) {
  document.querySelectorAll('.z-laz-badge').forEach(b => b.classList.remove('sel'));
  el.classList.add('sel');
}
function zSetNominal(val) {
  document.getElementById('zb-nominal').value = val;
  zUpdateSummary();
}
function zUpdateSummary() {
  const n = +document.getElementById('zb-nominal').value || 0;
  const s = document.getElementById('zSummary');
  s.style.display = n > 0 ? 'block' : 'none';
  document.getElementById('zs-nominal').textContent = 'Rp ' + zFmt(n);
  document.getElementById('zs-total').textContent   = 'Rp ' + zFmt(n);
}
function zBayar(e) {
  e.preventDefault();
  const nominal = +document.getElementById('zb-nominal').value || 0;

  const form = document.getElementById('zBayarForm');
  const data = new FormData(form);

  fetch('{{ route("zakat.store") }}', {
    method: 'POST',
    body: data,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(r => r.json())
  .then(res => {
    if (res.success) {
      document.getElementById('zm-nominal').textContent = 'Rp ' + zFmt(nominal);
      document.getElementById('zModal').classList.add('open');
    } else {
      alert(res.message || 'Terjadi kesalahan. Silakan coba lagi.');
    }
  })
  .catch(err => {
    console.error(err);
    alert('Gagal menghubungi server.');
  });
}
function zCloseModal() {
  document.getElementById('zModal').classList.remove('open');
  document.getElementById('zBayarForm').reset();
  document.getElementById('zSummary').style.display = 'none';
}

// ─── SMOOTH SCROLL ────────────────────────────────────────────
document.querySelectorAll('a[href^="#"]').forEach(a =>
  a.addEventListener('click', e => {
    e.preventDefault();
    const t = document.querySelector(a.getAttribute('href'));
    if (t) t.scrollIntoView({ behavior:'smooth', block:'start' });
  })
);
</script>
@endpush            