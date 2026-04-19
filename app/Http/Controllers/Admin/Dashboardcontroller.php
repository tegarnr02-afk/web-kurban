<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Donatur;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // ── Nilai default — tidak akan pernah undefined di blade ───────────
        $totalCampaigns       = 0;
        $activeCampaigns      = 0;
        $totalDonasi          = 0;
        $totalDonasiFormatted = '0';
        $totalDonatur         = 0;
        $pendingVerifikasi    = 0;
        $totalHewan           = 0;
        $hewanSapi            = 0;
        $hewanKambing         = 0;
        $hewanDomba           = 0;
        $hewanKerbau          = 0;
        $latestCampaigns      = collect();
        $topCampaigns         = collect();
        $latestDonatur        = collect();
        $pendingItems         = collect();
        $chartMonthly         = ['labels' => [], 'vals' => []];

        // ── Statistik Campaign ─────────────────────────────────────────────
        try {
            $totalCampaigns  = Campaign::count();
            $activeCampaigns = Campaign::where('status', 'aktif')->count();
            $latestCampaigns = Campaign::latest()->take(5)->get();
        } catch (\Exception $e) {
            // tabel campaigns belum ada atau kolom berbeda — lewati
        }

        // ── Sebaran Hewan ──────────────────────────────────────────────────
        // Ganti 'target' dengan kolom jumlah hewan di tabelmu (misal: jumlah_hewan)
        try {
            $totalHewan   = Campaign::sum('target') ?? 0;
            $hewanSapi    = Campaign::where('jenis_hewan', 'sapi')->sum('target')    ?? 0;
            $hewanKambing = Campaign::where('jenis_hewan', 'kambing')->sum('target') ?? 0;
            $hewanDomba   = Campaign::where('jenis_hewan', 'domba')->sum('target')   ?? 0;
            $hewanKerbau  = Campaign::where('jenis_hewan', 'kerbau')->sum('target')  ?? 0;
        } catch (\Exception $e) {
            // kolom jenis_hewan belum ada — lewati
        }

        // ── Campaign terpopuler ────────────────────────────────────────────
        // withCount('donaturs') butuh relasi hasMany Donatur di model Campaign
        // Jika belum ada relasinya, blok ini akan di-skip
        try {
            $topCampaigns = Campaign::withCount('donaturs')
                ->withSum('donaturs', 'jumlah')
                ->orderByDesc('donaturs_count')
                ->take(5)
                ->get()
                ->map(function ($c) {
                    $c->total_donatur       = $c->donaturs_count ?? 0;
                    $c->terkumpul           = $c->donaturs_sum_jumlah ?? 0;
                    $c->terkumpul_formatted = $this->formatRupiah($c->terkumpul);
                    return $c;
                });
        } catch (\Exception $e) {
            // relasi donaturs belum ada di model Campaign — lewati
            $topCampaigns = collect();
        }

        // ── Statistik Donatur ──────────────────────────────────────────────
        // Ganti 'Donatur' dengan nama model yang kamu pakai
        try {
            $totalDonasi       = Donatur::where('status', 'verified')->sum('jumlah') ?? 0;
            $totalDonatur      = Donatur::count() ?? 0;
            $pendingVerifikasi = Donatur::where('status', 'pending')->count() ?? 0;
            $totalDonasiFormatted = $this->formatRupiah($totalDonasi);

            $latestDonatur = Donatur::with('campaign')
                ->latest()
                ->take(6)
                ->get();

            // Pending items untuk panel "Perlu Tindakan"
            Donatur::where('status', 'pending')
                ->latest()
                ->take(5)
                ->get()
                ->each(function ($d) use (&$pendingItems) {
                    $pendingItems->push([
                        'type'       => 'donatur',
                        'nama'       => $d->nama ?? 'Donatur',
                        'keterangan' => 'Verifikasi donasi · Rp ' . number_format($d->jumlah ?? 0, 0, ',', '.'),
                        // Ganti dengan route verifikasi yang sebenarnya
                        'approve_url' => route('admin.campaigns.index'),
                        'reject_url'  => route('admin.campaigns.index'),
                    ]);
                });
        } catch (\Exception $e) {
            // model Donatur belum ada atau kolom berbeda — lewati
        }

        // ── Grafik donasi harian (30 hari terakhir) ────────────────────────
        try {
            $chartMonthly = $this->buildMonthlyChartData();
        } catch (\Exception $e) {
            $chartMonthly = ['labels' => [], 'vals' => []];
        }

        return view('admin.dashboard', compact(
            'totalCampaigns',
            'activeCampaigns',
            'totalDonasi',
            'totalDonasiFormatted',
            'totalDonatur',
            'pendingVerifikasi',
            'totalHewan',
            'hewanSapi',
            'hewanKambing',
            'hewanDomba',
            'hewanKerbau',
            'latestCampaigns',
            'topCampaigns',
            'latestDonatur',
            'pendingItems',
            'chartMonthly',
        ));
    }

    // ── Helper: format angka ke singkatan rupiah ───────────────────────────
    private function formatRupiah(int|float $angka): string
    {
        if ($angka >= 1_000_000_000) {
            return number_format($angka / 1_000_000_000, 1, ',', '.') . ' M';
        }
        if ($angka >= 1_000_000) {
            return number_format($angka / 1_000_000, 1, ',', '.') . ' Jt';
        }
        if ($angka >= 1_000) {
            return number_format($angka / 1_000, 0, ',', '.') . ' Rb';
        }
        return number_format($angka, 0, ',', '.');
    }

    // ── Helper: data grafik donasi 30 hari terakhir ───────────────────────
    private function buildMonthlyChartData(): array
    {
        // Ambil total donasi per hari selama 30 hari terakhir
        // Sesuaikan nama tabel & kolom dengan skema Anda
        $rows = Donatur::select(
                DB::raw('DATE(created_at) as tgl'),
                DB::raw('SUM(jumlah) as total')
            )
            ->where('status', 'verified')
            ->where('created_at', '>=', Carbon::now()->subDays(29)->startOfDay())
            ->groupBy('tgl')
            ->orderBy('tgl')
            ->get()
            ->keyBy('tgl');

        $labels = [];
        $vals   = [];

        for ($i = 29; $i >= 0; $i--) {
            $date     = Carbon::now()->subDays($i)->format('Y-m-d');
            $label    = Carbon::now()->subDays($i)->format('d/m');
            $labels[] = $label;
            // bagi 1 juta agar satuan grafik = Juta Rupiah
            $vals[]   = round(($rows[$date]->total ?? 0) / 1_000_000, 1);
        }

        return [
            'labels' => $labels,
            'vals'   => $vals,
        ];
    }
}