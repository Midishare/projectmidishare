<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumendp extends Model
{
    use HasFactory;

    protected $table = 'dokumendp';
    protected $fillable = [
        'title',
        'image_path',
        'link',
        'category',
    ];
}
