<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoWebin extends Model
{
    use HasFactory;

    protected $table = 'video_webin';

    protected $fillable = ['title', 'video_link'];
}
