<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumenfinlit extends Model
{
    use HasFactory;

    protected $table = 'dokumenfinlit'; // Nama tabel
    protected $fillable = [
        'title',
        'image_path',
        'link',
    ];
}
