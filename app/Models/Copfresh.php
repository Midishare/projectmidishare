<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Copfresh extends Model
{
    use HasFactory;

    protected $table = 'copfresh';
    protected $fillable = [
        'title',
        'image_path',
        'link',
    ];
}
