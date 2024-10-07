<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumenikt extends Model
{
    use HasFactory;

    protected $table = 'dokumenikt'; // Nama tabel
    protected $fillable = [
        'title',
        'image_path',
        'link',
    ];
}
