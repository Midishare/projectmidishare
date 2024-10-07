<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoIno extends Model
{
    use HasFactory;

    protected $table = 'video_ino';

    protected $fillable = ['title', 'video_link'];
}
