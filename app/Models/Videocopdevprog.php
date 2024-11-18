<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videocopdevprog extends Model
{
    use HasFactory;

    protected $table = 'videocopdevprog';

    protected $fillable = ['title', 'video_link', 'image_path'];
}
