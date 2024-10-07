<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoFinlit extends Model
{
    use HasFactory;

    protected $table = 'video_finlit';

    protected $fillable = ['title', 'video_link'];
}
