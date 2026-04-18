<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZakatPayment extends Model
{
    use HasFactory;

    protected $table = 'zakat_payments';

    protected $fillable = [
        'kode_transaksi',
        'nama',
        'kontak',
        'jenis_zakat',
        'nominal',
        'laz',
        'metode_bayar',
        'status',
        'disalurkan',
        'disalurkan_at',
    ];

    protected $casts = [
        'nominal'       => 'float',
        'disalurkan'    => 'boolean',
        'disalurkan_at' => 'datetime',
    ];

    // ── Scopes ────────────────────────────────────────────────

    public function scopeSuccess($query)
    {
        return $query->where('status', 'success');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeBelumDisalurkan($query)
    {
        return $query->where('disalurkan', false)->where('status', 'success');
    }

    // ── Accessors ─────────────────────────────────────────────

    public function getNominalFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->nominal, 0, ',', '.');
    }

    public function getJenisLabelAttribute(): string
    {
        return match ($this->jenis_zakat) {
            'fitrah'      => 'Zakat Fitrah',
            'profesi'     => 'Zakat Profesi',
            'maal'        => 'Zakat Maal',
            'emas'        => 'Zakat Emas/Perak',
            'perdagangan' => 'Zakat Perdagangan',
            default       => ucfirst($this->jenis_zakat),
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'success' => 'Sukses',
            'pending' => 'Menunggu',
            'failed'  => 'Gagal',
            default   => $this->status,
        };
    }
}