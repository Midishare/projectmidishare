<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Belajarmandiri extends Model
{
    use HasFactory;

    protected $table = 'belajarmandiri';

    // Kolom yang dapat diisi
    protected $fillable = ['judul', 'deskripsi', 'gambar', 'published_at'];

    protected $dates = ['published_at'];
}
