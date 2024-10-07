<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoIkt extends Model
{
    use HasFactory;

    protected $table = 'video_ikt';

    protected $fillable = ['title', 'video_link'];
}
