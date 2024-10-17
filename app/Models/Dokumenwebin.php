<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumenwebin extends Model
{
    use HasFactory;

    protected $table = 'dokumenwebin'; // Nama tabel
    protected $fillable = [
        'title',
        'image_path',
        'link',
    ];
}
