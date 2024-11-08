<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuPintarWh extends Model
{
    use HasFactory;

    protected $table = 'slidebukupintarwh';

    protected $fillable = [
        'title',
        'file_paths', // use 'file_paths' to store multiple paths
    ];

    protected $casts = [
        'file_paths' => 'array', // casting to array
    ];
}
