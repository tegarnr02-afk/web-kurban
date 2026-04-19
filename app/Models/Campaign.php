<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Campaign extends Model
{
    protected $guarded = [];
    
    // relasi ke lembaga (sesuaikan nama method-nya)
    public function lembaga()
    {
        return $this->belongsTo(Lembaga::class); // atau sesuai nama model Lembaga-mu
    }
}