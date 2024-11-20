<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumenino extends Model
{
    use HasFactory;

    protected $table = 'dokumenino';
    protected $fillable = [
        'title',
        'image_path',
        'link',
        'category'
    ];
}
