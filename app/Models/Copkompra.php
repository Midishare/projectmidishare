<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Copkompra extends Model
{
    use HasFactory;

    protected $table = 'kompra';
    protected $fillable = [
        'title',
        'image_path',
        'link',
    ];
}
