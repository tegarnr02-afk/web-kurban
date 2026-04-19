<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DonasiController extends Controller
{
    /**
     * Halaman daftar semua campaign donasi
     */
    public function index()
    {
        return view('donasi.index');
    }

    /**
     * Halaman form donasi Qurban
     */
    public function qurban()
    {
        return view('donasi.qurban');
    }

    /**
     * Proses submit form Qurban
     */
    public function storeQurban(Request $request)
    {
        $validated = $request->validate([
            'sapaan'        => 'nullable|string|max:20',
            'nama_donatur'  => 'required_unless:sembunyikan_nama,1|nullable|string|max:100',
            'no_whatsapp'   => 'required|string|max:20',
            'doa'           => 'nullable|string|max:500',
            'hewan_id'      => 'required|integer|min:0|max:3',
            'jumlah_hewan'  => 'required|integer|min:1|max:99',
            'metode_bayar'  => 'required|in:qris,gopay,ovo,bca,bsi,mandiri',
            'sembunyikan_nama' => 'nullable|boolean',
        ]);

        // Harga per hewan
        $hargaList = [1399000, 2500000, 3500000, 24500000];
        $namaHewan = ['Kambing Afrika', 'Domba Garut', 'Sapi 1/7 Bagian', 'Sapi Utuh'];

        $harga       = $hargaList[$validated['hewan_id']];
        $totalBayar  = $harga * $validated['jumlah_hewan'];
        $kodeTransaksi = 'BKH-QRB-' . strtoupper(Str::random(8));

        // Simpan ke database (aktifkan jika model Donasi sudah dibuat)
        /*
        \App\Models\Donasi::create([
            'campaign_id'      => 1, // ID campaign qurban
            'hewan_qurban_id'  => $validated['hewan_id'] + 1,
            'sapaan'           => $validated['sapaan'] ?? 'Kak',
            'nama_donatur'     => $validated['sembunyikan_nama'] ? 'Orang Baik' : $validated['nama_donatur'],
            'no_whatsapp'      => $validated['no_whatsapp'],
            'doa'              => $validated['doa'],
            'jumlah_hewan'     => $validated['jumlah_hewan'],
            'total_bayar'      => $totalBayar,
            'metode_bayar'     => $validated['metode_bayar'],
            'status_bayar'     => 'pending',
            'kode_transaksi'   => $kodeTransaksi,
            'sembunyikan_nama' => $validated['sembunyikan_nama'] ?? false,
        ]);
        */

        // Redirect ke halaman sukses dengan data session
        session([
            'donasi_sukses' => [
                'kode'        => $kodeTransaksi,
                'hewan'       => $namaHewan[$validated['hewan_id']],
                'jumlah'      => $validated['jumlah_hewan'],
                'nama'        => $validated['sembunyikan_nama'] ? 'Orang Baik' : $validated['nama_donatur'],
                'total'       => $totalBayar,
                'metode_bayar'=> $validated['metode_bayar'],
                'wa'          => $validated['no_whatsapp'],
            ]
        ]);

        return redirect()->route('donasi.sukses', $kodeTransaksi);
    }

    /**
     * Halaman donasi Palestina
     */
    public function palestina()
    {
        return view('donasi.palestina');
    }

    /**
     * Halaman donasi Beasiswa
     */
    public function beasiswa()
    {
        return view('donasi.beasiswa');
    }

    /**
     * Halaman sukses setelah donasi
     */
    public function sukses($kode)
    {
        $data = session('donasi_sukses');

        // Jika tidak ada session (akses langsung), redirect ke beranda
        if (!$data || $data['kode'] !== $kode) {
            return redirect()->route('home');
        }

        return view('donasi.sukses', compact('data'));
    }
}

