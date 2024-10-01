<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    // Kolom yang dapat diisi
    protected $fillable = ['judul', 'deskripsi', 'gambar', 'published_at'];

    protected $dates = ['published_at'];
}
