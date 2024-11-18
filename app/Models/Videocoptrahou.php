<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videocoptrahou extends Model
{
    use HasFactory;

    protected $table = 'videocoptrahou';

    protected $fillable = ['title', 'video_link', 'image_path'];
}
