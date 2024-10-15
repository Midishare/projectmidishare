<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumenmdp extends Model
{
    protected $table = 'dokumenmdp'; // Explicitly define the table name
    use HasFactory;

    protected $fillable = [
        'title',
        'image_path',
        'link',
        'category',
    ];
}
