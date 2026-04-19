@extends('admin.layouts.app')

@section('title', 'Tambah Campaign Baru')

@push('styles')

<style>
.main > *:first-child { margin-top: 0; }

/* ── CONTENT GRID ── */
.content { padding: 20px 22px; display: grid; grid-template-columns: 1fr 280px; gap: 16px; align-items: start; }

/* ── CARD ── */
.card { background: #fff; border: 1px solid var(--border); border-radius: 12px; overflow: hidden; margin-bottom: 14px; }
.card-head { padding: 14px 18px; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 10px; }
.card-icon { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; }
.card-icon.green  { background: var(--g0); }
.card-icon.amber  { background: var(--amber0); }
.card-icon.blue   { background: var(--blue0); }
.card-icon.red    { background: var(--red0); }
.card-icon svg    { width: 15px; height: 15px; }
.card-title { font-size: 13px; font-weight: 700; color: var(--txt); }
.card-sub   { font-size: 11px; color: var(--txt3); margin-top: 1px; }
.card-body  { padding: 18px; }

/* ── FORM ── */
.form-row  { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
.fg        { display: flex; flex-direction: column; gap: 5px; margin-bottom: 14px; }
.fg:last-child { margin-bottom: 0; }
label      { font-size: 10px; font-weight: 700; color: var(--txt2); text-transform: uppercase; letter-spacing: .07em; display: flex; align-items: center; gap: 4px; }
label .req  { color: var(--g5); font-size: 12px; line-height: 1; }
label .hint { font-weight: 400; text-transform: none; letter-spacing: 0; color: var(--txt3); font-size: 10px; margin-left: 4px; }

input[type=text], input[type=number], input[type=date],
input[type=url], select, textarea {
  width: 100%; border: 1px solid var(--border); border-radius: 8px;
  padding: 9px 12px; font-size: 12px; color: var(--txt);
  outline: none; font-family: inherit; background: #fff;
  transition: .15s; appearance: none; -webkit-appearance: none;
}
input:focus, select:focus, textarea:focus {
  border-color: var(--g5); box-shadow: 0 0 0 3px rgba(29,158,117,.1);
}
input::placeholder, textarea::placeholder { color: var(--txt3); }
textarea { resize: vertical; min-height: 90px; line-height: 1.6; }
select {
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6' fill='none'%3E%3Cpath d='M1 1l4 4 4-4' stroke='%237A9588' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
  background-repeat: no-repeat; background-position: right 10px center; padding-right: 28px; cursor: pointer;
}

/* Error state */
.is-invalid { border-color: var(--red) !important; }
.invalid-feedback { font-size: 10px; color: var(--red); margin-top: 3px; display: block; }

.char-count { font-size: 10px; color: var(--txt3); text-align: right; margin-top: 3px; }

/* ── MONEY INPUT ── */
.money-wrap   { position: relative; }
.money-prefix { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); font-size: 12px; font-weight: 600; color: var(--txt3); pointer-events: none; }
.money-input  { padding-left: 34px !important; }

/* ── UPLOAD ── */
.upload-zone { border: 1.5px dashed var(--border); border-radius: 10px; padding: 28px 16px; text-align: center; cursor: pointer; transition: .2s; background: #FAFCFA; position: relative; }
.upload-zone:hover { border-color: var(--g5); background: var(--g0); }
.upload-zone.has-img { border-style: solid; border-color: var(--g1); padding: 0; overflow: hidden; }
.upload-icon { width: 40px; height: 40px; border-radius: 10px; background: var(--g0); display: flex; align-items: center; justify-content: center; margin: 0 auto 10px; }
.upload-icon svg { width: 18px; height: 18px; }
.upload-text { font-size: 12px; font-weight: 500; color: var(--txt2); margin-bottom: 4px; }
.upload-hint { font-size: 10px; color: var(--txt3); }
.upload-input { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }
.img-preview { width: 100%; height: 160px; object-fit: cover; display: block; }

/* ── TAG INPUT ── */
.tag-wrap { border: 1px solid var(--border); border-radius: 8px; padding: 6px 10px; display: flex; flex-wrap: wrap; gap: 6px; min-height: 38px; cursor: text; transition: .15s; background: #fff; }
.tag-wrap:focus-within { border-color: var(--g5); box-shadow: 0 0 0 3px rgba(29,158,117,.1); }
.tag { background: var(--g0); color: var(--g6); font-size: 11px; font-weight: 600; padding: 2px 8px; border-radius: 20px; display: flex; align-items: center; gap: 4px; }
.tag-x { cursor: pointer; color: var(--g6); opacity: .7; font-size: 13px; line-height: 1; }
.tag-x:hover { opacity: 1; }
.tag-input { border: none; outline: none; font-size: 12px; font-family: inherit; color: var(--txt); background: transparent; min-width: 80px; flex: 1; padding: 2px 0; }

/* ── RADIO ── */
.radio-group { display: flex; flex-direction: column; gap: 8px; }
.radio-opt { display: flex; align-items: flex-start; gap: 10px; padding: 10px 12px; border: 1px solid var(--border); border-radius: 8px; cursor: pointer; transition: .15s; }
.radio-opt:hover { border-color: var(--g1); background: var(--g0); }
.radio-opt.selected { border-color: var(--g5); background: var(--g0); }
.radio-dot { width: 16px; height: 16px; border-radius: 50%; border: 2px solid var(--border); margin-top: 1px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; transition: .15s; }
.radio-opt.selected .radio-dot { border-color: var(--g5); }
.radio-dot-inner { width: 7px; height: 7px; border-radius: 50%; background: var(--g5); display: none; }
.radio-opt.selected .radio-dot-inner { display: block; }
.radio-label { font-size: 12px; font-weight: 600; color: var(--txt); }
.radio-sub   { font-size: 10px; color: var(--txt3); margin-top: 2px; }

/* ── TOGGLE ── */
.toggle-row { display: flex; align-items: center; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid var(--border); }
.toggle-row:last-child { border-bottom: none; padding-bottom: 0; }
.toggle-label { font-size: 12px; font-weight: 500; color: var(--txt); }
.toggle-sub   { font-size: 10px; color: var(--txt3); margin-top: 2px; }
.toggle { position: relative; width: 36px; height: 20px; flex-shrink: 0; }
.toggle input { opacity: 0; width: 0; height: 0; position: absolute; }
.toggle-slider { position: absolute; inset: 0; border-radius: 20px; background: var(--border); cursor: pointer; transition: .2s; }
.toggle-slider::before { content: ''; position: absolute; width: 14px; height: 14px; left: 3px; top: 3px; border-radius: 50%; background: #fff; transition: .2s; }
.toggle input:checked + .toggle-slider { background: var(--g5); }
.toggle input:checked + .toggle-slider::before { transform: translateX(16px); }


/* ── SUMMARY CARD (sticky right panel) ── */
.summary-card { 
  background: #fff; 
  border: 1px solid var(--border); 
  border-radius: 12px; 
  overflow: hidden; 
  margin-bottom: 14px; 
}

.sc-head  { background: var(--g9); padding: 14px 16px; }
.sc-title { font-size: 12px; font-weight: 700; color: #fff; }
.sc-sub   { font-size: 10px; color: rgba(255,255,255,.4); margin-top: 2px; }
.sc-body  { padding: 16px; }
.sc-preview { border-radius: 8px; overflow: hidden; background: var(--bg); margin-bottom: 14px; height: 110px; display: flex; align-items: center; justify-content: center; }
.sc-prev-placeholder { text-align: center; color: var(--txt3); }
.sc-prev-img { width: 100%; height: 100%; object-fit: cover; }
.sc-field { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px; gap: 8px; }
.sc-field-label { font-size: 10px; color: var(--txt3); font-weight: 500; flex-shrink: 0; }
.sc-field-val   { font-size: 11px; font-weight: 600; color: var(--txt); text-align: right; }
.sc-sep { border: none; border-top: 1px solid var(--border); margin: 12px 0; }

/* badges */
.badge { display: inline-flex; align-items: center; padding: 2px 8px; border-radius: 20px; font-size: 10px; font-weight: 700; }
.badge.qurban     { background: var(--g0); color: var(--g6); }
.badge.darurat    { background: var(--red0); color: var(--red); }
.badge.pendidikan { background: var(--blue0); color: var(--blue); }
.badge.kesehatan  { background: #F0EDF8; color: #6B3FA0; }
.badge.zakat      { background: var(--amber0); color: var(--amber); }
.badge.masjid     { background: #F5F0E8; color: #8B5E3C; }
.badge.empty      { background: var(--bg); color: var(--txt3); }

.progress-bar  { height: 5px; border-radius: 3px; background: var(--bg); overflow: hidden; margin: 4px 0 2px; }
.progress-fill { height: 100%; background: var(--g5); border-radius: 3px; width: 0%; transition: .3s; }

.status-pill { display: inline-flex; align-items: center; gap: 5px; padding: 4px 10px; border-radius: 20px; font-size: 10px; font-weight: 700; }
.status-pill.aktif  { background: var(--g0); color: var(--g6); }
.status-pill.draft  { background: var(--bg); color: var(--txt3); }
.status-pill.promo  { background: var(--amber0); color: var(--amber); }
.dot-pulse { width: 6px; height: 6px; border-radius: 50%; background: currentColor; }

/* ── STEP LIST ── */
.step-list { display: flex; flex-direction: column; gap: 0; }
.step-item { display: flex; gap: 12px; padding-bottom: 16px; position: relative; }
.step-item:not(:last-child)::before { content: ''; position: absolute; left: 13px; top: 26px; bottom: 0; width: 1px; background: var(--border); }
.step-num { width: 26px; height: 26px; border-radius: 50%; border: 2px solid var(--border); display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: 700; color: var(--txt3); background: #fff; flex-shrink: 0; z-index: 1; transition: .2s; }
.step-num.done   { background: var(--g5); border-color: var(--g5); color: #fff; }
.step-num.active { border-color: var(--g5); color: var(--g6); }
.step-content { flex: 1; padding-top: 3px; }
.step-title { font-size: 11px; font-weight: 700; color: var(--txt); }
.step-desc  { font-size: 10px; color: var(--txt3); margin-top: 2px; }

/* ── TOAST ── */
#toast { display: none; position: fixed; bottom: 24px; right: 24px; z-index: 999; background: var(--g7); color: #fff; padding: 12px 18px; border-radius: 10px; font-size: 12px; font-weight: 600; box-shadow: 0 4px 20px rgba(0,0,0,.2); transition: .3s; }
</style>
@endpush

@section('breadcrumb')
<a href="{{ route('admin.dashboard') }}" style="color:var(--txt3);text-decoration:none">Campaign</a>
  <span class="sep">›</span>
  <span class="cur">Tambah Campaign Baru</span>
@endsection

@section('topbar-actions')
  <a href="{{ route('admin.campaigns.index') }}" class="btn-ghost">Batal</a>
  <button type="button" class="btn-draft" onclick="saveDraft()">Simpan Draft</button>
  <button type="button" class="btn-primary" onclick="publish()">
    <svg width="11" height="11" viewBox="0 0 11 11" fill="none">
      <path d="M5.5 1.5l3 3-3 3M1.5 9V6.5a4 4 0 014-4H8.5" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    Publikasikan
  </button>
@endsection

@section('content')
<form id="campaign-form" action="{{ route('admin.campaigns.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="content">

  {{-- KOLOM KIRI --}}
  <div>

    {{-- 1. INFORMASI DASAR --}}
    <div class="card">
      <div class="card-head">
        <div class="card-icon green">
          <svg viewBox="0 0 15 15" fill="none"><path d="M2 4h11M4 7h7M6 10h3" stroke="#0F6E56" stroke-width="1.3" stroke-linecap="round"/></svg>
        </div>
        <div>
          <div class="card-title">Informasi Dasar</div>
          <div class="card-sub">Judul, kategori, dan deskripsi campaign</div>
        </div>
      </div>
      <div class="card-body">

        <div class="fg">
          <label>Judul Campaign <span class="req">*</span></label>
          <input type="text" id="inp-judul" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Bantuan Banjir Jawa Tengah 2026" maxlength="100" class="{{ $errors->has('judul') ? 'is-invalid' : '' }}" oninput="updatePreview()"/>
          @error('judul') <span class="invalid-feedback">{{ $message }}</span> @enderror
          <div class="char-count"><span id="judul-len">{{ strlen(old('judul', '')) }}</span>/100</div>
        </div>

        <div class="form-row">
          <div class="fg" style="margin-bottom:0">
            <label>Kategori <span class="req">*</span></label>
            <select id="inp-kategori" name="kategori" class="{{ $errors->has('kategori') ? 'is-invalid' : '' }}" onchange="updatePreview()">
              <option value="">— Pilih Kategori —</option>
              <option value="qurban"     {{ old('kategori') == 'qurban' ? 'selected' : '' }}>Qurban</option>
              <option value="darurat"    {{ old('kategori') == 'darurat' ? 'selected' : '' }}>Darurat / Bencana</option>
              <option value="pendidikan" {{ old('kategori') == 'pendidikan' ? 'selected' : '' }}>Pendidikan</option>
              <option value="kesehatan"  {{ old('kategori') == 'kesehatan' ? 'selected' : '' }}>Kesehatan</option>
              <option value="zakat"      {{ old('kategori') == 'zakat' ? 'selected' : '' }}>Zakat & Infaq</option>
              <option value="masjid"     {{ old('kategori') == 'masjid' ? 'selected' : '' }}>Masjid & Ibadah</option>
            </select>
            @error('kategori') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>
          <div class="fg" style="margin-bottom:0">
            <label>Lembaga / Yayasan <span class="req">*</span></label>
            <select id="inp-lembaga" name="lembaga_id" class="{{ $errors->has('lembaga_id') ? 'is-invalid' : '' }}" onchange="updatePreview()">
              <option value="">— Pilih Lembaga —</option>
              @foreach($lembagas as $lb)
                <option value="{{ $lb->id }}" {{ old('lembaga_id') == $lb->id ? 'selected' : '' }}>{{ $lb->nama }}</option>
              @endforeach
            </select>
            @error('lembaga_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>
        </div>

        <div class="fg" style="margin-top:14px">
          <label>Deskripsi Campaign <span class="req">*</span> <span class="hint">— ceritakan latar belakang & tujuan</span></label>
          <textarea id="inp-desc" name="deskripsi" rows="4" maxlength="2000" class="{{ $errors->has('deskripsi') ? 'is-invalid' : '' }}" placeholder="Tuliskan cerita di balik campaign ini agar donatur merasa terhubung...">{{ old('deskripsi') }}</textarea>
          @error('deskripsi') <span class="invalid-feedback">{{ $message }}</span> @enderror
          <div class="char-count"><span id="desc-len">{{ strlen(old('deskripsi', '')) }}</span>/2000</div>
        </div>

        <div class="fg" style="margin-bottom:0">
          <label>Tag Campaign <span class="hint">— tekan Enter atau koma untuk tambah</span></label>
          <div class="tag-wrap" id="tag-wrap" onclick="document.getElementById('tag-input').focus()">
            <input id="tag-input" class="tag-input" placeholder="Contoh: mendesak, featured, promo..." onkeydown="handleTag(event)"/>
          </div>
          <input type="hidden" id="tags-hidden" name="tags" value="{{ old('tags') }}"/>
        </div>

      </div>
    </div>

    {{-- 2. TARGET DANA & WAKTU --}}
    <div class="card">
      <div class="card-head">
        <div class="card-icon amber">
          <svg viewBox="0 0 15 15" fill="none"><rect x="2" y="3" width="11" height="9" rx="1.5" stroke="#BA7517" stroke-width="1.2"/><path d="M2 6.5h11M5 3V1.5M10 3V1.5" stroke="#BA7517" stroke-width="1.2" stroke-linecap="round"/></svg>
        </div>
        <div>
          <div class="card-title">Target Dana & Waktu</div>
          <div class="card-sub">Nominal, durasi, dan minimum donasi</div>
        </div>
      </div>
      <div class="card-body">
        <div class="form-row">
          <div class="fg" style="margin-bottom:0">
            <label>Target Dana <span class="req">*</span></label>
            <div class="money-wrap">
              <span class="money-prefix">Rp</span>
              <input type="number" id="inp-target" name="target_dana" class="money-input {{ $errors->has('target_dana') ? 'is-invalid' : '' }}" value="{{ old('target_dana') }}" placeholder="300000000" min="0" oninput="updatePreview()"/>
            </div>
            @error('target_dana') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>
          <div class="fg" style="margin-bottom:0">
            <label>Donasi Minimum</label>
            <div class="money-wrap">
              <span class="money-prefix">Rp</span>
              <input type="number" name="donasi_minimum" class="money-input" value="{{ old('donasi_minimum', 10000) }}" placeholder="10000" min="0"/>
            </div>
          </div>
        </div>
        <div class="form-row" style="margin-top:14px">
          <div class="fg" style="margin-bottom:0">
            <label>Tanggal Mulai <span class="req">*</span></label>
            <input type="date" id="inp-start" name="tanggal_mulai" value="{{ old('tanggal_mulai', now()->toDateString()) }}" class="{{ $errors->has('tanggal_mulai') ? 'is-invalid' : '' }}" onchange="updatePreview()"/>
            @error('tanggal_mulai') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>
          <div class="fg" style="margin-bottom:0">
            <label>Tanggal Berakhir <span class="req">*</span></label>
            <input type="date" id="inp-end" name="tanggal_berakhir" value="{{ old('tanggal_berakhir') }}" class="{{ $errors->has('tanggal_berakhir') ? 'is-invalid' : '' }}" onchange="updatePreview()"/>
            @error('tanggal_berakhir') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>
        </div>
      </div>
    </div>

    {{-- 3. TIPE & STATUS CAMPAIGN --}}
    <div class="card">
      <div class="card-head">
        <div class="card-icon blue">
          <svg viewBox="0 0 15 15" fill="none"><path d="M7.5 2L2 12h11L7.5 2z" stroke="#185FA5" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/><path d="M7.5 6v3M7.5 10.5v.5" stroke="#185FA5" stroke-width="1.2" stroke-linecap="round"/></svg>
        </div>
        <div>
          <div class="card-title">Tipe & Status Campaign</div>
          <div class="card-sub">Tentukan urgensi dan label campaign</div>
        </div>
      </div>
      <div class="card-body">
        <label style="margin-bottom:10px;display:block">Tipe Campaign <span class="req">*</span></label>
        <input type="hidden" id="tipe-hidden" name="tipe" value="{{ old('tipe', 'reguler') }}"/>
        <div class="radio-group" id="radio-group">
          <div class="radio-opt {{ old('tipe','reguler') == 'reguler' ? 'selected' : '' }}" onclick="selectRadio(this,'reguler')">
            <div class="radio-dot"><div class="radio-dot-inner"></div></div>
            <div><div class="radio-label">Reguler</div><div class="radio-sub">Campaign standar tanpa label khusus</div></div>
          </div>
          <div class="radio-opt {{ old('tipe') == 'promo' ? 'selected' : '' }}" onclick="selectRadio(this,'promo')">
            <div class="radio-dot"><div class="radio-dot-inner"></div></div>
            <div><div class="radio-label">Promo / Terbatas</div><div class="radio-sub">Tampilkan badge "Promo" pada card campaign</div></div>
          </div>
          <div class="radio-opt {{ old('tipe') == 'darurat' ? 'selected' : '' }}" onclick="selectRadio(this,'darurat')">
            <div class="radio-dot"><div class="radio-dot-inner"></div></div>
            <div><div class="radio-label">Darurat / Mendesak</div><div class="radio-sub">Badge merah "Mendesak" — didahulukan di beranda</div></div>
          </div>
          <div class="radio-opt {{ old('tipe') == 'wakaf' ? 'selected' : '' }}" onclick="selectRadio(this,'wakaf')">
            <div class="radio-dot"><div class="radio-dot-inner"></div></div>
            <div><div class="radio-label">Wakaf</div><div class="radio-sub">Campaign wakaf produktif jangka panjang</div></div>
          </div>
        </div>

        <div style="margin-top:16px">
          <label style="margin-bottom:10px;display:block">Pengaturan Tampilan</label>
          <div class="toggle-row">
            <div><div class="toggle-label">Tampilkan di Beranda</div><div class="toggle-sub">Masukkan ke bagian Rekomendasi Campaign Terpilih</div></div>
            <label class="toggle"><input type="checkbox" id="tog-beranda" name="tampil_beranda" value="1" {{ old('tampil_beranda', true) ? 'checked' : '' }} onchange="updatePreview()"><div class="toggle-slider"></div></label>
          </div>
          <div class="toggle-row">
            <div><div class="toggle-label">Izinkan Donasi Anonim</div><div class="toggle-sub">Donatur dapat berdonasi tanpa menampilkan nama</div></div>
            <label class="toggle"><input type="checkbox" name="izin_anonim" value="1" {{ old('izin_anonim', true) ? 'checked' : '' }}><div class="toggle-slider"></div></label>
          </div>
          <div class="toggle-row">
            <div><div class="toggle-label">Tampilkan Jumlah Donatur</div><div class="toggle-sub">Tampilkan berapa orang yang sudah berdonasi</div></div>
            <label class="toggle"><input type="checkbox" name="tampil_jumlah_donatur" value="1" {{ old('tampil_jumlah_donatur', true) ? 'checked' : '' }}><div class="toggle-slider"></div></label>
          </div>
          <div class="toggle-row">
            <div><div class="toggle-label">Notifikasi Email ke Lembaga</div><div class="toggle-sub">Kirim email konfirmasi saat campaign tayang</div></div>
            <label class="toggle"><input type="checkbox" name="notif_email_lembaga" value="1" {{ old('notif_email_lembaga', true) ? 'checked' : '' }}><div class="toggle-slider"></div></label>
          </div>
        </div>
      </div>
    </div>

    {{-- 4. MEDIA CAMPAIGN --}}
    <div class="card">
      <div class="card-head">
        <div class="card-icon red">
          <svg viewBox="0 0 15 15" fill="none"><rect x="1.5" y="3" width="12" height="9" rx="1.5" stroke="#A32D2D" stroke-width="1.2"/><circle cx="5" cy="6.5" r="1" fill="#A32D2D"/><path d="M1.5 10l3.5-3 3 2.5 2-1.5 3 3" stroke="#A32D2D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <div>
          <div class="card-title">Media Campaign</div>
          <div class="card-sub">Gambar thumbnail dan video pendukung</div>
        </div>
      </div>
      <div class="card-body">
        <div class="fg">
          <label>Gambar Thumbnail <span class="req">*</span> <span class="hint">— PNG/JPG, maks 5MB, rasio 16:9</span></label>
          <div class="upload-zone" id="upload-zone">
            <input type="file" name="thumbnail" class="upload-input" accept="image/*" onchange="previewImage(event)"/>
            <div class="upload-icon">
              <svg viewBox="0 0 18 18" fill="none"><path d="M9 12V4M9 4L6 7M9 4l3 3" stroke="#0F6E56" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/><path d="M3 14h12" stroke="#0F6E56" stroke-width="1.4" stroke-linecap="round"/></svg>
            </div>
            <div class="upload-text">Klik untuk upload gambar</div>
            <div class="upload-hint">atau drag & drop di sini</div>
            <img id="upload-preview-img" class="img-preview" style="display:none"/>
          </div>
          @error('thumbnail') <span class="invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="fg" style="margin-bottom:0">
          <label>URL Video <span class="hint">— opsional, YouTube atau Vimeo</span></label>
          <input type="url" name="url_video" value="{{ old('url_video') }}" placeholder="https://youtube.com/watch?v=..."/>
          @error('url_video') <span class="invalid-feedback">{{ $message }}</span> @enderror
        </div>
      </div>
    </div>

    {{-- 5. STATUS PUBLIKASI --}}
    <div class="card">
      <div class="card-head">
        <div class="card-icon green">
          <svg viewBox="0 0 15 15" fill="none"><path d="M7.5 2C4.5 2 2 4.5 2 7.5S4.5 13 7.5 13 13 10.5 13 7.5 10.5 2 7.5 2z" stroke="#0F6E56" stroke-width="1.2"/><path d="M5 7.5l2 2 3-3" stroke="#0F6E56" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <div>
          <div class="card-title">Status Publikasi</div>
          <div class="card-sub">Atur kapan campaign mulai tayang</div>
        </div>
      </div>
      <div class="card-body">
        <div class="fg" style="margin-bottom:0">
          <label>Status</label>
          <select id="inp-status" name="status" onchange="updatePreview()">
            <option value="aktif"  {{ old('status','aktif') == 'aktif' ? 'selected' : '' }}>Aktif — tayang sekarang saat dipublikasikan</option>
            <option value="draft"  {{ old('status') == 'draft' ? 'selected' : '' }}>Draft — simpan dulu, belum tayang</option>
            <option value="jadwal" {{ old('status') == 'jadwal' ? 'selected' : '' }}>Jadwalkan — tayang pada waktu tertentu</option>
          </select>
        </div>
        <div id="jadwal-input" style="display:{{ old('status') == 'jadwal' ? 'block' : 'none' }};margin-top:12px">
          <div class="fg" style="margin-bottom:0">
            <label>Waktu Tayang</label>
            <input type="date" name="jadwal_tayang" value="{{ old('jadwal_tayang') }}" id="inp-jadwal"/>
            @error('jadwal_tayang') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>
        </div>
      </div>
    </div>

  </div>

  {{-- KOLOM KANAN --}}
  <div style="position: sticky; top: 72px; align-self: start;">
    
    {{-- Pratinjau Campaign --}}
    <div class="summary-card">
      <div class="sc-head">
        <div class="sc-title">Pratinjau Campaign</div>
        <div class="sc-sub">Tampilan di beranda website</div>
      </div>
      <div class="sc-body">
        <div class="sc-preview" id="sc-preview">
          <div class="sc-prev-placeholder" id="preview-placeholder">
            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" style="margin:0 auto 6px;display:block">
              <rect x="2" y="5" width="24" height="18" rx="3" stroke="var(--txt3)" stroke-width="1.3"/>
              <circle cx="9" cy="11" r="2" stroke="var(--txt3)" stroke-width="1.2"/>
              <path d="M2 19l6-5 5 4 4-3 9 5" stroke="var(--txt3)" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <div style="font-size:10px;color:var(--txt3)">Thumbnail belum diunggah</div>
          </div>
          <img id="preview-img" style="display:none;width:100%;height:100%;object-fit:cover"/>
        </div>

        <div id="preview-badge" style="margin-bottom:10px">
          <span class="badge empty">Belum ada kategori</span>
        </div>

        <div style="font-size:13px;font-weight:700;color:var(--txt);line-height:1.4;margin-bottom:6px;min-height:38px" id="preview-title">
          Judul campaign akan tampil di sini
        </div>
        <div style="font-size:10px;color:var(--txt3);margin-bottom:10px" id="preview-org">— Pilih lembaga —</div>

        <div class="progress-bar"><div class="progress-fill" id="preview-progress" style="width:0%"></div></div>
        <div style="display:flex;justify-content:space-between;font-size:10px;color:var(--txt3);margin-bottom:12px">
          <span>Rp 0</span>
          <span id="preview-target-small">Target: Rp —</span>
        </div>

        <hr class="sc-sep"/>

        <div class="sc-field">
          <div class="sc-field-label">Target Dana</div>
          <div class="sc-field-val" id="preview-target">Rp —</div>
        </div>
        <div class="sc-field">
          <div class="sc-field-label">Durasi</div>
          <div class="sc-field-val" id="preview-durasi">— hari</div>
        </div>
        <div class="sc-field">
          <div class="sc-field-label">Di Beranda</div>
          <div class="sc-field-val" id="preview-beranda">Ya</div>
        </div>
        <div class="sc-field" style="margin-bottom:0">
          <div class="sc-field-label">Status</div>
          <div id="preview-status"><span class="status-pill aktif"><div class="dot-pulse"></div>Aktif</span></div>
        </div>
      </div>
    </div>

    {{-- Langkah Pengisian --}}
    <div class="card">
      <div class="card-head">
        <div class="card-icon green">
          <svg viewBox="0 0 15 15" fill="none"><path d="M7.5 1.5L2 5v8h11V5L7.5 1.5z" stroke="#0F6E56" stroke-width="1.2" stroke-linejoin="round"/><rect x="5" y="9" width="5" height="4" rx=".5" stroke="#0F6E56" stroke-width="1.2"/></svg>
        </div>
        <div><div class="card-title">Langkah Pengisian</div></div>
      </div>
      <div class="card-body">
        <div class="step-list">
          <div class="step-item">
            <div class="step-num active" id="step1">1</div>
            <div class="step-content"><div class="step-title">Informasi Dasar</div><div class="step-desc">Judul, kategori, deskripsi, tag</div></div>
          </div>
          <div class="step-item">
            <div class="step-num" id="step2">2</div>
            <div class="step-content"><div class="step-title">Target & Waktu</div><div class="step-desc">Dana target, tanggal mulai & akhir</div></div>
          </div>
          <div class="step-item">
            <div class="step-num" id="step3">3</div>
            <div class="step-content"><div class="step-title">Tipe & Pengaturan</div><div class="step-desc">Urgensi, toggle tampilan</div></div>
          </div>
          <div class="step-item">
            <div class="step-num" id="step4">4</div>
            <div class="step-content"><div class="step-title">Media</div><div class="step-desc">Upload thumbnail campaign</div></div>
          </div>
          <div class="step-item" style="padding-bottom:0">
            <div class="step-num" id="step5">5</div>
            <div class="step-content"><div class="step-title">Publikasi</div><div class="step-desc">Pilih status & terbitkan</div></div>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>
</form>

<div id="toast"></div>
@endsection

@push('scripts')
@php
    $oldTags = old('tags') ? array_values(array_filter(array_map('trim', explode(',', old('tags'))))) : [];
@endphp
<script>
/* semua script kamu tetap sama persis */
var tags = @json($oldTags);
function handleTag(e) { /* ... (semua fungsi script kamu yang lama) */ }
function renderTags() { /* ... */ }
function removeTag(t) { /* ... */ }
renderTags();

document.getElementById('inp-judul').addEventListener('input', function() { document.getElementById('judul-len').textContent = this.value.length; });
document.getElementById('inp-desc').addEventListener('input', function() { document.getElementById('desc-len').textContent = this.value.length; });

function selectRadio(el, val) { /* ... */ }
function previewImage(e) { /* ... */ }
function updatePreview() { /* ... */ }
function updateSteps() { /* ... */ }
function toggle(id, condition) { /* ... */ }
function publish() { /* ... */ }
function saveDraft() { /* ... */ }
function showToast(msg) { /* ... */ }

var today = new Date().toISOString().split('T')[0];
document.getElementById('inp-start').min = today;
document.getElementById('inp-end').min   = today;
updatePreview();
</script>
@endpush