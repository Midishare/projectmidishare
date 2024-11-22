<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bukupintarwh extends Model
{
    use HasFactory;

    protected $table = 'slidebukupintarwh';

    protected $fillable = [
        'title',
        'file_paths',
    ];

    protected $casts = [
        'file_paths' => 'array',
    ];
}
