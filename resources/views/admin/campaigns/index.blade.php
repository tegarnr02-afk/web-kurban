@extends('admin.layouts.app')

@section('title', 'Semua Campaign')

@push('styles')
<style>
/* ── CONTENT ── */
.content { padding: 18px 22px; flex: 1; }

/* ── STAT STRIP ── */
.stat-strip { display: grid; grid-template-columns: repeat(5, 1fr); gap: 10px; margin-bottom: 18px; }
.stat-box { background: #fff; border: 1px solid var(--border); border-radius: 10px; padding: 12px 14px; display: flex; align-items: center; gap: 10px; }
.stat-box-icon { width: 34px; height: 34px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.stat-box-icon svg { width: 16px; height: 16px; }
.stat-box-num { font-size: 18px; font-weight: 700; color: var(--txt); line-height: 1; }
.stat-box-label { font-size: 10px; color: var(--txt3); margin-top: 2px; }

/* ── TOOLBAR ── */
.toolbar { background: #fff; border: 1px solid var(--border); border-radius: 10px; padding: 12px 14px; margin-bottom: 14px; display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
.search-wrap { position: relative; flex: 1; min-width: 180px; }
.search-icon { position: absolute; left: 10px; top: 50%; transform: translateY(-50%); pointer-events: none; }
.search-icon svg { width: 13px; height: 13px; color: var(--txt3); }
.search-input { width: 100%; border: 1px solid var(--border); border-radius: 8px; padding: 8px 10px 8px 32px; font-size: 12px; color: var(--txt); outline: none; font-family: inherit; background: var(--bg); }
.search-input:focus { border-color: var(--g5); background: #fff; }
.filter-select { border: 1px solid var(--border); border-radius: 8px; padding: 7px 28px 7px 10px; font-size: 12px; color: var(--txt2); outline: none; font-family: inherit; background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6' fill='none'%3E%3Cpath d='M1 1l4 4 4-4' stroke='%237A9588' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E") no-repeat right 8px center; appearance: none; cursor: pointer; }
.filter-select:focus { border-color: var(--g5); }
.toolbar-sep { width: 1px; height: 28px; background: var(--border); }
.view-btn { width: 32px; height: 32px; border: 1px solid var(--border); border-radius: 7px; background: #fff; cursor: pointer; display: flex; align-items: center; justify-content: center; }
.view-btn.active { background: var(--g0); border-color: var(--g1); }
.view-btn svg { width: 14px; height: 14px; color: var(--txt3); }
.view-btn.active svg { color: var(--g6); }

/* ── BULK BAR ── */
.bulk-bar { display: none; background: var(--g0); border: 1px solid var(--g1); border-radius: 9px; padding: 9px 14px; margin-bottom: 12px; align-items: center; gap: 12px; }
.bulk-bar.show { display: flex; }
.bulk-info { font-size: 12px; font-weight: 600; color: var(--g6); }
.bulk-actions { display: flex; gap: 6px; margin-left: auto; }
.bulk-btn { font-size: 11px; font-weight: 600; padding: 5px 12px; border-radius: 7px; border: none; cursor: pointer; font-family: inherit; }
.bulk-btn.act { background: var(--g5); color: #fff; }
.bulk-btn.del { background: var(--red0); color: var(--red6); }
.bulk-btn.cancel { background: #fff; color: var(--txt3); border: 1px solid var(--border); }

/* ── TAB BAR ── */
.tab-bar { display: flex; gap: 0; background: #fff; border-radius: 10px 10px 0 0; border: 1px solid var(--border); border-bottom: none; padding: 0 14px; }
.tab { padding: 10px 14px; font-size: 12px; font-weight: 500; color: var(--txt3); cursor: pointer; border-bottom: 2px solid transparent; margin-bottom: -1px; display: flex; align-items: center; gap: 6px; transition: .15s; text-decoration: none; }
.tab:hover { color: var(--txt); }
.tab.active { color: var(--g6); border-bottom-color: var(--g5); font-weight: 600; }
.tab-count { font-size: 10px; font-weight: 700; padding: 1px 7px; border-radius: 20px; background: var(--bg); color: var(--txt3); }
.tab.active .tab-count { background: var(--g0); color: var(--g6); }

/* ── TABLE ── */
.table-wrap { background: #fff; border: 1px solid var(--border); border-top: none; border-radius: 0 0 10px 10px; overflow: hidden; }
table { width: 100%; border-collapse: collapse; table-layout: fixed; }
col.c-check    { width: 38px; }
col.c-campaign { width: auto; }
col.c-kategori { width: 90px; }
col.c-progres  { width: 120px; }
col.c-target   { width: 100px; }
col.c-donatur  { width: 70px; }
col.c-status   { width: 80px; }
col.c-tanggal  { width: 90px; }
col.c-aksi     { width: 100px; }
thead tr { background: #FAFCFA; }
th { padding: 9px 12px; text-align: left; font-size: 10px; font-weight: 700; color: var(--txt3); text-transform: uppercase; letter-spacing: .06em; border-bottom: 1px solid var(--border); white-space: nowrap; }
td { padding: 11px 12px; font-size: 12px; color: var(--txt2); border-bottom: 1px solid var(--border); vertical-align: middle; }
tr:last-child td { border-bottom: none; }
tr.selected td { background: #F6FBFA; }
tr:hover td { background: #FAFCFA; }
.camp-thumb { width: 42px; height: 30px; border-radius: 5px; object-fit: cover; display: block; border: 1px solid var(--border); flex-shrink: 0; }
.camp-thumb-placeholder { width: 42px; height: 30px; border-radius: 5px; background: var(--bg); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.camp-info { display: flex; align-items: center; gap: 9px; }
.camp-name { font-weight: 600; color: var(--txt); font-size: 12px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 220px; }
.camp-org  { font-size: 10px; color: var(--txt3); margin-top: 1px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 220px; }

/* ── BADGES ── */
.badge { display: inline-flex; align-items: center; padding: 2px 8px; border-radius: 20px; font-size: 10px; font-weight: 700; white-space: nowrap; }
.badge.qurban      { background: var(--g0); color: var(--g6); }
.badge.darurat     { background: var(--red0); color: var(--red6, #A32D2D); }
.badge.pendidikan  { background: var(--blue0); color: var(--blue); }
.badge.kesehatan   { background: #F0EDF8; color: #6B3FA0; }
.badge.zakat       { background: var(--amber0); color: var(--amber); }
.badge.masjid      { background: #F5F0E8; color: #8B5E3C; }
.badge.aktif       { background: var(--g0); color: var(--g6); }
.badge.draft       { background: #F1EFE8; color: #5F5E5A; }
.badge.selesai     { background: var(--blue0); color: var(--blue); }
.badge.ditangguhkan { background: var(--red0); color: var(--red6, #A32D2D); }
.badge.jadwal      { background: var(--amber0); color: var(--amber); }

/* ── PROGRESS ── */
.progress-wrap { min-width: 80px; }
.pct { font-size: 10px; color: var(--txt3); margin-bottom: 3px; }
.prog-bar  { height: 4px; border-radius: 2px; background: var(--bg); overflow: hidden; }
.prog-fill { height: 100%; border-radius: 2px; }
.prog-fill.green { background: var(--g5); }
.prog-fill.red   { background: var(--red); }
.prog-fill.amber { background: var(--amber); }
.prog-fill.blue  { background: var(--blue); }
.chk { width: 15px; height: 15px; border: 1.5px solid var(--border); border-radius: 4px; cursor: pointer; accent-color: var(--g5); }

/* ── ACTION BUTTONS ── */
.action-group { display: flex; gap: 4px; align-items: center; }
.action-btn { width: 28px; height: 28px; border-radius: 6px; border: 1px solid var(--border); background: #fff; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: .15s; }
.action-btn:hover { background: var(--g0); border-color: var(--g1); }
.action-btn.del:hover { background: var(--red0); border-color: #F09595; }
.action-btn svg { width: 13px; height: 13px; color: var(--txt3); }
.action-btn:hover svg { color: var(--g6); }
.action-btn.del:hover svg { color: var(--red); }
.more-btn { width: 28px; height: 28px; border-radius: 6px; border: 1px solid var(--border); background: #fff; cursor: pointer; display: flex; align-items: center; justify-content: center; position: relative; }
.more-btn svg { width: 13px; height: 13px; color: var(--txt3); }
.dropdown { display: none; position: absolute; right: 0; top: 32px; background: #fff; border: 1px solid var(--border); border-radius: 8px; box-shadow: 0 4px 16px rgba(0,0,0,.1); z-index: 50; min-width: 160px; overflow: hidden; }
.dropdown.open { display: block; }
.dd-item { padding: 8px 13px; font-size: 12px; color: var(--txt2); cursor: pointer; display: flex; align-items: center; gap: 8px; transition: .1s; }
.dd-item:hover { background: var(--bg); }
.dd-item.danger { color: var(--red); }
.dd-item.danger:hover { background: var(--red0); }
.dd-item svg { width: 13px; height: 13px; flex-shrink: 0; }
.dd-sep { border: none; border-top: 1px solid var(--border); margin: 3px 0; }

/* ── PAGINATION ── */
.pagination-wrap { display: flex; align-items: center; justify-content: space-between; padding: 12px 14px; border-top: 1px solid var(--border); background: #fff; border-radius: 0 0 10px 10px; }
.page-info { font-size: 11px; color: var(--txt3); }
.page-btns { display: flex; gap: 4px; }
.page-btn { min-width: 30px; height: 30px; padding: 0 6px; border-radius: 7px; border: 1px solid var(--border); background: #fff; cursor: pointer; font-size: 12px; font-weight: 500; color: var(--txt2); display: inline-flex; align-items: center; justify-content: center; transition: .15s; font-family: inherit; text-decoration: none; }
.page-btn:hover { background: var(--bg); }
.page-btn.active { background: var(--g6); color: #fff; border-color: var(--g6); }
.page-btn[disabled] { opacity: .4; pointer-events: none; }

/* ── EMPTY STATE ── */
.empty-state { padding: 48px 24px; text-align: center; }
.empty-icon { width: 52px; height: 52px; border-radius: 14px; background: var(--g0); display: flex; align-items: center; justify-content: center; margin: 0 auto 14px; }
.empty-icon svg { width: 24px; height: 24px; }
.empty-title { font-size: 14px; font-weight: 700; color: var(--txt); margin-bottom: 6px; }
.empty-sub { font-size: 12px; color: var(--txt3); margin-bottom: 16px; }

/* ── GRID VIEW ── */
.grid-container { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; background: #fff; border: 1px solid var(--border); border-radius: 0 0 10px 10px; padding: 16px; }
.grid-card { border: 1px solid var(--border); border-radius: 10px; overflow: hidden; cursor: pointer; transition: .15s; }
.grid-card:hover { box-shadow: 0 2px 12px rgba(0,0,0,.08); }
.grid-thumb { height: 90px; background: var(--bg); display: flex; align-items: center; justify-content: center; overflow: hidden; }
.grid-thumb img { width: 100%; height: 100%; object-fit: cover; }
.grid-body { padding: 10px 11px; }
.grid-name { font-size: 11px; font-weight: 700; color: var(--txt); line-height: 1.4; margin-bottom: 3px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
.grid-org { font-size: 10px; color: var(--txt3); margin-bottom: 8px; }

/* ── DETAIL PANEL ── */
.detail-panel { position: fixed; right: -360px; top: 0; bottom: 0; width: 340px; background: #fff; border-left: 1px solid var(--border); z-index: 150; transition: .25s; overflow-y: auto; display: flex; flex-direction: column; }
.detail-panel.open { right: 0; }
.dp-head { padding: 16px 18px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; background: #fff; }
.dp-title { font-size: 13px; font-weight: 700; color: var(--txt); }
.dp-close { width: 28px; height: 28px; border-radius: 7px; border: 1px solid var(--border); background: #fff; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 16px; color: var(--txt3); }
.dp-close:hover { background: var(--bg); }
.dp-body { padding: 16px 18px; flex: 1; }
.dp-thumb { width: 100%; height: 130px; border-radius: 9px; background: var(--bg); overflow: hidden; margin-bottom: 14px; display: flex; align-items: center; justify-content: center; }
.dp-thumb img { width: 100%; height: 100%; object-fit: cover; }
.dp-name { font-size: 14px; font-weight: 700; color: var(--txt); margin-bottom: 4px; line-height: 1.4; }
.dp-org { font-size: 11px; color: var(--txt3); margin-bottom: 12px; }
.dp-prog-bar { height: 6px; border-radius: 3px; background: var(--bg); overflow: hidden; margin: 6px 0 4px; }
.dp-prog-fill { height: 100%; border-radius: 3px; background: var(--g5); }
.dp-row { display: flex; justify-content: space-between; align-items: center; padding: 8px 0; border-bottom: 1px solid var(--border); }
.dp-row:last-child { border-bottom: none; }
.dp-label { font-size: 11px; color: var(--txt3); }
.dp-val { font-size: 11px; font-weight: 600; color: var(--txt); }
.dp-actions { display: flex; gap: 8px; padding: 14px 18px; border-top: 1px solid var(--border); }
.dp-btn { flex: 1; padding: 8px; border-radius: 8px; font-size: 12px; font-weight: 600; cursor: pointer; font-family: inherit; border: none; transition: .15s; }
.dp-btn.edit { background: var(--g0); color: var(--g6); }
.dp-btn.edit:hover { background: var(--g1); }
.dp-btn.del { background: var(--red0); color: #A32D2D; }
.dp-btn.del:hover { background: #F7C1C1; }

/* ── MODAL ── */
.modal-bg { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.4); z-index: 200; align-items: center; justify-content: center; }
.modal-bg.open { display: flex; }
.modal { background: #fff; border-radius: 14px; width: 400px; padding: 24px; text-align: center; }
.modal-icon { width: 48px; height: 48px; border-radius: 12px; background: var(--red0); display: flex; align-items: center; justify-content: center; margin: 0 auto 14px; }
.modal-icon svg { width: 22px; height: 22px; }
.modal-title { font-size: 15px; font-weight: 700; color: var(--txt); margin-bottom: 6px; }
.modal-sub { font-size: 12px; color: var(--txt3); line-height: 1.6; margin-bottom: 20px; }
.modal-actions { display: flex; gap: 8px; justify-content: center; }
.modal-cancel { flex: 1; padding: 9px; border: 1px solid var(--border); border-radius: 8px; background: #fff; font-size: 12px; font-weight: 600; color: var(--txt2); cursor: pointer; font-family: inherit; }
.modal-cancel:hover { background: var(--bg); }
.modal-delete { flex: 1; padding: 9px; border: none; border-radius: 8px; background: var(--red); color: #fff; font-size: 12px; font-weight: 600; cursor: pointer; font-family: inherit; }
.modal-delete:hover { background: #A32D2D; }

/* ── TOAST ── */
#toast { display: none; position: fixed; bottom: 22px; right: 22px; z-index: 999; padding: 11px 16px; border-radius: 9px; font-size: 12px; font-weight: 600; box-shadow: 0 4px 18px rgba(0,0,0,.15); }
#toast.success { background: var(--g7); color: #fff; }
#toast.warn { background: #fff; color: var(--amber); border: 1px solid var(--amber0); }
</style>
@endpush

{{-- ═══════════ BREADCRUMB ═══════════ --}}
@section('breadcrumb')
<a href="{{ route('admin.dashboard') }}" style="color:var(--txt3);text-decoration:none">Campaign</a>
  <span class="sep">›</span>
  <span class="cur">Semua Campaign</span>
@endsection

{{-- ═══════════ TOPBAR ACTIONS ═══════════ --}}
@section('topbar-actions')
  <a href="{{ route('admin.campaigns.index', array_merge(request()->query(), ['export' => 'csv'])) }}" class="btn-ghost">
    <svg width="13" height="13" viewBox="0 0 13 13" fill="none"><path d="M6.5 1.5v10M1.5 6.5h10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
    Export CSV
  </a>
  <a href="{{ route('admin.campaigns.create') }}" class="btn-primary">
    <svg width="11" height="11" viewBox="0 0 11 11" fill="none"><path d="M5.5 1v9M1 5.5h9" stroke="#fff" stroke-width="1.6" stroke-linecap="round"/></svg>
    Tambah Campaign
  </a>
@endsection

{{-- ═══════════════════════════════════ CONTENT ═══════════════════════════════════ --}}
@section('content')
<div class="content">

  {{-- ── STAT STRIP ── --}}
  <div class="stat-strip">
    <div class="stat-box">
      <div class="stat-box-icon" style="background:var(--g0)">
        <svg viewBox="0 0 16 16" fill="none"><path d="M2 4h12M4 7h8M6 10h4" stroke="#0F6E56" stroke-width="1.3" stroke-linecap="round"/></svg>
      </div>
      <div><div class="stat-box-num">{{ $stats['total'] }}</div><div class="stat-box-label">Total Campaign</div></div>
    </div>
    <div class="stat-box">
      <div class="stat-box-icon" style="background:var(--g0)">
        <svg viewBox="0 0 16 16" fill="none"><circle cx="8" cy="8" r="5.5" stroke="#0F6E56" stroke-width="1.3"/><path d="M5.5 8.5l2 2 3-3" stroke="#0F6E56" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </div>
      <div><div class="stat-box-num" style="color:var(--g6)">{{ $stats['aktif'] }}</div><div class="stat-box-label">Aktif</div></div>
    </div>
    <div class="stat-box">
      <div class="stat-box-icon" style="background:#F1EFE8">
        <svg viewBox="0 0 16 16" fill="none"><path d="M8 4v4l2.5 2" stroke="#5F5E5A" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/><circle cx="8" cy="8" r="5.5" stroke="#5F5E5A" stroke-width="1.3"/></svg>
      </div>
      <div><div class="stat-box-num" style="color:#5F5E5A">{{ $stats['draft'] }}</div><div class="stat-box-label">Draft</div></div>
    </div>
    <div class="stat-box">
      <div class="stat-box-icon" style="background:var(--blue0)">
        <svg viewBox="0 0 16 16" fill="none"><path d="M3 8h10M8 3v10" stroke="#185FA5" stroke-width="1.3" stroke-linecap="round"/></svg>
      </div>
      <div><div class="stat-box-num" style="color:var(--blue)">{{ $stats['selesai'] }}</div><div class="stat-box-label">Selesai</div></div>
    </div>
    <div class="stat-box">
      <div class="stat-box-icon" style="background:var(--red0)">
        <svg viewBox="0 0 16 16" fill="none"><circle cx="8" cy="8" r="5.5" stroke="#A32D2D" stroke-width="1.3"/><path d="M8 5v4M8 11v.5" stroke="#A32D2D" stroke-width="1.4" stroke-linecap="round"/></svg>
      </div>
      <div><div class="stat-box-num" style="color:var(--red)">{{ $stats['ditangguhkan'] }}</div><div class="stat-box-label">Ditangguhkan</div></div>
    </div>
  </div>

  {{-- ── TOOLBAR ── --}}
  <form method="GET" action="{{ route('admin.campaigns.index') }}" id="filter-form">
  <div class="toolbar">
    <div class="search-wrap">
      <div class="search-icon"><svg viewBox="0 0 13 13" fill="none"><circle cx="5.5" cy="5.5" r="3.5" stroke="currentColor" stroke-width="1.2"/><path d="M8.5 8.5l2.5 2.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg></div>
      <input class="search-input" name="q" value="{{ request('q') }}" placeholder="Cari judul campaign atau lembaga..." oninput="submitFilter()"/>
    </div>
    <select class="filter-select" name="kategori" onchange="submitFilter()">
      <option value="">Semua Kategori</option>
      <option value="qurban"     {{ request('kategori') == 'qurban'     ? 'selected' : '' }}>Qurban</option>
      <option value="darurat"    {{ request('kategori') == 'darurat'    ? 'selected' : '' }}>Darurat</option>
      <option value="pendidikan" {{ request('kategori') == 'pendidikan' ? 'selected' : '' }}>Pendidikan</option>
      <option value="kesehatan"  {{ request('kategori') == 'kesehatan'  ? 'selected' : '' }}>Kesehatan</option>
      <option value="zakat"      {{ request('kategori') == 'zakat'      ? 'selected' : '' }}>Zakat & Infaq</option>
      <option value="masjid"     {{ request('kategori') == 'masjid'     ? 'selected' : '' }}>Masjid</option>
    </select>
    <select class="filter-select" name="lembaga_id" onchange="submitFilter()">
      <option value="">Semua Lembaga</option>
      @foreach($lembagas as $lb)
        <option value="{{ $lb->id }}" {{ request('lembaga_id') == $lb->id ? 'selected' : '' }}>{{ $lb->nama ?? $lb->name }}</option>
      @endforeach
    </select>
    <select class="filter-select" name="sort" onchange="submitFilter()">
      <option value="newest" {{ request('sort','newest') == 'newest' ? 'selected' : '' }}>Terbaru</option>
      <option value="target" {{ request('sort') == 'target' ? 'selected' : '' }}>Target Tertinggi</option>
    </select>
    <input type="hidden" name="status" id="status-hidden" value="{{ request('status') }}"/>
    <div class="toolbar-sep"></div>
    <button type="button" class="view-btn {{ session('view','table') == 'table' ? 'active' : '' }}" id="view-table-btn" onclick="setView('table')" title="Tampilan tabel">
      <svg viewBox="0 0 14 14" fill="none"><path d="M2 4h10M2 7h10M2 10h10" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/></svg>
    </button>
    <button type="button" class="view-btn {{ session('view') == 'grid' ? 'active' : '' }}" id="view-grid-btn" onclick="setView('grid')" title="Tampilan grid">
      <svg viewBox="0 0 14 14" fill="none"><rect x="1" y="1" width="5" height="5" rx="1" stroke="currentColor" stroke-width="1.2"/><rect x="8" y="1" width="5" height="5" rx="1" stroke="currentColor" stroke-width="1.2"/><rect x="1" y="8" width="5" height="5" rx="1" stroke="currentColor" stroke-width="1.2"/><rect x="8" y="8" width="5" height="5" rx="1" stroke="currentColor" stroke-width="1.2"/></svg>
    </button>
  </div>
  </form>

  {{-- ── BULK BAR ── --}}
  <div class="bulk-bar" id="bulk-bar">
    <div class="bulk-info" id="bulk-info">0 campaign dipilih</div>
    <div class="bulk-actions">
      <button class="bulk-btn act" onclick="bulkStatus('aktif')">Aktifkan</button>
      <button class="bulk-btn act" style="background:var(--amber)" onclick="bulkStatus('draft')">Jadikan Draft</button>
      <button class="bulk-btn del" onclick="openModal(null)">Hapus</button>
      <button class="bulk-btn cancel" onclick="clearSelection()">Batal</button>
    </div>
  </div>

  {{-- ── TAB BAR ── --}}
  <div class="tab-bar">
    <a href="{{ route('admin.campaigns.index', array_merge(request()->except('status','page'), [])) }}"
       class="tab {{ !request('status') ? 'active' : '' }}">
      Semua <span class="tab-count">{{ $stats['total'] }}</span>
    </a>
    <a href="{{ route('admin.campaigns.index', array_merge(request()->except('status','page'), ['status'=>'aktif'])) }}"
       class="tab {{ request('status') == 'aktif' ? 'active' : '' }}">
      Aktif <span class="tab-count">{{ $stats['aktif'] }}</span>
    </a>
    <a href="{{ route('admin.campaigns.index', array_merge(request()->except('status','page'), ['status'=>'draft'])) }}"
       class="tab {{ request('status') == 'draft' ? 'active' : '' }}">
      Draft <span class="tab-count">{{ $stats['draft'] }}</span>
    </a>
    <a href="{{ route('admin.campaigns.index', array_merge(request()->except('status','page'), ['status'=>'selesai'])) }}"
       class="tab {{ request('status') == 'selesai' ? 'active' : '' }}">
      Selesai <span class="tab-count">{{ $stats['selesai'] }}</span>
    </a>
    <a href="{{ route('admin.campaigns.index', array_merge(request()->except('status','page'), ['status'=>'ditangguhkan'])) }}"
       class="tab {{ request('status') == 'ditangguhkan' ? 'active' : '' }}">
      Ditangguhkan <span class="tab-count">{{ $stats['ditangguhkan'] }}</span>
    </a>
  </div>

  {{-- ── TABLE VIEW ── --}}
  <div id="table-view">
    <div class="table-wrap">
      @if($campaigns->isEmpty())
        <div class="empty-state">
          <div class="empty-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M3 12h18M3 6h18M3 18h10" stroke="#0F6E56" stroke-width="1.5" stroke-linecap="round"/></svg></div>
          <div class="empty-title">Tidak ada campaign ditemukan</div>
          <div class="empty-sub">Coba ubah kata kunci atau filter pencarian</div>
          <a href="{{ route('admin.campaigns.index') }}" class="btn-primary" style="margin:0 auto">Reset Filter</a>
        </div>
      @else
        <table>
          <colgroup>
            <col class="c-check"><col class="c-campaign"><col class="c-kategori">
            <col class="c-progres"><col class="c-target"><col class="c-donatur">
            <col class="c-status"><col class="c-tanggal"><col class="c-aksi">
          </colgroup>
          <thead>
            <tr>
              <th><input type="checkbox" class="chk" id="chk-all" onchange="toggleAll(this)"/></th>
              <th>Campaign</th>
              <th>Kategori</th>
              <th>Progres</th>
              <th>Target</th>
              <th>Donatur</th>
              <th>Status</th>
              <th>Berakhir</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($campaigns as $c)
            @php
              $pct = $c->target_dana > 0 ? min(100, round(($c->terkumpul ?? 0) / $c->target_dana * 100)) : 0;
              $fillCls = $pct >= 80 ? 'green' : ($pct >= 50 ? 'amber' : 'red');
            @endphp
            <tr id="row-{{ $c->id }}" class="{{ in_array($c->id, session('selected',[])) ? 'selected' : '' }}">
              <td><input type="checkbox" class="chk row-chk" data-id="{{ $c->id }}" onchange="toggleRow(this)"/></td>
              <td>
                <div class="camp-info">
                  @if($c->thumbnail)
                    <img src="{{ asset('storage/'.$c->thumbnail) }}" class="camp-thumb"/>
                  @else
                    <div class="camp-thumb-placeholder">
                      <svg width="16" height="12" viewBox="0 0 16 12" fill="none"><rect width="16" height="12" rx="2" fill="var(--border)"/><circle cx="4.5" cy="4" r="1.5" fill="var(--txt3)"/><path d="M0 9l4-3.5 3 2.5 3-2 5 4" stroke="var(--txt3)" stroke-width="1" stroke-linecap="round"/></svg>
                    </div>
                  @endif
                  <div>
                    <div class="camp-name">{{ $c->judul }}</div>
                    <div class="camp-org">{{ $c->lembaga?->nama ?? '—' }}</div>
                  </div>
                </div>
              </td>
              <td><span class="badge {{ $c->kategori }}">{{ $c->kategori_label }}</span></td>
              <td>
                <div class="progress-wrap">
                  <div class="pct">{{ $pct }}%</div>
                  <div class="prog-bar"><div class="prog-fill {{ $fillCls }}" style="width:{{ $pct }}%"></div></div>
                </div>
              </td>
              <td style="font-weight:600;color:var(--txt);font-size:11px">{{ 'Rp '.number_format($c->target_dana,0,',','.') }}</td>
              <td style="font-weight:600;color:var(--txt2)">{{ number_format($c->donatur_count ?? 0,0,',','.') }}</td>
              <td><span class="badge {{ $c->status }}">{{ ucfirst($c->status) }}</span></td>
              <td style="font-size:11px;color:var(--txt3)">{{ $c->tanggal_berakhir ? $c->tanggal_berakhir->format('d M Y') : '—' }}</td>
              <td>
                <div class="action-group">
                  {{-- Lihat detail --}}
                  <button class="action-btn" title="Lihat detail" onclick="openDetail({{ $c->id }})">
                    <svg viewBox="0 0 13 13" fill="none"><circle cx="6.5" cy="6.5" r="4.5" stroke="currentColor" stroke-width="1.2"/><circle cx="6.5" cy="6.5" r="1.5" fill="currentColor"/></svg>
                  </button>
                  {{-- Edit --}}
                  <button class="action-btn" title="Edit" onclick="showToast('Fitur edit segera hadir','warn')">
                    <svg viewBox="0 0 13 13" fill="none"><path d="M2 10l1.5-1.5 6.5-6.5 1 1-6.5 6.5L3 11l-1-1z" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>
                  </button>
                  {{-- Dropdown more --}}
                  <div style="position:relative">
                    <button class="more-btn" onclick="toggleDD({{ $c->id }})">
                      <svg viewBox="0 0 13 13" fill="none"><circle cx="6.5" cy="3.5" r="1" fill="currentColor"/><circle cx="6.5" cy="6.5" r="1" fill="currentColor"/><circle cx="6.5" cy="9.5" r="1" fill="currentColor"/></svg>
                    </button>
                    <div class="dropdown" id="dd-{{ $c->id }}">
                      {{-- Aktifkan --}}
                      <form method="POST" action="{{ route('admin.campaigns.status', $c) }}">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="aktif"/>
                        <button type="submit" class="dd-item" style="width:100%;text-align:left;background:none;border:none;cursor:pointer;font-family:inherit">
                          <svg viewBox="0 0 13 13" fill="none"><circle cx="6.5" cy="6.5" r="4.5" stroke="currentColor" stroke-width="1.2"/><path d="M4.5 6.5l1.5 1.5 2.5-2.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                          Aktifkan
                        </button>
                      </form>
                      {{-- Jadikan Draft --}}
                      <form method="POST" action="{{ route('admin.campaigns.status', $c) }}">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="draft"/>
                        <button type="submit" class="dd-item" style="width:100%;text-align:left;background:none;border:none;cursor:pointer;font-family:inherit">
                          <svg viewBox="0 0 13 13" fill="none"><path d="M8 2H3a1 1 0 00-1 1v7a1 1 0 001 1h7a1 1 0 001-1V5L8 2z" stroke="currentColor" stroke-width="1.2"/><path d="M8 2v3h3" stroke="currentColor" stroke-width="1.2"/></svg>
                          Jadikan Draft
                        </button>
                      </form>
                      <hr class="dd-sep"/>
                      {{-- Hapus --}}
                      <div class="dd-item danger" onclick="openModal({{ $c->id }}, '{{ addslashes($c->judul) }}')">
                        <svg viewBox="0 0 13 13" fill="none"><path d="M3 4h7M5 4V3h3v1M5.5 6v4M7.5 6v4M4 4l.5 7h4L9 4" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Hapus Campaign
                      </div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>

            {{-- DATA JSON untuk detail panel --}}
            <script>
              campaignData[{{ $c->id }}] = {
                id: {{ $c->id }},
                judul: @json($c->judul),
                lembaga: @json($c->lembaga?->nama ?? '—'),
                kategori: @json($c->kategori),
                kategori_label: @json($c->kategori_label),
                status: @json($c->status),
                target: {{ $c->target_dana }},
                terkumpul: {{ $c->terkumpul ?? 0 }},
                pct: {{ $pct }},
                donatur: {{ $c->donatur_count ?? 0 }},
                berakhir: @json($c->tanggal_berakhir ? $c->tanggal_berakhir->format('d M Y') : '—'),
                deskripsi: @json(Str::limit($c->deskripsi, 120)),
                thumbnail: @json($c->thumbnail ? asset('storage/'.$c->thumbnail) : null),
              };
            </script>

            @endforeach
          </tbody>
        </table>

        {{-- PAGINATION --}}
        <div class="pagination-wrap">
          <div class="page-info">
            Menampilkan {{ $campaigns->firstItem() }}–{{ $campaigns->lastItem() }} dari {{ $campaigns->total() }} campaign
          </div>
          <div class="page-btns">
            @if($campaigns->onFirstPage())
              <span class="page-btn" disabled>‹</span>
            @else
              <a href="{{ $campaigns->previousPageUrl() }}" class="page-btn">‹</a>
            @endif

            @foreach($campaigns->getUrlRange(1, $campaigns->lastPage()) as $page => $url)
              <a href="{{ $url }}" class="page-btn {{ $page == $campaigns->currentPage() ? 'active' : '' }}">{{ $page }}</a>
            @endforeach

            @if($campaigns->hasMorePages())
              <a href="{{ $campaigns->nextPageUrl() }}" class="page-btn">›</a>
            @else
              <span class="page-btn" disabled>›</span>
            @endif
          </div>
        </div>
      @endif
    </div>
  </div>

  {{-- ── GRID VIEW ── --}}
  <div id="grid-view" style="display:none">
    <div class="grid-container">
      @foreach($campaigns as $c)
      @php $pct2 = $c->target_dana > 0 ? min(100, round(($c->terkumpul ?? 0) / $c->target_dana * 100)) : 0; @endphp
      <div class="grid-card" onclick="openDetail({{ $c->id }})">
        <div class="grid-thumb">
          @if($c->thumbnail)
            <img src="{{ asset('storage/'.$c->thumbnail) }}"/>
          @else
            <svg width="28" height="20" viewBox="0 0 28 20" fill="none"><rect width="28" height="20" rx="3" fill="var(--border)"/><circle cx="7" cy="7" r="3" fill="var(--txt3)"/><path d="M0 15l7-6 5 4 5-3.5 11 7" stroke="var(--txt3)" stroke-width="1.2" stroke-linecap="round"/></svg>
          @endif
        </div>
        <div class="grid-body">
          <div style="margin-bottom:6px"><span class="badge {{ $c->kategori }}">{{ $c->kategori_label }}</span></div>
          <div class="grid-name">{{ $c->judul }}</div>
          <div class="grid-org">{{ $c->lembaga?->nama ?? '—' }}</div>
          <div class="prog-bar" style="margin-bottom:4px"><div class="prog-fill green" style="width:{{ $pct2 }}%"></div></div>
          <div style="display:flex;justify-content:space-between;font-size:10px">
            <span style="font-weight:700;color:var(--g6)">{{ $pct2 }}%</span>
            <span class="badge {{ $c->status }}">{{ ucfirst($c->status) }}</span>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>

</div>{{-- end .content --}}

{{-- ── DETAIL PANEL ── --}}
<div class="detail-panel" id="detail-panel">
  <div class="dp-head">
    <div class="dp-title">Detail Campaign</div>
    <button class="dp-close" onclick="closeDetail()">×</button>
  </div>
  <div class="dp-body" id="dp-body">
    <div style="color:var(--txt3);font-size:12px;text-align:center;padding:40px 0">Pilih campaign untuk melihat detail</div>
  </div>
  <div class="dp-actions" id="dp-actions" style="display:none">
    <button class="dp-btn edit" id="dp-edit-btn">Edit Campaign</button>
    <button class="dp-btn del" id="dp-del-btn">Hapus</button>
  </div>
</div>

{{-- ── DELETE MODAL ── --}}
<div class="modal-bg" id="delete-modal">
  <div class="modal">
    <div class="modal-icon">
      <svg viewBox="0 0 22 22" fill="none"><path d="M5 7h12M9 7V5h4v2M10 11v5M12 11v5M6 7l1 12h8l1-12" stroke="#E24B4A" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </div>
    <div class="modal-title">Hapus Campaign?</div>
    <div class="modal-sub" id="modal-desc">Campaign ini akan dihapus permanen.</div>
    <div class="modal-actions">
      <button class="modal-cancel" onclick="closeModal()">Batal</button>
      <button class="modal-delete" onclick="doDelete()">Ya, Hapus</button>
    </div>
  </div>
</div>

{{-- Hidden delete form --}}
<form id="delete-form" method="POST" style="display:none">
  @csrf @method('DELETE')
</form>

{{-- Toast --}}
<div id="toast"></div>

@endsection

@push('scripts')
<script>
/* ── INIT ── */
var campaignData = {};
var selected = {};
var currentView = 'table';
var deleteTarget = null;

/* ── FORMAT RUPIAH ── */
function fmt(n) {
  if (n >= 1000000000) return 'Rp ' + (n/1000000000).toFixed(1) + ' M';
  if (n >= 1000000)    return 'Rp ' + (n/1000000).toFixed(0) + ' Jt';
  return 'Rp ' + n.toLocaleString('id');
}

/* ── FILTER FORM (debounce) ── */
var filterTimer;
function submitFilter() {
  clearTimeout(filterTimer);
  filterTimer = setTimeout(function() {
    document.getElementById('filter-form').submit();
  }, 400);
}

/* ── VIEW TOGGLE ── */
function setView(v) {
  currentView = v;
  document.getElementById('table-view').style.display = v === 'table' ? 'block' : 'none';
  document.getElementById('grid-view').style.display  = v === 'grid'  ? 'block' : 'none';
  document.getElementById('view-table-btn').classList.toggle('active', v === 'table');
  document.getElementById('view-grid-btn').classList.toggle('active',  v === 'grid');
}

/* ── CHECKBOX ── */
function toggleRow(cb) {
  var id = cb.dataset.id;
  if (cb.checked) selected[id] = true; else delete selected[id];
  var row = document.getElementById('row-' + id);
  if (cb.checked) row.classList.add('selected'); else row.classList.remove('selected');
  updateBulkBar();
}
function toggleAll(cb) {
  document.querySelectorAll('.row-chk').forEach(function(c) {
    c.checked = cb.checked;
    var id = c.dataset.id;
    if (cb.checked) selected[id] = true; else delete selected[id];
    var row = document.getElementById('row-' + id);
    if (cb.checked) row.classList.add('selected'); else row.classList.remove('selected');
  });
  updateBulkBar();
}
function updateBulkBar() {
  var count = Object.keys(selected).length;
  var bar = document.getElementById('bulk-bar');
  if (count > 0) {
    bar.classList.add('show');
    document.getElementById('bulk-info').textContent = count + ' campaign dipilih';
  } else {
    bar.classList.remove('show');
  }
}
function clearSelection() {
  selected = {};
  document.querySelectorAll('.row-chk, #chk-all').forEach(function(c) { c.checked = false; });
  document.querySelectorAll('tr.selected').forEach(function(r) { r.classList.remove('selected'); });
  document.getElementById('bulk-bar').classList.remove('show');
}

/* ── DROPDOWN ── */
function toggleDD(id) {
  closeAllDD();
  var dd = document.getElementById('dd-' + id);
  dd.classList.add('open');
  setTimeout(function() {
    document.addEventListener('click', closeAllDD, { once: true });
  }, 10);
}
function closeAllDD() {
  document.querySelectorAll('.dropdown').forEach(function(d) { d.classList.remove('open'); });
}

/* ── DETAIL PANEL ── */
function openDetail(id) {
  var c = campaignData[id];
  if (!c) return;
  var body = document.getElementById('dp-body');
  body.innerHTML =
    '<div class="dp-thumb">'
      + (c.thumbnail ? '<img src="'+c.thumbnail+'"/>' : '<svg width="40" height="28" viewBox="0 0 40 28" fill="none"><rect width="40" height="28" rx="4" fill="var(--bg)"/><circle cx="10" cy="10" r="4" fill="var(--border)"/><path d="M0 20l10-8 7 6 7-4.5 16 10" stroke="var(--border)" stroke-width="1.5" stroke-linecap="round"/></svg>')
    + '</div>'
    + '<div style="margin-bottom:8px"><span class="badge '+c.kategori+'">'+c.kategori_label+'</span></div>'
    + '<div class="dp-name">'+c.judul+'</div>'
    + '<div class="dp-org">'+c.lembaga+'</div>'
    + '<div style="margin:10px 0 4px;display:flex;justify-content:space-between;font-size:11px"><span style="font-weight:700;color:var(--g6)">'+fmt(c.terkumpul)+'</span><span style="color:var(--txt3)">'+c.pct+'%</span></div>'
    + '<div class="dp-prog-bar"><div class="dp-prog-fill" style="width:'+Math.min(c.pct,100)+'%"></div></div>'
    + '<div style="font-size:10px;color:var(--txt3);margin-bottom:12px">dari '+fmt(c.target)+'</div>'
    + '<div class="dp-row"><div class="dp-label">Status</div><div><span class="badge '+c.status+'">'+ucFirst(c.status)+'</span></div></div>'
    + '<div class="dp-row"><div class="dp-label">Donatur</div><div class="dp-val">'+c.donatur.toLocaleString()+' orang</div></div>'
    + '<div class="dp-row"><div class="dp-label">Berakhir</div><div class="dp-val">'+c.berakhir+'</div></div>'
    + '<div class="dp-row" style="align-items:flex-start"><div class="dp-label" style="margin-top:2px">Deskripsi</div><div class="dp-val" style="font-weight:400;color:var(--txt2);text-align:right;max-width:180px;line-height:1.5;font-size:10px">'+c.deskripsi+'</div></div>';

  document.getElementById('dp-actions').style.display = 'flex';
  document.getElementById('dp-del-btn').onclick = function() { openModal(c.id, c.judul); };
  document.getElementById('detail-panel').classList.add('open');
}
function closeDetail() { document.getElementById('detail-panel').classList.remove('open'); }

function ucFirst(s) { return s ? s.charAt(0).toUpperCase() + s.slice(1) : s; }

/* ── DELETE MODAL ── */
function openModal(id, name) {
  deleteTarget = id;
  document.getElementById('modal-desc').textContent = name
    ? '"' + name + '" akan dihapus permanen. Data donasi terkait tetap tersimpan.'
    : 'Campaign yang dipilih akan dihapus permanen.';
  document.getElementById('delete-modal').classList.add('open');
}
function closeModal() { document.getElementById('delete-modal').classList.remove('open'); deleteTarget = null; }
function doDelete() {
  if (!deleteTarget) return;
  var form = document.getElementById('delete-form');
  form.action = '/admin/campaigns/' + deleteTarget;
  form.submit();
}

/* ── BULK STATUS ── */
function bulkStatus(status) {
  showToast('Fitur bulk update segera hadir', 'warn');
}

/* ── TOAST ── */
function showToast(msg, type) {
  var t = document.getElementById('toast');
  t.textContent = msg;
  t.className = type || 'success';
  t.style.display = 'block';
  clearTimeout(t._timer);
  t._timer = setTimeout(function() { t.style.display = 'none'; }, 2800);
}

/* ── Flash message dari Laravel ── */
@if(session('success'))
  showToast(@json(session('success')), 'success');
@endif
</script>
@endpush