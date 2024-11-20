<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenIp extends Model
{
    use HasFactory;
    protected $table = 'dokumenip';
    protected $fillable = [
        'title',
        'image_path',
        'link',
        'category',
    ];
}
