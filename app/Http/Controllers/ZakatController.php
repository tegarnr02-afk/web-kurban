<?php

namespace App\Http\Controllers;

use App\Models\ZakatPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ZakatController extends Controller
{
    // ── Nisab & konstanta ─────────────────────────────────────
    const NISAB_EMAS_GRAM   = 85;      // gram
    const NISAB_PERAK_GRAM  = 595;     // gram
    const NISAB_PROFESI_RP  = 6_500_000; // Rp/bulan (≈ 520 kg beras)
    const NISAB_MAAL_RP     = 85_000_000; // Rp (≈ 85 g emas)
    const KADAR_ZAKAT       = 0.025;   // 2,5 %

    // ─────────────────────────────────────────────────────────
    // HALAMAN UTAMA
    // ─────────────────────────────────────────────────────────

    /**
     * Tampilkan halaman zakat (beranda zakat).
     */
    public function index()
    {
        $stats = [
            'total_terkumpul'  => ZakatPayment::where('status', 'success')->sum('nominal'),
            'jumlah_muzakki'   => ZakatPayment::where('status', 'success')->distinct('kontak')->count('kontak'),
            'total_disalurkan' => ZakatPayment::where('status', 'success')->where('disalurkan', true)->sum('nominal'),
        ];

        return view('zakat.index', compact('stats'));
    }

    // ─────────────────────────────────────────────────────────
    // KALKULATOR ZAKAT  (endpoint AJAX)
    // ─────────────────────────────────────────────────────────

    /**
     * POST /zakat/hitung
     * Menghitung zakat sesuai jenis yang dikirim.
     */
    public function hitung(Request $request)
    {
        $jenis = $request->input('jenis');

        return match ($jenis) {
            'fitrah'   => $this->hitungFitrah($request),
            'profesi'  => $this->hitungProfesi($request),
            'maal'     => $this->hitungMaal($request),
            'emas'     => $this->hitungEmas($request),
            default    => response()->json(['error' => 'Jenis zakat tidak dikenal.'], 422),
        };
    }

    // ── Zakat Fitrah ──────────────────────────────────────────
    private function hitungFitrah(Request $request)
    {
        $request->validate([
            'jiwa'       => 'required|integer|min:1',
            'harga_beras' => 'required|numeric|min:1000',
        ]);

        $jiwa   = (int) $request->jiwa;
        $harga  = (float) $request->harga_beras;
        $perJiwa = 2.5 * $harga;
        $total  = $jiwa * $perJiwa;

        return response()->json([
            'jenis'    => 'fitrah',
            'total'    => $total,
            'per_jiwa' => $perJiwa,
            'jiwa'     => $jiwa,
            'wajib'    => true,
            'keterangan' => "Zakat fitrah untuk {$jiwa} jiwa dengan harga beras Rp " . number_format($harga, 0, ',', '.') . '/kg.',
        ]);
    }

    // ── Zakat Profesi ─────────────────────────────────────────
    private function hitungProfesi(Request $request)
    {
        $request->validate([
            'gaji'   => 'required|numeric|min:0',
            'lain'   => 'nullable|numeric|min:0',
            'hutang' => 'nullable|numeric|min:0',
            'metode' => 'required|in:kotor,bersih',
        ]);

        $gaji   = (float) $request->gaji;
        $lain   = (float) ($request->lain   ?? 0);
        $hutang = (float) ($request->hutang ?? 0);
        $total  = $gaji + $lain;
        $dasar  = $request->metode === 'kotor'
                    ? $total
                    : max(0, $total - $hutang);

        $wajib  = $dasar >= self::NISAB_PROFESI_RP;
        $zakat  = $wajib ? $dasar * self::KADAR_ZAKAT : 0;

        return response()->json([
            'jenis'          => 'profesi',
            'total'          => $zakat,
            'total_penghasilan' => $total,
            'dasar_hitung'   => $dasar,
            'nisab'          => self::NISAB_PROFESI_RP,
            'wajib'          => $wajib,
            'keterangan'     => $wajib
                ? "Penghasilan Anda melebihi nisab. Wajib zakat profesi 2,5%."
                : "Penghasilan Anda belum mencapai nisab (Rp " . number_format(self::NISAB_PROFESI_RP, 0, ',', '.') . "/bulan).",
        ]);
    }

    // ── Zakat Maal ────────────────────────────────────────────
    private function hitungMaal(Request $request)
    {
        $request->validate([
            'tabungan'  => 'nullable|numeric|min:0',
            'piutang'   => 'nullable|numeric|min:0',
            'investasi' => 'nullable|numeric|min:0',
            'hutang'    => 'nullable|numeric|min:0',
        ]);

        $tab    = (float) ($request->tabungan  ?? 0);
        $piu    = (float) ($request->piutang   ?? 0);
        $inv    = (float) ($request->investasi ?? 0);
        $hut    = (float) ($request->hutang    ?? 0);
        $bersih = max(0, $tab + $piu + $inv - $hut);

        $wajib  = $bersih >= self::NISAB_MAAL_RP;
        $zakat  = $wajib ? $bersih * self::KADAR_ZAKAT : 0;

        return response()->json([
            'jenis'       => 'maal',
            'total'       => $zakat,
            'harta_bersih' => $bersih,
            'nisab'       => self::NISAB_MAAL_RP,
            'wajib'       => $wajib,
            'keterangan'  => $wajib
                ? "Harta bersih Anda melebihi nisab. Wajib zakat maal 2,5% per tahun."
                : "Harta bersih Anda belum mencapai nisab zakat maal.",
        ]);
    }

    // ── Zakat Emas / Perak ────────────────────────────────────
    private function hitungEmas(Request $request)
    {
        $request->validate([
            'jenis_logam' => 'required|in:emas,perak',
            'berat'       => 'required|numeric|min:0',
            'harga_gram'  => 'required|numeric|min:1000',
        ]);

        $jenisLogam  = $request->jenis_logam;
        $berat       = (float) $request->berat;
        $hargaGram   = (float) $request->harga_gram;
        $nisabGram   = $jenisLogam === 'emas' ? self::NISAB_EMAS_GRAM : self::NISAB_PERAK_GRAM;
        $nilai       = $berat * $hargaGram;
        $nisabRp     = $nisabGram * $hargaGram;

        $wajib       = $berat >= $nisabGram;
        $zakat       = $wajib ? $nilai * self::KADAR_ZAKAT : 0;

        return response()->json([
            'jenis'       => 'emas',
            'jenis_logam' => $jenisLogam,
            'total'       => $zakat,
            'nilai_total' => $nilai,
            'nisab_gram'  => $nisabGram,
            'nisab_rp'    => $nisabRp,
            'wajib'       => $wajib,
            'keterangan'  => $wajib
                ? "Kepemilikan {$jenisLogam} Anda ({$berat} gram) telah mencapai nisab. Wajib zakat 2,5%."
                : "Kepemilikan {$jenisLogam} Anda belum mencapai nisab ({$nisabGram} gram).",
        ]);
    }

    // ─────────────────────────────────────────────────────────
    // PEMBAYARAN ZAKAT
    // ─────────────────────────────────────────────────────────

    /**
     * POST /zakat/store
     * Menyimpan transaksi zakat ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'        => 'required|string|max:100',
            'kontak'      => 'required|string|max:100',
            'jenis_zakat' => 'required|in:fitrah,profesi,maal,emas,perdagangan',
            'nominal'     => 'required|numeric|min:1000',
            'laz'         => 'nullable|string|max:100',
            'metode_bayar'=> 'nullable|in:transfer,ewallet,qris,va',
        ]);

        try {
            DB::beginTransaction();

            $payment = ZakatPayment::create([
                'kode_transaksi' => 'ZKT-' . strtoupper(Str::random(8)),
                'nama'           => $validated['nama'],
                'kontak'         => $validated['kontak'],
                'jenis_zakat'    => $validated['jenis_zakat'],
                'nominal'        => $validated['nominal'],
                'laz'            => $validated['laz'] ?? 'BAZNAS',
                'metode_bayar'   => $validated['metode_bayar'] ?? 'transfer',
                'status'         => 'pending',
                'disalurkan'     => false,
            ]);

            // TODO: integrasikan payment gateway (Midtrans, Xendit, dll.)
            // $snapToken = $this->createMidtransToken($payment);

            DB::commit();

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success'        => true,
                    'kode_transaksi' => $payment->kode_transaksi,
                    'nominal'        => $payment->nominal,
                    'message'        => 'Pembayaran zakat berhasil diterima.',
                ]);
            }

            return redirect()->route('zakat.index')
                ->with('success', "Terima kasih {$payment->nama}! Zakat Anda sebesar Rp " . number_format($payment->nominal, 0, ',', '.') . " sedang diproses.");

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('ZakatController@store: ' . $e->getMessage());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Terjadi kesalahan. Silakan coba lagi.'], 500);
            }

            return back()->withInput()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    // ─────────────────────────────────────────────────────────
    // RIWAYAT PEMBAYARAN
    // ─────────────────────────────────────────────────────────

    /**
     * GET /zakat/riwayat
     * Menampilkan riwayat zakat berdasarkan nomor HP / email.
     */
    public function riwayat(Request $request)
    {
        $request->validate(['kontak' => 'nullable|string|max:100']);

        $kontak    = $request->input('kontak');
        $riwayat   = collect();

        if ($kontak) {
            $riwayat = ZakatPayment::where('kontak', $kontak)
                ->orderByDesc('created_at')
                ->paginate(10);
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json($riwayat);
        }

        return view('zakat.riwayat', compact('riwayat', 'kontak'));
    }

    // ─────────────────────────────────────────────────────────
    // WEBHOOK / CALLBACK PAYMENT GATEWAY (opsional)
    // ─────────────────────────────────────────────────────────

    /**
     * POST /zakat/callback
     * Menerima notifikasi status dari payment gateway.
     */
    public function callback(Request $request)
    {
        // Contoh untuk Midtrans — sesuaikan dengan gateway yang dipakai
        $serverKey     = config('midtrans.server_key');
        $orderId       = $request->input('order_id');
        $statusCode    = $request->input('status_code');
        $grossAmount   = $request->input('gross_amount');
        $signatureKey  = $request->input('signature_key');

        // Verifikasi signature
        $expected = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        if ($expected !== $signatureKey) {
            Log::warning('Zakat callback: signature tidak valid untuk order ' . $orderId);
            return response()->json(['message' => 'Invalid signature.'], 403);
        }

        $payment = ZakatPayment::where('kode_transaksi', $orderId)->first();

        if (! $payment) {
            return response()->json(['message' => 'Transaksi tidak ditemukan.'], 404);
        }

        $transactionStatus = $request->input('transaction_status');

        $payment->status = match ($transactionStatus) {
            'settlement', 'capture' => 'success',
            'pending'               => 'pending',
            'deny', 'cancel', 'expire' => 'failed',
            default                 => $payment->status,
        };

        $payment->save();

        Log::info("Zakat callback: {$orderId} → {$payment->status}");

        return response()->json(['message' => 'OK']);
    }

    // ─────────────────────────────────────────────────────────
    // ADMIN — DAFTAR & UPDATE STATUS (opsional)
    // ─────────────────────────────────────────────────────────

    /**
     * GET /admin/zakat
     * Daftar semua transaksi zakat (untuk admin).
     */
    public function adminIndex(Request $request)
    {
        $payments = ZakatPayment::query()
            ->when($request->status,      fn($q) => $q->where('status', $request->status))
            ->when($request->jenis_zakat, fn($q) => $q->where('jenis_zakat', $request->jenis_zakat))
            ->when($request->search,      fn($q) => $q->where(function ($q2) use ($request) {
                $q2->where('nama', 'like', "%{$request->search}%")
                   ->orWhere('kontak', 'like', "%{$request->search}%")
                   ->orWhere('kode_transaksi', 'like', "%{$request->search}%");
            }))
            ->orderByDesc('created_at')
            ->paginate(20)
            ->withQueryString();

        $summary = [
            'total_nominal'  => ZakatPayment::where('status', 'success')->sum('nominal'),
            'total_transaksi' => ZakatPayment::where('status', 'success')->count(),
            'pending'        => ZakatPayment::where('status', 'pending')->count(),
        ];

        return view('admin.zakat.index', compact('payments', 'summary'));
    }

    /**
     * PATCH /admin/zakat/{id}/status
     * Update status transaksi (manual oleh admin).
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:pending,success,failed']);

        $payment = ZakatPayment::findOrFail($id);
        $payment->update(['status' => $request->status]);

        return back()->with('success', "Status transaksi {$payment->kode_transaksi} diperbarui.");
    }

    /**
     * PATCH /admin/zakat/{id}/salurkan
     * Tandai zakat sudah disalurkan ke mustahiq.
     */
    public function salurkan($id)
    {
        $payment = ZakatPayment::findOrFail($id);

        if ($payment->status !== 'success') {
            return back()->with('error', 'Hanya transaksi sukses yang dapat ditandai tersalurkan.');
        }

        $payment->update([
            'disalurkan'    => true,
            'disalurkan_at' => now(),
        ]);

        return back()->with('success', "Zakat {$payment->kode_transaksi} telah ditandai tersalurkan.");
    }
}