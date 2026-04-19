@extends('admin.layouts.app')

@section('title', 'Dasbor — Berkahin Admin')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    .dash * { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }

    /* ── Topbar greeting ── */
    .dash-topbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 10px;
    }
    .dash-topbar h1 {
        font-size: 1.45rem;
        font-weight: 800;
        color: #111D17;
        letter-spacing: -.4px;
        margin: 0;
    }
    .dash-topbar h1 span { color: #1D9E75; }
    .date-pill {
        background: #E1F5EE;
        border: 1px solid #9FE1CB;
        color: #0F6E56;
        font-size: .78rem;
        font-weight: 600;
        padding: 6px 14px;
        border-radius: 20px;
    }

    /* ── Welcome banner ── */
    .welcome-banner {
        background: linear-gradient(115deg, #085041 0%, #1D9E75 100%);
        border-radius: 14px;
        padding: 22px 26px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 22px;
        position: relative;
        overflow: hidden;
    }
    .welcome-banner::before {
        content: '';
        position: absolute;
        right: -20px; top: -20px;
        width: 180px; height: 180px;
        border-radius: 50%;
        background: rgba(255,255,255,.06);
    }
    .welcome-banner::after {
        content: '';
        position: absolute;
        right: 80px; bottom: -50px;
        width: 120px; height: 120px;
        border-radius: 50%;
        background: rgba(255,255,255,.04);
    }
    .wb-left h2 {
        color: rgba(255,255,255,.65);
        font-size: .8rem;
        font-weight: 500;
        margin: 0 0 5px;
    }
    .wb-left h3 {
        color: #fff;
        font-size: 1.15rem;
        font-weight: 800;
        margin: 0 0 6px;
    }
    .wb-left p {
        color: rgba(255,255,255,.6);
        font-size: .82rem;
        margin: 0;
        line-height: 1.55;
    }
    .wb-stats {
        display: flex;
        gap: 12px;
        position: relative;
        z-index: 1;
        flex-shrink: 0;
        flex-wrap: wrap;
    }
    .wb-stat {
        background: rgba(255,255,255,.12);
        border-radius: 10px;
        padding: 12px 18px;
        text-align: center;
        min-width: 100px;
    }
    .wb-stat .wbs-num {
        font-size: 1.25rem;
        font-weight: 800;
        color: #fff;
        line-height: 1;
    }
    .wb-stat .wbs-label {
        font-size: .7rem;
        color: rgba(255,255,255,.6);
        margin-top: 4px;
        font-weight: 500;
    }

    /* ── Stat cards ── */
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        margin-bottom: 22px;
    }
    @media (max-width: 900px) { .stat-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 500px) { .stat-grid { grid-template-columns: 1fr; } }

    .stat-card {
        background: #fff;
        border: 1px solid #E2EAE6;
        border-radius: 14px;
        padding: 18px 18px 14px;
        position: relative;
        overflow: hidden;
    }
    .stat-card::after {
        content: '';
        position: absolute;
        right: 0; top: 0; bottom: 0;
        width: 4px;
        border-radius: 0 14px 14px 0;
    }
    .stat-card.green::after { background: #1D9E75; }
    .stat-card.amber::after { background: #FAC775; }
    .stat-card.blue::after  { background: #185FA5; }
    .stat-card.red::after   { background: #E24B4A; }

    .sc-top { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 12px; }
    .sc-icon {
        width: 38px; height: 38px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem;
    }
    .sc-icon.green { background: #E1F5EE; }
    .sc-icon.amber { background: #FAEEDA; }
    .sc-icon.blue  { background: #E6F1FB; }
    .sc-icon.red   { background: #FCEBEB; }

    .sc-change {
        font-size: .7rem;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 20px;
    }
    .sc-change.up   { background: #E1F5EE; color: #0F6E56; }
    .sc-change.down { background: #FCEBEB; color: #A32D2D; }
    .sc-change.neu  { background: #F3F7F5; color: #7A9588; }

    .sc-val {
        font-size: 1.6rem;
        font-weight: 800;
        color: #111D17;
        line-height: 1;
        margin-bottom: 4px;
    }
    .sc-label { font-size: .75rem; font-weight: 600; color: #7A9588; }
    .sc-sub   { font-size: .72rem; color: #7A9588; margin-top: 5px; }
    .sc-sub strong { color: #0F6E56; font-weight: 700; }

    /* spark mini chart */
    .sc-spark {
        display: flex;
        align-items: flex-end;
        gap: 2px;
        height: 24px;
        margin-top: 10px;
    }
    .spark-b {
        flex: 1;
        border-radius: 2px 2px 0 0;
        background: #E1F5EE;
        transition: .3s;
    }
    .spark-b.last { background: #1D9E75; }
    .stat-card.amber .spark-b { background: #FAEEDA; }
    .stat-card.amber .spark-b.last { background: #BA7517; }
    .stat-card.blue  .spark-b { background: #E6F1FB; }
    .stat-card.blue  .spark-b.last { background: #185FA5; }
    .stat-card.red   .spark-b { background: #FCEBEB; }
    .stat-card.red   .spark-b.last { background: #E24B4A; }

    /* ── Main 2-col layout ── */
    .main-cols {
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 16px;
        margin-bottom: 18px;
    }
    @media (max-width: 900px) { .main-cols { grid-template-columns: 1fr; } }

    /* ── Panel ── */
    .panel {
        background: #fff;
        border: 1px solid #E2EAE6;
        border-radius: 14px;
        overflow: hidden;
        margin-bottom: 0;
    }
    .panel-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 18px;
        border-bottom: 1px solid #F0F7F3;
    }
    .panel-head h2 {
        font-size: .92rem;
        font-weight: 700;
        color: #111D17;
        margin: 0;
    }
    .panel-head .ph-right {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .panel-link {
        font-size: .75rem;
        font-weight: 600;
        color: #1D9E75;
        text-decoration: none;
    }
    .panel-link:hover { text-decoration: underline; }

    /* period tabs */
    .period-tabs {
        display: flex;
        background: #F3F7F5;
        border-radius: 7px;
        padding: 2px;
        gap: 2px;
    }
    .pt {
        padding: 4px 10px;
        border-radius: 5px;
        font-size: .7rem;
        font-weight: 700;
        color: #7A9588;
        cursor: pointer;
        border: none;
        background: transparent;
        font-family: 'Plus Jakarta Sans', sans-serif;
        transition: .15s;
    }
    .pt.active {
        background: #fff;
        color: #0F6E56;
        box-shadow: 0 1px 4px rgba(0,0,0,.08);
    }

    /* ── Chart area ── */
    .chart-wrap { padding: 16px 18px 8px; }
    .chart-legend {
        display: flex;
        gap: 14px;
        padding: 8px 18px 14px;
    }
    .legend-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: .75rem;
        color: #3D5949;
    }
    .legend-dot { width: 8px; height: 8px; border-radius: 2px; }

    /* ── Donut card ── */
    .donut-inner {
        padding: 16px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .donut-svg { width: 150px; height: 150px; margin-bottom: 14px; }
    .donut-items { width: 100%; display: flex; flex-direction: column; gap: 9px; }
    .donut-row { display: flex; align-items: center; gap: 8px; }
    .donut-dot { width: 9px; height: 9px; border-radius: 3px; flex-shrink: 0; }
    .donut-label { font-size: .75rem; color: #3D5949; flex: 1; }
    .donut-bar {
        height: 3px;
        border-radius: 2px;
        background: #F3F7F5;
        flex: 2;
        overflow: hidden;
    }
    .donut-fill { height: 100%; border-radius: 2px; }
    .donut-pct { font-size: .75rem; font-weight: 700; color: #111D17; }

    /* ── Bottom 3-col ── */
    .bottom-cols {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 16px;
        margin-bottom: 18px;
    }
    @media (max-width: 900px) { .bottom-cols { grid-template-columns: 1fr; } }

    /* ── Donasi terbaru ── */
    .donasi-list { padding: 0; }
    .donasi-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 11px 16px;
        border-bottom: 1px solid #F5FAF5;
    }
    .donasi-item:last-child { border-bottom: none; }
    .donasi-av {
        width: 34px; height: 34px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: .8rem; font-weight: 800;
        flex-shrink: 0;
    }
    .donasi-name  { font-size: .82rem; font-weight: 700; color: #111D17; }
    .donasi-camp  { font-size: .7rem; color: #7A9588; margin-top: 1px; }
    .donasi-amt   { margin-left: auto; font-size: .82rem; font-weight: 700; white-space: nowrap; }

    /* ── Top campaign ── */
    .tc-list { padding: 0; }
    .tc-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 16px;
        border-bottom: 1px solid #F5FAF5;
    }
    .tc-item:last-child { border-bottom: none; }
    .tc-num {
        width: 20px;
        font-size: .72rem;
        font-weight: 800;
        color: #7A9588;
        text-align: center;
        flex-shrink: 0;
    }
    .tc-num.gold { color: #BA7517; }
    .tc-info { flex: 1; min-width: 0; }
    .tc-name {
        font-size: .78rem;
        font-weight: 700;
        color: #111D17;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .tc-org { font-size: .68rem; color: #7A9588; margin-top: 1px; }
    .tc-bar { height: 3px; border-radius: 2px; background: #F3F7F5; margin-top: 5px; overflow: hidden; }
    .tc-fill { height: 100%; border-radius: 2px; background: #1D9E75; }
    .tc-right { text-align: right; flex-shrink: 0; }
    .tc-amt   { font-size: .78rem; font-weight: 700; color: #0F6E56; }
    .tc-pct   { font-size: .68rem; color: #7A9588; }

    /* ── Perlu tindakan ── */
    .action-list { padding: 0; }
    .action-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 10px 16px;
        border-bottom: 1px solid #F5FAF5;
    }
    .action-item:last-child { border-bottom: none; }
    .action-icon {
        width: 30px; height: 30px;
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: .9rem;
        flex-shrink: 0;
    }
    .action-info { flex: 1; min-width: 0; }
    .action-name { font-size: .78rem; font-weight: 700; color: #111D17; }
    .action-sub  { font-size: .68rem; color: #7A9588; margin-top: 2px; }
    .action-btns { display: flex; gap: 4px; margin-top: 6px; }
    .abtn {
        font-size: .68rem;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        font-family: 'Plus Jakarta Sans', sans-serif;
        text-decoration: none;
        display: inline-block;
    }
    .abtn.approve { background: #E1F5EE; color: #0F6E56; }
    .abtn.reject  { background: #FCEBEB; color: #A32D2D; }
    .abtn.approve:hover { background: #1D9E75; color: #fff; }
    .abtn.reject:hover  { background: #E24B4A; color: #fff; }

    /* Badge */
    .badge {
        display: inline-block;
        padding: 2px 9px;
        border-radius: 20px;
        font-size: .7rem;
        font-weight: 700;
    }
    .badge-aktif   { background: #E1F5EE; color: #0F6E56; }
    .badge-selesai { background: #E6F1FB; color: #185FA5; }
    .badge-draft   { background: #F1EFE8; color: #5F5E5A; }
    .badge-tutup   { background: #FCEBEB; color: #A32D2D; }
    .badge-pending { background: #FAEEDA; color: #854F0B; }

    /* progress bar */
    .prog-wrap { width: 100%; background: #F3F7F5; border-radius: 4px; height: 5px; }
    .prog-fill { height: 5px; border-radius: 4px; background: #1D9E75; }

    /* empty state */
    .empty-row td {
        text-align: center;
        padding: 28px;
        color: #7A9588;
        font-size: .82rem;
        font-weight: 600;
    }

    /* campaign table */
    .camp-table { width: 100%; border-collapse: collapse; }
    .camp-table th {
        padding: 9px 18px;
        font-size: .7rem;
        font-weight: 700;
        color: #7A9588;
        text-transform: uppercase;
        letter-spacing: .06em;
        background: #FAFCFA;
        border-bottom: 1px solid #F0F7F3;
        text-align: left;
    }
    .camp-table td {
        padding: 12px 18px;
        font-size: .82rem;
        color: #3D5949;
        border-bottom: 1px solid #F5FAF5;
        vertical-align: middle;
    }
    .camp-table tr:last-child td { border-bottom: none; }
    .camp-table tr:hover td { background: #FAFCFA; }
    .camp-name { font-weight: 700; color: #111D17; margin-bottom: 2px; }
    .camp-meta { font-size: .7rem; color: #7A9588; }

    /* Hewan grid */
    .hewan-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        padding: 16px;
    }
    .hewan-card {
        background: #FAFCFA;
        border: 1px solid #E2EAE6;
        border-radius: 10px;
        padding: 14px;
        text-align: center;
    }
    .hewan-card .h-emoji { font-size: 1.6rem; margin-bottom: 4px; }
    .hewan-card .h-name  { font-size: .68rem; font-weight: 700; color: #7A9588; text-transform: uppercase; letter-spacing: .05em; }
    .hewan-card .h-val   { font-size: 1.3rem; font-weight: 800; color: #111D17; line-height: 1.1; }
    .hewan-card .h-sub   { font-size: .65rem; color: #B0C0B8; }
</style>
@endpush

@section('content')
<div class="dash">

    {{-- ── Topbar ── --}}
    <div class="dash-topbar">
        <h1>Selamat datang, <span>{{ auth()->user()->name ?? 'Admin' }}</span> 👋</h1>
        <span class="date-pill">{{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}</span>
    </div>

    {{-- ── Welcome Banner ── --}}
    <div class="welcome-banner">
        <div class="wb-left">
            <h2>Ringkasan Platform Berkahin</h2>
            <h3>🐄 Musim Kurban Segera Tiba</h3>
            <p>Buat dan kelola campaign kurban agar siap sebelum Idul Adha.<br>
               Ada <strong style="color:#9FE1CB">{{ $pendingVerifikasi ?? 0 }}</strong> item menunggu persetujuan kamu.</p>
        </div>
        <div class="wb-stats">
            <div class="wb-stat">
                <div class="wbs-num">Rp {{ $totalDonasiFormatted ?? '0' }}</div>
                <div class="wbs-label">Terkumpul bulan ini</div>
            </div>
            <div class="wb-stat">
                <strong>{{ number_format($totalDonatur ?? 0) }}</strong>
                <div class="wbs-label">Total donatur</div>
            </div>
            <div class="wb-stat">
                <div class="wbs-num" style="color:#9FE1CB">{{ $activeCampaigns ?? 0 }}</div>
                <div class="wbs-label">Campaign aktif</div>
            </div>
        </div>
    </div>

    {{-- ── Stat Cards ── --}}
    <div class="stat-grid">

        {{-- Total Campaign --}}
        <div class="stat-card green">
            <div class="sc-top">
                <div class="sc-icon green">📢</div>
                <span class="sc-change up">{{ $activeCampaigns ?? 0 }} aktif</span>
            </div>
            <div class="sc-val">{{ $totalCampaigns ?? 0 }}</div>
            <div class="sc-label">Total Campaign</div>
            <div class="sc-sub"><strong>{{ $activeCampaigns ?? 0 }}</strong> sedang berjalan</div>
            <div class="sc-spark">
                @foreach([30,45,38,55,50,65,80] as $i => $h)
                    <div class="spark-b {{ $i === 6 ? 'last' : '' }}" style="height:{{ $h }}%"></div>
                @endforeach
            </div>
        </div>

        {{-- Total Donasi --}}
        <div class="stat-card amber">
            <div class="sc-top">
                <div class="sc-icon amber">💰</div>
                <span class="sc-change up">bulan ini</span>
            </div>
            <div class="sc-val" style="font-size:1.3rem">Rp {{ $totalDonasiFormatted ?? '0' }}</div>
            <div class="sc-label">Total Donasi</div>
            <div class="sc-sub">dari <strong>{{ number_format($totalDonatur ?? 0) }}</strong> donatur</div>
            <div class="sc-spark">
                @foreach([25,40,35,60,55,70,90] as $i => $h)
                    <div class="spark-b {{ $i === 6 ? 'last' : '' }}" style="height:{{ $h }}%"></div>
                @endforeach
            </div>
        </div>

        {{-- Hewan Terkumpul --}}
        <div class="stat-card blue">
            <div class="sc-top">
                <div class="sc-icon blue">🐄</div>
                <span class="sc-change neu">{{ $totalCampaigns ?? 0 }} campaign</span>
            </div>
            <div class="sc-val">{{ number_format($totalHewan ?? 0) }}</div>
            <div class="sc-label">Hewan Terkumpul</div>
            <div class="sc-sub">Sapi · Kambing · Domba · Kerbau</div>
            <div class="sc-spark">
                @foreach([20,35,28,45,40,58,70] as $i => $h)
                    <div class="spark-b {{ $i === 6 ? 'last' : '' }}" style="height:{{ $h }}%"></div>
                @endforeach
            </div>
        </div>

        {{-- Menunggu Verifikasi --}}
        <div class="stat-card red">
            <div class="sc-top">
                <div class="sc-icon red">⏳</div>
                @if($pendingVerifikasi ?? 0 > 0)
                    <span class="sc-change down">{{ $pendingVerifikasi }} item</span>
                @else
                    <span class="sc-change up">Bersih</span>
                @endif
            </div>
            <div class="sc-val">{{ $pendingVerifikasi ?? 0 }}</div>
            <div class="sc-label">Menunggu Verifikasi</div>
            <div class="sc-sub">
                @if($pendingVerifikasi ?? 0 > 0)
                    <strong style="color:#E24B4A">Segera</strong> ditindaklanjuti
                @else
                    Semua sudah diproses
                @endif
            </div>
            <div class="sc-spark">
                @foreach([60,50,70,45,55,40,30] as $i => $h)
                    <div class="spark-b {{ $i === 6 ? 'last' : '' }}" style="height:{{ $h }}%"></div>
                @endforeach
            </div>
        </div>

    </div>

    {{-- ── Main 2-col: Chart + Donut ── --}}
    <div class="main-cols">

        {{-- Tren Donasi --}}
        <div class="panel">
            <div class="panel-head">
                <div>
                    <h2>📈 Tren Donasi</h2>
                </div>
                <div class="ph-right">
                    <div class="period-tabs">
                        <button class="pt" onclick="changePeriod(this,'7h')">7H</button>
                        <button class="pt active" onclick="changePeriod(this,'1B')">1B</button>
                        <button class="pt" onclick="changePeriod(this,'3B')">3B</button>
                        <button class="pt" onclick="changePeriod(this,'1T')">1T</button>
                    </div>
                </div>
            </div>
            <div class="chart-wrap">
                <canvas id="donasiChart" style="width:100%;height:180px;max-height:180px"></canvas>
            </div>
            <div class="chart-legend">
                <div class="legend-item">
                    <div class="legend-dot" style="background:#1D9E75"></div> Donasi masuk
                </div>
                <div class="legend-item">
                    <div class="legend-dot" style="background:#9FE1CB"></div> Rata-rata target
                </div>
            </div>
        </div>

        {{-- Donut: Distribusi Hewan --}}
        <div class="panel">
            <div class="panel-head">
                <h2>🐄 Sebaran Hewan</h2>
            </div>
            <div class="donut-inner">
                <svg class="donut-svg" viewBox="0 0 150 150">
                    @php
                        $hewanSapi    = $hewanSapi    ?? 0;
                        $hewanKambing = $hewanKambing ?? 0;
                        $hewanDomba   = $hewanDomba   ?? 0;
                        $hewanKerbau  = $hewanKerbau  ?? 0;
                        $totalH       = max(1, $hewanSapi + $hewanKambing + $hewanDomba + $hewanKerbau);
                        $circ         = 2 * 3.14159 * 52; // ~326.7
                        $segments = [
                            ['val' => $hewanSapi,    'color' => '#1D9E75', 'label' => 'Sapi'],
                            ['val' => $hewanKambing, 'color' => '#185FA5', 'label' => 'Kambing'],
                            ['val' => $hewanDomba,   'color' => '#BA7517', 'label' => 'Domba'],
                            ['val' => $hewanKerbau,  'color' => '#534AB7', 'label' => 'Kerbau'],
                        ];
                        $offset = 0;
                    @endphp
                    <circle cx="75" cy="75" r="52" fill="none" stroke="#F3F7F5" stroke-width="20"/>
                    @foreach($segments as $seg)
                        @php
                            $pct  = $totalH > 0 ? $seg['val'] / $totalH : 0;
                            $dash = round($pct * $circ, 2);
                            $gap  = round($circ - $dash, 2);
                        @endphp
                        @if($dash > 0)
                        <circle cx="75" cy="75" r="52" fill="none"
                            stroke="{{ $seg['color'] }}"
                            stroke-width="20"
                            stroke-dasharray="{{ $dash }} {{ $gap }}"
                            stroke-dashoffset="{{ -$offset }}"
                            stroke-linecap="butt"
                            transform="rotate(-90 75 75)"/>
                        @php $offset += $dash; @endphp
                        @endif
                    @endforeach
                    <text x="75" y="70" text-anchor="middle" font-size="13" font-weight="800"
                          fill="#111D17" font-family="Plus Jakarta Sans,sans-serif">{{ number_format($totalHewan ?? 0 ) }}</text>
                    <text x="75" y="84" text-anchor="middle" font-size="8" fill="#7A9588"
                          font-family="Plus Jakarta Sans,sans-serif">ekor total</text>
                </svg>
                <div class="donut-items">
                    @foreach([
                        ['label'=>'Sapi',    'color'=>'#1D9E75','val'=>$hewanSapi],
                        ['label'=>'Kambing', 'color'=>'#185FA5','val'=>$hewanKambing],
                        ['label'=>'Domba',   'color'=>'#BA7517','val'=>$hewanDomba],
                        ['label'=>'Kerbau',  'color'=>'#534AB7','val'=>$hewanKerbau],
                    ] as $item)
                    @php $pct = $totalH > 0 ? round($item['val'] / $totalH * 100) : 0; @endphp
                    <div class="donut-row">
                        <div class="donut-dot" style="background:{{ $item['color'] }}"></div>
                        <div class="donut-label">{{ $item['label'] }}</div>
                        <div class="donut-bar">
                            <div class="donut-fill" style="background:{{ $item['color'] }};width:{{ $pct }}%"></div>
                        </div>
                        <div class="donut-pct">{{ $pct }}%</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

    {{-- ── Bottom 3-col ── --}}
    <div class="bottom-cols">

        {{-- Donasi Terbaru --}}
        <div class="panel">
            <div class="panel-head">
                <h2>🤝 Donasi Terbaru</h2>
                <a href="#" class="panel-link">Lihat semua →</a>
            </div>
            <div class="donasi-list">
                @forelse($latestDonatur ?? [] as $donatur)
                @php
                    $colors = ['#DDFAF0|#0F6E56','#FDE8D8|#9B3A0A','#E6F1FB|#185FA5','#EEF0FF|#534AB7','#FAEEDA|#854F0B','#FCEBEB|#A32D2D'];
                    [$bg, $tc] = explode('|', $colors[$loop->index % count($colors)]);
                @endphp
                <div class="donasi-item">
                    <div class="donasi-av" style="background:{{ $bg }};color:{{ $tc }}">
                        {{ strtoupper(substr($donatur->nama ?? 'D', 0, 1)) }}
                    </div>
                    <div>
                        <div class="donasi-name">{{ $donatur->nama ?? 'Donatur' }}</div>
                        <div class="donasi-camp">{{ $donatur->campaign->nama ?? '—' }}</div>
                    </div>
                    <div class="donasi-amt" style="color:{{ $tc }}">
                        Rp {{ number_format($donatur->jumlah ?? 0, 0, ',', '.') }}
                    </div>
                </div>
                @empty
                <div style="text-align:center;padding:28px;color:#7A9588;font-size:.82rem;font-weight:600">
                    Belum ada donatur.
                </div>
                @endforelse
            </div>
        </div>

        {{-- Campaign Terpopuler --}}
        <div class="panel">
            <div class="panel-head">
                <h2>🏆 Campaign Terpopuler</h2>
                <a href="{{ route('admin.campaigns.index') }}" class="panel-link">Semua →</a>
            </div>
            <div class="tc-list">
                @forelse($topCampaigns ?? [] as $campaign)
                @php
                    $pct = $campaign->target > 0
                         ? min(100, round($campaign->terkumpul / $campaign->target * 100))
                         : 0;
                    $fillColors = ['#1D9E75','#E24B4A','#1D9E75','#185FA5','#BA7517'];
                    $fillColor  = $fillColors[$loop->index % count($fillColors)];
                @endphp
                <div class="tc-item">
                    <div class="tc-num {{ $loop->index < 2 ? 'gold' : '' }}">{{ $loop->iteration }}</div>
                    <div class="tc-info">
                        <div class="tc-name">{{ $campaign->nama }}</div>
                        <div class="tc-org">{{ $campaign->lembaga ?? '—' }} · {{ number_format($campaign->total_donatur ?? 0) }} donatur</div>
                        <div class="tc-bar">
                            <div class="tc-fill" style="width:{{ $pct }}%;background:{{ $fillColor }}"></div>
                        </div>
                    </div>
                    <div class="tc-right">
                        <div class="tc-amt">Rp {{ $campaign->terkumpul_formatted ?? number_format($campaign->terkumpul ?? 0, 0, ',', '.') }}</div>
                        <div class="tc-pct">{{ $pct }}%</div>
                    </div>
                </div>
                @empty
                <div style="text-align:center;padding:28px;color:#7A9588;font-size:.82rem;font-weight:600">
                    Belum ada data campaign.
                </div>
                @endforelse
            </div>
        </div>

        {{-- Perlu Tindakan --}}
        <div class="panel">
            <div class="panel-head">
                <h2>⚡ Perlu Tindakan</h2>
                @if($pendingVerifikasi ?? 0 > 0)
                    <span class="badge badge-pending">{{ $pendingVerifikasi }} item</span>
                @endif
            </div>
            <div class="action-list">
                @forelse($pendingItems ?? [] as $item)
                <div class="action-item">
                    <div class="action-icon"
                         style="background:{{ $item['type'] === 'lembaga' ? '#E6F1FB' : '#FAEEDA' }}">
                        {{ $item['type'] === 'lembaga' ? '🏢' : '💳' }}
                    </div>
                    <div class="action-info">
                        <div class="action-name">{{ $item['nama'] }}</div>
                        <div class="action-sub">{{ $item['keterangan'] }}</div>
                        <div class="action-btns">
                            <a href="{{ $item['approve_url'] ?? '#' }}" class="abtn approve">Terima</a>
                            <a href="{{ $item['reject_url']  ?? '#' }}" class="abtn reject">Tolak</a>
                        </div>
                    </div>
                </div>
                @empty
                <div style="text-align:center;padding:28px">
                    <div style="font-size:1.5rem;margin-bottom:6px">✅</div>
                    <div style="font-size:.82rem;font-weight:700;color:#0F6E56">Semua bersih!</div>
                    <div style="font-size:.72rem;color:#7A9588;margin-top:3px">Tidak ada item pending.</div>
                </div>
                @endforelse
            </div>
        </div>

    </div>

    {{-- ── Campaign Terbaru — tabel ── --}}
    <div class="panel" style="margin-bottom:18px">
        <div class="panel-head">
            <h2>📋 Campaign Terbaru</h2>
            <a href="{{ route('admin.campaigns.index') }}" class="panel-link">Lihat semua →</a>
        </div>
        <table class="camp-table">
            <thead>
                <tr>
                    <th>Campaign</th>
                    <th>Jenis Hewan</th>
                    <th style="min-width:140px">Progres</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($latestCampaigns ?? [] as $campaign)
                @php
                    $pct = $campaign->target > 0
                         ? min(100, round($campaign->terkumpul / $campaign->target * 100))
                         : 0;
                    $statusMap = [
                        'aktif'   => 'badge-aktif',
                        'selesai' => 'badge-selesai',
                        'draft'   => 'badge-draft',
                        'tutup'   => 'badge-tutup',
                    ];
                    $cls = $statusMap[$campaign->status ?? 'draft'] ?? 'badge-draft';
                @endphp
                <tr>
                    <td>
                        <div class="camp-name">{{ $campaign->nama }}</div>
                        <div class="camp-meta">{{ $campaign->lembaga ?? '—' }}</div>
                    </td>
                    <td>
                        @php
                            $heIcon = ['sapi'=>'🐄','kambing'=>'🐐','domba'=>'🐑','kerbau'=>'🫏'];
                            $hj = $campaign->jenis_hewan ?? 'sapi';
                        @endphp
                        {{ $heIcon[$hj] ?? '🐄' }} {{ ucfirst($hj) }}
                    </td>
                    <td>
                        <div style="font-size:.72rem;color:#7A9588;margin-bottom:4px;font-weight:600">
                            {{ $pct }}% &nbsp;·&nbsp;
                            Rp {{ number_format($campaign->terkumpul ?? 0, 0, ',', '.') }} /
                            Rp {{ number_format($campaign->target ?? 0, 0, ',', '.') }}
                        </div>
                        <div class="prog-wrap">
                            <div class="prog-fill" style="width:{{ $pct }}%"></div>
                        </div>
                    </td>
                    <td><span class="badge {{ $cls }}">{{ ucfirst($campaign->status ?? 'draft') }}</span></td>
                    <td>
                        <a href="{{ route('admin.campaigns.edit', $campaign->id) }}"
                           style="font-size:.75rem;font-weight:700;color:#1D9E75;text-decoration:none">
                            Edit →
                        </a>
                    </td>
                </tr>
                @empty
                <tr class="empty-row">
                    <td colspan="5">
                        Belum ada campaign.
                        <a href="{{ route('admin.campaigns.create') }}" style="color:#1D9E75;">Buat sekarang →</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
<script>
var chartData = {
    '7h': {
        labels: ['Sen','Sel','Rab','Kam','Jum','Sab','Min'],
        vals:   [120,95,180,140,200,240,160],
        targets:[150,150,150,150,150,150,150]
    },
    '1B': {
        labels: ['1','3','5','7','9','11','13','15','17','19','21','23','25','27','29'],
        vals:   [80,95,120,100,180,150,200,170,210,240,190,260,220,280,240],
        targets:[160,160,160,160,160,160,160,160,160,160,160,160,160,160,160]
    },
    '3B': {
        labels: ['Feb','Mar','Apr'],
        vals:   [1800,2100,2400],
        targets:[2000,2000,2000]
    },
    '1T': {
        labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
        vals:   [1400,1600,1750,2400,0,0,0,0,0,0,0,0],
        targets:[1800,1800,1800,1800,1800,1800,1800,1800,1800,1800,1800,1800]
    }
};

// Ganti dengan data dari controller jika tersedia
@if(isset($chartMonthly))
chartData['1B'].vals   = {!! json_encode($chartMonthly['vals'] ?? []) !!};
chartData['1B'].labels = {!! json_encode($chartMonthly['labels'] ?? []) !!};
@endif

var myChart;

function buildChart(period) {
    var d      = chartData[period];
    var canvas = document.getElementById('donasiChart');
    if (!canvas) return;
    if (myChart) myChart.destroy();
    myChart = new Chart(canvas, {
        type: 'bar',
        data: {
            labels: d.labels,
            datasets: [
                {
                    label: 'Donasi masuk',
                    data: d.vals,
                    backgroundColor: 'rgba(29,158,117,.18)',
                    borderColor: '#1D9E75',
                    borderWidth: 1.5,
                    borderRadius: 4,
                    borderSkipped: false
                },
                {
                    label: 'Rata-rata target',
                    data: d.targets,
                    type: 'line',
                    borderColor: '#9FE1CB',
                    borderWidth: 1.5,
                    borderDash: [5,4],
                    pointRadius: 0,
                    fill: false,
                    tension: .3
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    enabled: true,
                    backgroundColor: '#fff',
                    titleColor: '#111D17',
                    bodyColor: '#3D5949',
                    borderColor: '#E2EAE6',
                    borderWidth: 1,
                    padding: 10,
                    callbacks: {
                        label: function(c) {
                            return '  Rp ' + c.raw.toLocaleString('id') + ' Jt';
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 9, family: 'Plus Jakarta Sans' }, color: '#7A9588' },
                    border: { display: false }
                },
                y: {
                    grid: { color: '#F3F7F5' },
                    ticks: {
                        font: { size: 9, family: 'Plus Jakarta Sans' },
                        color: '#7A9588',
                        callback: function(v) { return v > 0 ? v + ' Jt' : ''; }
                    },
                    border: { display: false }
                }
            }
        }
    });
}

function changePeriod(el, period) {
    document.querySelectorAll('.pt').forEach(function(b) { b.classList.remove('active'); });
    el.classList.add('active');
    buildChart(period);
}

document.addEventListener('DOMContentLoaded', function() {
    buildChart('1B');
});
</script>
@endpush