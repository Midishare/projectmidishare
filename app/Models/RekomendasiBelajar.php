<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekomendasiBelajar extends Model
{
    use HasFactory;

    protected $table = 'rekomendasi_belajar';

    protected $fillable = ['user_id', 'rekomendasi'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function rekomendasiBelajar()
    {
        return $this->hasOne(RekomendasiBelajar::class);
    }
}
