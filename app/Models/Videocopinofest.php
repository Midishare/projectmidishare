<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videocopinofest extends Model
{
    use HasFactory;

    protected $table = 'videocopinofest';

    protected $fillable = ['title', 'video_link', 'image_path'];
}
