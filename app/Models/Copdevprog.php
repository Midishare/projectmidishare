<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Copdevprog extends Model
{
    use HasFactory;

    protected $table = 'copdeveprog';
    protected $fillable = [
        'title',
        'image_path',
        'link',
    ];
}
