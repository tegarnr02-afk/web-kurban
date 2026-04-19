{{-- resources/views/donasi/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Semua Campaign — Berkahin')

@section('styles')
<style>
/* ══════════════════════════════════════
   PAGE HERO
══════════════════════════════════════ */
.page-hero {
  position: relative;
  min-height: 420px;
  padding: 80px 24px 64px;
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}

/* Foto background */
.page-hero-bg {
  position: absolute; inset: 0;
  width: 100%; height: 100%;
  object-fit: cover; object-position: center;
  z-index: 0;
}

/* Overlay gelap gradient */
.page-hero-overlay {
  position: absolute; inset: 0; z-index: 1;
  background: linear-gradient(
    135deg,
    rgba(8, 30, 18, 0.88) 0%,
    rgba(15, 70, 42, 0.75) 55%,
    rgba(10, 40, 25, 0.85) 100%
  );
}

/* Noise texture halus */
.page-hero-overlay::after {
  content: '';
  position: absolute; inset: 0;
  background: repeating-linear-gradient(
    45deg,
    rgba(255,255,255,0.012) 0,
    rgba(255,255,255,0.012) 1px,
    transparent 1px, transparent 22px
  );
}

/* Semua konten di atas overlay */
.page-hero > *:not(.page-hero-bg):not(.page-hero-overlay) {
  position: relative; z-index: 2;
}

.hero-eyebrow {
  display: inline-flex; align-items: center; gap: 7px;
  background: rgba(255,255,255,0.1);
  border: 1px solid rgba(255,255,255,0.18);
  border-radius: 20px; padding: 5px 14px;
  font-size: 11px; font-weight: 500; letter-spacing: .6px;
  color: rgba(255,255,255,0.78); text-transform: uppercase;
  margin-bottom: 16px;
}
.hero-eyebrow-dot {
  width: 6px; height: 6px; border-radius: 50%;
  background: #4ade80; display: inline-block;
}
.hero-title {
  font-family: var(--font-serif);
  font-size: clamp(26px, 4vw, 42px);
  font-weight: 700; color: #fff; line-height: 1.25;
  margin-bottom: 16px;
}
.hero-title em { font-style: italic; color: #b3e5cc; }
.hero-desc {
  font-size: 15px; color: rgba(255,255,255,.72);
  line-height: 1.8; max-width: 480px; margin: 0 auto 36px;
}
.hero-stats {
  display: flex; justify-content: center;
  align-items: center; gap: 0; flex-wrap: wrap;
}
.hstat { text-align: center; padding: 0 32px; }
.hstat + .hstat { border-left: 1px solid rgba(255,255,255,.15); }
.hstat-num { font-size: 26px; font-weight: 700; color: #b3e5cc; }
.hstat-lbl { font-size: 11px; color: rgba(255,255,255,.5); margin-top: 4px; letter-spacing: .3px; }

@media (max-width: 640px) {
  .hstat { padding: 12px 20px; }
  .hstat + .hstat { border-left: none; border-top: 1px solid rgba(255,255,255,.1); }
  .hero-stats { flex-direction: column; }
}
/* ══════════════════════════════════════
   MAIN WRAP
══════════════════════════════════════ */
.donasi-page-wrap {
  max-width: 1160px; margin: 0 auto;
  padding: 0 24px 80px;
}

/* ══════════════════════════════════════
   FILTER BAR
══════════════════════════════════════ */
.filter-bar {
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  padding: 16px 20px;
  margin: 28px 0 16px;
  display: flex; align-items: center; gap: 14px; flex-wrap: wrap;
}
.search-wrap {
  display: flex; align-items: center; gap: 8px;
  flex: 1; min-width: 200px;
  background: var(--bg2); border: 1px solid var(--border);
  border-radius: var(--radius-xs); padding: 9px 14px;
}
.search-wrap svg { flex-shrink: 0; color: var(--text-hint); }
.search-wrap input {
  border: none; background: transparent;
  font-size: 13px; color: var(--text);
  outline: none; flex: 1;
  font-family: var(--font-display);
}
.search-wrap input::placeholder { color: var(--text-hint); }

.cat-tabs { display: flex; gap: 8px; flex-wrap: wrap; }
.cat-tab {
  padding: 8px 16px; border-radius: 20px; font-size: 12px;
  font-weight: 500; border: 1px solid var(--border);
  background: transparent; color: var(--text-muted);
  cursor: pointer; transition: all .18s;
  font-family: var(--font-display);
}
.cat-tab:hover { border-color: var(--primary-pale2); color: var(--primary); }
.cat-tab.active { background: var(--primary); color: white; border-color: var(--primary); }

.sort-select {
  margin-left: auto;
  border: 1px solid var(--border); border-radius: var(--radius-xs);
  background: var(--bg2); color: var(--text);
  font-size: 13px; padding: 8px 12px;
  outline: none; cursor: pointer;
  font-family: var(--font-display);
}

/* ══════════════════════════════════════
   RESULTS INFO
══════════════════════════════════════ */
.results-info {
  font-size: 12px; color: var(--text-muted);
  margin-bottom: 20px;
}
.results-info strong { color: var(--text); }

/* ══════════════════════════════════════
   DONASI GRID
══════════════════════════════════════ */
.donasi-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 24px;
}
.donasi-card {
  background: var(--surface); border-radius: var(--radius);
  border: 1px solid var(--border); overflow: hidden;
  transition: all .25s; text-decoration: none;
  color: inherit; display: block;
}
.donasi-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 40px rgba(0,0,0,.1);
  border-color: var(--primary-pale2);
}
.donasi-thumb {
  width: 100%; height: 180px;
  position: relative; overflow: hidden;
}
.donasi-thumb-bg {
  width: 100%; height: 100%;
  display: flex; align-items: center; justify-content: center;
  font-size: 64px; transition: transform .4s;
}
.donasi-card:hover .donasi-thumb-bg { transform: scale(1.08); }
.donasi-thumb-cat {
  position: absolute; top: 12px; left: 12px;
  background: white; color: var(--primary);
  font-size: 11px; font-weight: 600;
  padding: 4px 10px; border-radius: 20px;
  border: 1px solid var(--primary-pale2);
}
.badge-tag {
  position: absolute; top: 12px; right: 12px;
  color: white; font-size: 10px;
  font-weight: 600; padding: 3px 9px; border-radius: 20px;
}
.donasi-body { padding: 18px; }
.donasi-org {
  font-size: 11px; color: var(--text-hint);
  margin-bottom: 6px; display: flex; align-items: center; gap: 5px;
}
.donasi-org-dot {
  width: 14px; height: 14px; border-radius: 50%;
  background: var(--primary-pale2); flex-shrink: 0;
}
.donasi-title {
  font-size: 15px; font-weight: 600;
  line-height: 1.45; margin-bottom: 14px; color: var(--text);
  display: -webkit-box; -webkit-line-clamp: 2;
  -webkit-box-orient: vertical; overflow: hidden;
}
.donasi-bar-wrap {
  background: var(--bg2); border-radius: 10px;
  height: 6px; margin-bottom: 10px; overflow: hidden;
}
.donasi-bar { height: 100%; border-radius: 10px; }
.donasi-meta {
  display: flex; align-items: center; justify-content: space-between;
  font-size: 12px; color: var(--text-muted); margin-bottom: 14px;
}
.donasi-meta-collected { font-weight: 600; font-size: 13px; }
.donasi-footer {
  display: flex; align-items: center; justify-content: space-between;
  padding-top: 14px; border-top: 1px solid var(--border);
}
.donasi-price { font-size: 13px; color: var(--text-muted); }
.donasi-price strong { font-size: 15px; color: var(--text); font-weight: 600; }
.donasi-days { font-size: 11px; color: var(--text-hint); margin-top: 3px; }
.donasi-days.urgent { color: #dc2626; font-weight: 500; }
.donasi-btn {
  padding: 8px 16px; border-radius: var(--radius-xs);
  background: var(--primary-pale); color: var(--primary);
  font-size: 13px; font-weight: 600;
  border: none; cursor: pointer;
  font-family: var(--font-display); transition: all .18s;
}
.donasi-btn:hover { background: var(--primary); color: white; }

/* ══════════════════════════════════════
   EMPTY STATE
══════════════════════════════════════ */
.empty-state {
  grid-column: 1 / -1;
  text-align: center; padding: 80px 20px;
  color: var(--text-muted);
}
.empty-state-icon { font-size: 48px; margin-bottom: 16px; }
.empty-state h3 { font-size: 17px; margin-bottom: 8px; color: var(--text); }
.empty-state p { font-size: 14px; }

/* ══════════════════════════════════════
   CTA BOTTOM
══════════════════════════════════════ */
.bottom-cta {
  text-align: center; padding: 56px 24px;
  background: var(--bg2); border-top: 1px solid var(--border);
}
.bottom-cta p { font-size: 14px; color: var(--text-muted); margin-bottom: 20px; }
.btn-primary {
  padding: 13px 28px; border-radius: var(--radius-xs);
  background: var(--primary); color: white;
  border: none; font-size: 15px; font-weight: 600;
  cursor: pointer; font-family: var(--font-display);
  text-decoration: none; display: inline-flex;
  align-items: center; gap: 8px; transition: all .2s;
}
.btn-primary:hover { opacity: .9; transform: translateY(-2px); }

@media (max-width: 640px) {
  .filter-bar { flex-direction: column; align-items: stretch; }
  .sort-select { margin-left: 0; }
  .hero-stats { gap: 24px; }
}
</style>
@endsection

@section('content')

{{-- ══ HERO ══ --}}
<div class="page-hero">

  <img class="page-hero-bg"
       src="https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?w=1400&q=80&fit=crop&auto=format"
       alt="" aria-hidden="true">

  <div class="page-hero-overlay"></div>

  <div class="hero-eyebrow">
    <span class="hero-eyebrow-dot"></span>
    Program Donasi
  </div>
  <h1 class="hero-title">Semua Campaign <em>Kebaikan</em></h1>
  <p class="hero-desc">Pilih program yang sesuai dengan niat Anda. Setiap donasi tercatat transparan dan tersalurkan tepat sasaran.</p>


</div>
{{-- ══ MAIN ══ --}}
<div class="donasi-page-wrap">

  {{-- FILTER BAR --}}
  <div class="filter-bar">
    <div class="search-wrap">
      <svg width="14" height="14" viewBox="0 0 16 16" fill="none">
        <circle cx="7" cy="7" r="5" stroke="currentColor" stroke-width="1.5"/>
        <path d="M11 11l3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
      </svg>
      <input type="text" id="searchInput" placeholder="Cari campaign, kategori, atau lembaga...">
    </div>

    <div class="cat-tabs" id="catTabs">
      <button class="cat-tab active" data-cat="">Semua</button>
      <button class="cat-tab" data-cat="qurban">Qurban</button>
      <button class="cat-tab" data-cat="zakat">Zakat</button>
      <button class="cat-tab" data-cat="darurat">Darurat</button>
      <button class="cat-tab" data-cat="pendidikan">Pendidikan</button>
      <button class="cat-tab" data-cat="kesehatan">Kesehatan</button>
      <button class="cat-tab" data-cat="sosial">Sosial</button>
    </div>

    <select class="sort-select" id="sortSelect">
      <option value="terbaru">Terbaru</option>
      <option value="terpopuler">Terpopuler</option>
      <option value="mendesak">Mendesak</option>
      <option value="hampir-selesai">Hampir Selesai</option>
    </select>
  </div>

  <div class="results-info">Menampilkan <strong id="countResult">12</strong> campaign</div>

  {{-- ══════════════════════════════════════
       CAMPAIGN GRID — Data hardcode
       Untuk pasang ke database nanti:
       - Ganti blok ini dengan @foreach($campaigns as $item)
       - Ganti setiap nilai statis dengan {{ $item->kolom }}
  ══════════════════════════════════════ --}}
  <div class="donasi-grid" id="campaignGrid">

    {{-- 1. Qurban --}}
    <a href="{{ url('/donasi/semua-bisa-berqurban') }}" class="donasi-card"
       data-cat="qurban" data-title="semua bisa berqurban promo terbatas 1446 h" data-org="laznas bmh"
       data-popular="187500000" data-pct="62" data-urgent="0">
      <div class="donasi-thumb">
        <div class="donasi-thumb-bg" style="background:linear-gradient(135deg,#0d3d26,#1a6b4a)">🐑</div>
        <span class="donasi-thumb-cat">Qurban</span>
        <span class="badge-tag" style="background:#f59e0b">Promo</span>
      </div>
      <div class="donasi-body">
        <div class="donasi-org"><div class="donasi-org-dot"></div>Laznas BMH</div>
        <div class="donasi-title">Semua Bisa Berqurban — Promo Terbatas 1446 H</div>
        <div class="donasi-bar-wrap"><div class="donasi-bar" style="width:62%;background:#1a6b4a"></div></div>
        <div class="donasi-meta">
          <span class="donasi-meta-collected" style="color:#1a6b4a">Rp 187.500.000</span>
          <span>62% dari Rp 300.000.000</span>
        </div>
        <div class="donasi-footer">
          <div>
            <div class="donasi-price">Mulai <strong>Rp 1.399.000</strong></div>
            <div class="donasi-days">14 hari lagi</div>
          </div>
          <button class="donasi-btn" onclick="event.preventDefault()">Donasi</button>
        </div>
      </div>
    </a>

    {{-- 2. Darurat Palestina --}}
    <a href="{{ url('/donasi/bantuan-palestina-gaza') }}" class="donasi-card"
       data-cat="darurat" data-title="bantuan darurat pengungsi palestina gaza" data-org="yayasan kemanusiaan"
       data-popular="624000000" data-pct="78" data-urgent="1">
      <div class="donasi-thumb">
        <div class="donasi-thumb-bg" style="background:linear-gradient(135deg,#7c1a1a,#c0392b)">🕊</div>
        <span class="donasi-thumb-cat">Darurat</span>
        <span class="badge-tag" style="background:#dc2626">Mendesak</span>
      </div>
      <div class="donasi-body">
        <div class="donasi-org"><div class="donasi-org-dot"></div>Yayasan Kemanusiaan</div>
        <div class="donasi-title">Bantuan Darurat Pengungsi Palestina Gaza</div>
        <div class="donasi-bar-wrap"><div class="donasi-bar" style="width:78%;background:#dc2626"></div></div>
        <div class="donasi-meta">
          <span class="donasi-meta-collected" style="color:#dc2626">Rp 624.000.000</span>
          <span>78% dari Rp 800.000.000</span>
        </div>
        <div class="donasi-footer">
          <div>
            <div class="donasi-price">Mulai <strong>Rp 10.000</strong></div>
            <div class="donasi-days">Tidak berakhir</div>
          </div>
          <button class="donasi-btn" onclick="event.preventDefault()">Donasi</button>
        </div>
      </div>
    </a>

    {{-- 3. Beasiswa --}}
    <a href="{{ url('/donasi/beasiswa-100-siswa') }}" class="donasi-card"
       data-cat="pendidikan" data-title="beasiswa penuh untuk 100 siswa berprestasi" data-org="yayasan cendekia"
       data-popular="225000000" data-pct="45" data-urgent="0">
      <div class="donasi-thumb">
        <div class="donasi-thumb-bg" style="background:linear-gradient(135deg,#1a3a6b,#2d6a9f)">📚</div>
        <span class="donasi-thumb-cat">Pendidikan</span>
        <span class="badge-tag" style="background:#0d3d26">Baru</span>
      </div>
      <div class="donasi-body">
        <div class="donasi-org"><div class="donasi-org-dot"></div>Yayasan Cendekia</div>
        <div class="donasi-title">Beasiswa Penuh untuk 100 Siswa Berprestasi</div>
        <div class="donasi-bar-wrap"><div class="donasi-bar" style="width:45%;background:#2563eb"></div></div>
        <div class="donasi-meta">
          <span class="donasi-meta-collected" style="color:#2563eb">Rp 225.000.000</span>
          <span>45% dari Rp 500.000.000</span>
        </div>
        <div class="donasi-footer">
          <div>
            <div class="donasi-price">Mulai <strong>Rp 50.000</strong></div>
            <div class="donasi-days">30 hari lagi</div>
          </div>
          <button class="donasi-btn" onclick="event.preventDefault()">Donasi</button>
        </div>
      </div>
    </a>

    {{-- 4. Kesehatan Katarak --}}
    <a href="{{ url('/donasi/operasi-katarak-gratis') }}" class="donasi-card"
       data-cat="kesehatan" data-title="operasi katarak gratis untuk kaum dhuafa" data-org="rsi al-ihsan"
       data-popular="98000000" data-pct="65" data-urgent="1">
      <div class="donasi-thumb">
        <div class="donasi-thumb-bg" style="background:linear-gradient(135deg,#1a4a3a,#2a8060)">👁</div>
        <span class="donasi-thumb-cat">Kesehatan</span>
        <span class="badge-tag" style="background:#dc2626">Mendesak</span>
      </div>
      <div class="donasi-body">
        <div class="donasi-org"><div class="donasi-org-dot"></div>RSI Al-Ihsan</div>
        <div class="donasi-title">Operasi Katarak Gratis untuk Kaum Dhuafa</div>
        <div class="donasi-bar-wrap"><div class="donasi-bar" style="width:65%;background:#0891b2"></div></div>
        <div class="donasi-meta">
          <span class="donasi-meta-collected" style="color:#0891b2">Rp 98.000.000</span>
          <span>65% dari Rp 150.000.000</span>
        </div>
        <div class="donasi-footer">
          <div>
            <div class="donasi-price">Mulai <strong>Rp 25.000</strong></div>
            <div class="donasi-days urgent">⏰ 5 hari lagi</div>
          </div>
          <button class="donasi-btn" onclick="event.preventDefault()">Donasi</button>
        </div>
      </div>
    </a>

    {{-- 5. Sosial Rumah --}}
    <a href="{{ url('/donasi/rumah-layak-huni') }}" class="donasi-card"
       data-cat="sosial" data-title="rumah layak huni untuk keluarga prasejahtera" data-org="habitat indonesia"
       data-popular="340000000" data-pct="57" data-urgent="0">
      <div class="donasi-thumb">
        <div class="donasi-thumb-bg" style="background:linear-gradient(135deg,#3d2a0a,#8b5e1a)">🏠</div>
        <span class="donasi-thumb-cat">Sosial</span>
      </div>
      <div class="donasi-body">
        <div class="donasi-org"><div class="donasi-org-dot"></div>Habitat Indonesia</div>
        <div class="donasi-title">Rumah Layak Huni untuk Keluarga Prasejahtera</div>
        <div class="donasi-bar-wrap"><div class="donasi-bar" style="width:57%;background:#d97706"></div></div>
        <div class="donasi-meta">
          <span class="donasi-meta-collected" style="color:#d97706">Rp 340.000.000</span>
          <span>57% dari Rp 600.000.000</span>
        </div>
        <div class="donasi-footer">
          <div>
            <div class="donasi-price">Mulai <strong>Rp 100.000</strong></div>
            <div class="donasi-days">45 hari lagi</div>
          </div>
          <button class="donasi-btn" onclick="event.preventDefault()">Donasi</button>
        </div>
      </div>
    </a>

    {{-- 6. Darurat Gempa --}}
    <a href="{{ url('/donasi/gempa-cianjur-recovery') }}" class="donasi-card"
       data-cat="darurat" data-title="gempa cianjur bantuan korban pemulihan" data-org="pmi pusat"
       data-popular="512000000" data-pct="73" data-urgent="1">
      <div class="donasi-thumb">
        <div class="donasi-thumb-bg" style="background:linear-gradient(135deg,#5a1a1a,#b03030)">🆘</div>
        <span class="donasi-thumb-cat">Darurat</span>
        <span class="badge-tag" style="background:#dc2626">Mendesak</span>
      </div>
      <div class="donasi-body">
        <div class="donasi-org"><div class="donasi-org-dot"></div>PMI Pusat</div>
        <div class="donasi-title">Gempa Cianjur — Bantuan Korban & Pemulihan</div>
        <div class="donasi-bar-wrap"><div class="donasi-bar" style="width:73%;background:#dc2626"></div></div>
        <div class="donasi-meta">
          <span class="donasi-meta-collected" style="color:#dc2626">Rp 512.000.000</span>
          <span>73% dari Rp 700.000.000</span>
        </div>
        <div class="donasi-footer">
          <div>
            <div class="donasi-price">Mulai <strong>Rp 10.000</strong></div>
            <div class="donasi-days urgent">⏰ 7 hari lagi</div>
          </div>
          <button class="donasi-btn" onclick="event.preventDefault()">Donasi</button>
        </div>
      </div>
    </a>

    {{-- 7. Pendidikan Pesantren --}}
    <a href="{{ url('/donasi/pesantren-tahfidz-yatim') }}" class="donasi-card"
       data-cat="pendidikan" data-title="pesantren tahfidz untuk anak yatim" data-org="yayasan nur hidayah"
       data-popular="145000000" data-pct="36" data-urgent="0">
      <div class="donasi-thumb">
        <div class="donasi-thumb-bg" style="background:linear-gradient(135deg,#2a1a4a,#5a3a8a)">📖</div>
        <span class="donasi-thumb-cat">Pendidikan</span>
        <span class="badge-tag" style="background:#0d3d26">Baru</span>
      </div>
      <div class="donasi-body">
        <div class="donasi-org"><div class="donasi-org-dot"></div>Yayasan Nur Hidayah</div>
        <div class="donasi-title">Pesantren Tahfidz untuk Anak Yatim</div>
        <div class="donasi-bar-wrap"><div class="donasi-bar" style="width:36%;background:#7c3aed"></div></div>
        <div class="donasi-meta">
          <span class="donasi-meta-collected" style="color:#7c3aed">Rp 145.000.000</span>
          <span>36% dari Rp 400.000.000</span>
        </div>
        <div class="donasi-footer">
          <div>
            <div class="donasi-price">Mulai <strong>Rp 50.000</strong></div>
            <div class="donasi-days">60 hari lagi</div>
          </div>
          <button class="donasi-btn" onclick="event.preventDefault()">Donasi</button>
        </div>
      </div>
    </a>

    {{-- 8. Kesehatan Sunatan --}}
    <a href="{{ url('/donasi/sunatan-massal') }}" class="donasi-card"
       data-cat="kesehatan" data-title="sunatan massal 1000 anak kurang mampu" data-org="laznas bmh"
       data-popular="67000000" data-pct="67" data-urgent="0">
      <div class="donasi-thumb">
        <div class="donasi-thumb-bg" style="background:linear-gradient(135deg,#0a3a2a,#1a7050)">🏥</div>
        <span class="donasi-thumb-cat">Kesehatan</span>
      </div>
      <div class="donasi-body">
        <div class="donasi-org"><div class="donasi-org-dot"></div>Laznas BMH</div>
        <div class="donasi-title">Sunatan Massal 1.000 Anak Kurang Mampu</div>
        <div class="donasi-bar-wrap"><div class="donasi-bar" style="width:67%;background:#0891b2"></div></div>
        <div class="donasi-meta">
          <span class="donasi-meta-collected" style="color:#0891b2">Rp 67.000.000</span>
          <span>67% dari Rp 100.000.000</span>
        </div>
        <div class="donasi-footer">
          <div>
            <div class="donasi-price">Mulai <strong>Rp 30.000</strong></div>
            <div class="donasi-days">10 hari lagi</div>
          </div>
          <button class="donasi-btn" onclick="event.preventDefault()">Donasi</button>
        </div>
      </div>
    </a>

    {{-- 9. Sosial Air Bersih --}}
    <a href="{{ url('/donasi/air-bersih-ntt') }}" class="donasi-card"
       data-cat="sosial" data-title="air bersih untuk desa terpencil ntt" data-org="act indonesia"
       data-popular="289000000" data-pct="64" data-urgent="0">
      <div class="donasi-thumb">
        <div class="donasi-thumb-bg" style="background:linear-gradient(135deg,#0a2a4a,#1a5a8a)">💧</div>
        <span class="donasi-thumb-cat">Sosial</span>
      </div>
      <div class="donasi-body">
        <div class="donasi-org"><div class="donasi-org-dot"></div>ACT Indonesia</div>
        <div class="donasi-title">Air Bersih untuk Desa Terpencil NTT</div>
        <div class="donasi-bar-wrap"><div class="donasi-bar" style="width:64%;background:#0ea5e9"></div></div>
        <div class="donasi-meta">
          <span class="donasi-meta-collected" style="color:#0ea5e9">Rp 289.000.000</span>
          <span>64% dari Rp 450.000.000</span>
        </div>
        <div class="donasi-footer">
          <div>
            <div class="donasi-price">Mulai <strong>Rp 50.000</strong></div>
            <div class="donasi-days">35 hari lagi</div>
          </div>
          <button class="donasi-btn" onclick="event.preventDefault()">Donasi</button>
        </div>
      </div>
    </a>

    {{-- 10. Qurban Pelosok --}}
    <a href="{{ url('/donasi/qurban-pelosok-3t') }}" class="donasi-card"
       data-cat="qurban" data-title="qurban pelosok kirim ke daerah 3t" data-org="dompet dhuafa"
       data-popular="420000000" data-pct="60" data-urgent="0">
      <div class="donasi-thumb">
        <div class="donasi-thumb-bg" style="background:linear-gradient(135deg,#2a1a0a,#6a3a0a)">🐄</div>
        <span class="donasi-thumb-cat">Qurban</span>
      </div>
      <div class="donasi-body">
        <div class="donasi-org"><div class="donasi-org-dot"></div>Dompet Dhuafa</div>
        <div class="donasi-title">Qurban Pelosok — Kirim ke Daerah 3T</div>
        <div class="donasi-bar-wrap"><div class="donasi-bar" style="width:60%;background:#1a6b4a"></div></div>
        <div class="donasi-meta">
          <span class="donasi-meta-collected" style="color:#1a6b4a">Rp 420.000.000</span>
          <span>60% dari Rp 700.000.000</span>
        </div>
        <div class="donasi-footer">
          <div>
            <div class="donasi-price">Mulai <strong>Rp 2.850.000</strong></div>
            <div class="donasi-days">14 hari lagi</div>
          </div>
          <button class="donasi-btn" onclick="event.preventDefault()">Donasi</button>
        </div>
      </div>
    </a>

    {{-- 11. Darurat Banjir --}}
    <a href="{{ url('/donasi/banjir-sumatra') }}" class="donasi-card"
       data-cat="darurat" data-title="banjir bandang sumatra bantu korban" data-org="bnpb x berkahin"
       data-popular="178000000" data-pct="59" data-urgent="1">
      <div class="donasi-thumb">
        <div class="donasi-thumb-bg" style="background:linear-gradient(135deg,#1a2a4a,#2a4a7a)">🌊</div>
        <span class="donasi-thumb-cat">Darurat</span>
        <span class="badge-tag" style="background:#dc2626">Mendesak</span>
      </div>
      <div class="donasi-body">
        <div class="donasi-org"><div class="donasi-org-dot"></div>BNPB x Berkahin</div>
        <div class="donasi-title">Banjir Bandang Sumatra — Bantu Korban</div>
        <div class="donasi-bar-wrap"><div class="donasi-bar" style="width:59%;background:#dc2626"></div></div>
        <div class="donasi-meta">
          <span class="donasi-meta-collected" style="color:#dc2626">Rp 178.000.000</span>
          <span>59% dari Rp 300.000.000</span>
        </div>
        <div class="donasi-footer">
          <div>
            <div class="donasi-price">Mulai <strong>Rp 10.000</strong></div>
            <div class="donasi-days urgent">⏰ 3 hari lagi</div>
          </div>
          <button class="donasi-btn" onclick="event.preventDefault()">Donasi</button>
        </div>
      </div>
    </a>

    {{-- 12. Sosial Dapur Umum --}}
    <a href="{{ url('/donasi/dapur-umum-ramadhan') }}" class="donasi-card"
       data-cat="sosial" data-title="dapur umum ramadhan 10000 buka puasa" data-org="komunitas berbagi"
       data-popular="92000000" data-pct="77" data-urgent="0">
      <div class="donasi-thumb">
        <div class="donasi-thumb-bg" style="background:linear-gradient(135deg,#2a3a1a,#4a6a2a)">🍱</div>
        <span class="donasi-thumb-cat">Sosial</span>
        <span class="badge-tag" style="background:#7c3aed">Hampir Selesai</span>
      </div>
      <div class="donasi-body">
        <div class="donasi-org"><div class="donasi-org-dot"></div>Komunitas Berbagi</div>
        <div class="donasi-title">Dapur Umum Ramadhan — 10.000 Buka Puasa</div>
        <div class="donasi-bar-wrap"><div class="donasi-bar" style="width:77%;background:#4b8b3b"></div></div>
        <div class="donasi-meta">
          <span class="donasi-meta-collected" style="color:#4b8b3b">Rp 92.000.000</span>
          <span>77% dari Rp 120.000.000</span>
        </div>
        <div class="donasi-footer">
          <div>
            <div class="donasi-price">Mulai <strong>Rp 25.000</strong></div>
            <div class="donasi-days urgent">⏰ 2 hari lagi</div>
          </div>
          <button class="donasi-btn" onclick="event.preventDefault()">Donasi</button>
        </div>
      </div>
    </a>

  </div>{{-- end .donasi-grid --}}

</div>{{-- end .donasi-page-wrap --}}

{{-- CTA BAWAH --}}
<div class="bottom-cta">
  <p>Ingin membuka campaign donasi untuk program Anda?</p>
  <a href="{{ url('/daftar-lembaga') }}" class="btn-primary">
    Daftarkan Lembaga Anda
    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
      <path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
  </a>
</div>

@endsection

@push('scripts')
<script>
(function () {
  const cards    = Array.from(document.querySelectorAll('.donasi-card'));
  const searchInp = document.getElementById('searchInput');
  const catTabs   = document.querySelectorAll('.cat-tab');
  const sortSel   = document.getElementById('sortSelect');
  const countEl   = document.getElementById('countResult');
  const grid      = document.getElementById('campaignGrid');

  let activeCat  = '';
  let activeSort = 'terbaru';

  // Simpan urutan asli supaya sort "Terbaru" bisa reset
  const originalOrder = [...cards];

  function applyFilters() {
    const q = searchInp.value.toLowerCase().trim();

    let visible = cards.filter(c => {
      const catMatch  = !activeCat || c.dataset.cat === activeCat;
      const textMatch = !q || c.dataset.title.includes(q) || c.dataset.org.includes(q);
      return catMatch && textMatch;
    });

    // Sort
    if (activeSort === 'terpopuler') {
      visible.sort((a, b) => +b.dataset.popular - +a.dataset.popular);
    } else if (activeSort === 'mendesak') {
      visible.sort((a, b) => +b.dataset.urgent - +a.dataset.urgent);
    } else if (activeSort === 'hampir-selesai') {
      visible.sort((a, b) => +b.dataset.pct - +a.dataset.pct);
    } else {
      // Terbaru: kembalikan ke urutan DOM asli
      visible.sort((a, b) => originalOrder.indexOf(a) - originalOrder.indexOf(b));
    }

    // Sembunyikan semua, lalu re-append yang visible (sesuai urutan sort)
    cards.forEach(c => c.style.display = 'none');
    visible.forEach(c => { c.style.display = 'block'; grid.appendChild(c); });

    // Hapus empty state lama bila ada
    grid.querySelectorAll('.empty-state').forEach(e => e.remove());

    // Tampilkan empty state jika tidak ada hasil
    if (!visible.length) {
      grid.insertAdjacentHTML('beforeend', `
        <div class="empty-state">
          <div class="empty-state-icon">🔍</div>
          <h3>Campaign tidak ditemukan</h3>
          <p>Coba kata kunci atau kategori lain.</p>
        </div>`);
    }

    countEl.textContent = visible.length;
  }

  searchInp.addEventListener('input', applyFilters);

  catTabs.forEach(btn => {
    btn.addEventListener('click', () => {
      catTabs.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      activeCat = btn.dataset.cat;
      applyFilters();
    });
  });

  sortSel.addEventListener('change', () => {
    activeSort = sortSel.value;
    applyFilters();
  });
})();
</script>
@endpush