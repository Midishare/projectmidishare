<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videocopfresh extends Model
{
    use HasFactory;

    protected $table = 'videocopfresh';

    protected $fillable = ['title', 'video_link', 'image_path'];
}
