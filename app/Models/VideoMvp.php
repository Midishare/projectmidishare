<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoMvp extends Model
{
    use HasFactory;

    protected $table = 'video_mvp';

    protected $fillable = ['title', 'video_link'];
}
