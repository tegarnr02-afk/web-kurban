<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Lembaga;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CampaignController extends Controller
{
    /* ─────────────────────────── INDEX ─────────────────────────── */

    public function index(Request $request): View
    {
        $query = Campaign::with('lembaga');

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->q . '%')
                  ->orWhereHas('lembaga', fn($l) => $l->where('nama', 'like', '%' . $request->q . '%'));
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('lembaga_id')) {
            $query->where('lembaga_id', $request->lembaga_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        match ($request->get('sort', 'newest')) {
            'target'  => $query->orderByDesc('target_dana'),
            default   => $query->orderByDesc('created_at'),
        };

        $campaigns = $query->paginate(8)->withQueryString();

        $stats = [
            'total'        => Campaign::count(),
            'aktif'        => Campaign::where('status', 'aktif')->count(),
            'draft'        => Campaign::where('status', 'draft')->count(),
            'selesai'      => Campaign::where('status', 'selesai')->count(),
            'ditangguhkan' => Campaign::where('status', 'ditangguhkan')->count(),
        ];

        $lembagas = Lembaga::all();

        return view('admin.campaigns.index', compact('campaigns', 'stats', 'lembagas'));
    }

    /* ─────────────────────────── CREATE ─────────────────────────── */

    public function create(): View
    {
        $lembagas = Lembaga::all();
        return view('admin.campaigns.create', compact('lembagas'));
    }

    /* ─────────────────────────── STORE ─────────────────────────── */

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul'                  => 'required|string|max:100',
            'kategori'               => 'required|in:qurban,darurat,pendidikan,kesehatan,zakat,masjid',
            'lembaga_id'             => 'nullable|exists:lembagas,id',
            'deskripsi'              => 'required|string|max:2000',
            'tags'                   => 'nullable|string',
            'target_dana'            => 'required|integer|min:1',
            'donasi_minimum'         => 'nullable|integer|min:0',
            'tanggal_mulai'          => 'required|date',
            'tanggal_berakhir'       => 'required|date|after_or_equal:tanggal_mulai',
            'tipe'                   => 'required|in:reguler,promo,darurat,wakaf',
            'thumbnail'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'url_video'              => 'nullable|url',
            'status'                 => 'required|in:aktif,draft,jadwal',
            'jadwal_tayang'          => 'nullable|date|required_if:status,jadwal',
            'tampil_beranda'         => 'nullable|boolean',
            'izin_anonim'            => 'nullable|boolean',
            'tampil_jumlah_donatur'  => 'nullable|boolean',
            'notif_email_lembaga'    => 'nullable|boolean',
        ], [
            'judul.required'              => 'Judul campaign wajib diisi.',
            'kategori.required'           => 'Kategori wajib dipilih.',
            'deskripsi.required'          => 'Deskripsi wajib diisi.',
            'target_dana.required'        => 'Target dana wajib diisi.',
            'tanggal_mulai.required'      => 'Tanggal mulai wajib diisi.',
            'tanggal_berakhir.required'   => 'Tanggal berakhir wajib diisi.',
            'tanggal_berakhir.after_or_equal' => 'Tanggal berakhir harus setelah tanggal mulai.',
            'tipe.required'               => 'Tipe campaign wajib dipilih.',
            'jadwal_tayang.required_if'   => 'Waktu tayang wajib diisi jika status "Jadwalkan".',
        ]);

        $validated['tags'] = $request->filled('tags')
            ? array_values(array_filter(array_map('trim', explode(',', $request->tags))))
            : [];

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')
                ->store('campaigns/thumbnails', 'public');
        }

        $validated['tampil_beranda']        = $request->boolean('tampil_beranda');
        $validated['izin_anonim']           = $request->boolean('izin_anonim');
        $validated['tampil_jumlah_donatur'] = $request->boolean('tampil_jumlah_donatur');
        $validated['notif_email_lembaga']   = $request->boolean('notif_email_lembaga');
        $validated['slug']                  = Str::slug($validated['judul']);

        Campaign::create($validated);

        return redirect()
            ->route('admin.campaigns.index')
            ->with('success', 'Campaign berhasil dipublikasikan!');
    }

    /* ─────────────────────────── DESTROY ─────────────────────────── */

    public function destroy(Campaign $campaign): RedirectResponse
    {
        $campaign->delete();
        return redirect()
            ->route('admin.campaigns.index')
            ->with('success', 'Campaign berhasil dihapus.');
    }

    /* ─────────────────────────── UPDATE STATUS ─────────────────────────── */

    public function updateStatus(Request $request, Campaign $campaign): RedirectResponse
    {
        $request->validate(['status' => 'required|in:aktif,draft,selesai,ditangguhkan']);
        $campaign->update(['status' => $request->status]);
        return back()->with('success', 'Status campaign berhasil diperbarui.');
    }
}