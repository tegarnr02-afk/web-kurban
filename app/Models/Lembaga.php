<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lembaga extends Model
{
    protected $fillable = ['nama', 'slug', 'deskripsi'];

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }
}