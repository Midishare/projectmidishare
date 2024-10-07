<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumenmvp extends Model
{
    use HasFactory;

    protected $table = 'dokumenmvp'; // Nama tabel
    protected $fillable = [
        'title',
        'image_path',
        'link',
    ];
}
