<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Copinofest extends Model
{
    use HasFactory;

    protected $table = 'copinofest';
    protected $fillable = [
        'title',
        'image_path',
        'link',
    ];
}
