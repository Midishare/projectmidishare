<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coptrahou extends Model
{
    use HasFactory;

    protected $table = 'coptrahou';
    protected $fillable = [
        'title',
        'image_path',
        'link',
    ];
}
