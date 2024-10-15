<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoIp extends Model
{
    protected $table = 'video_ip';
    use HasFactory;

    protected $fillable = [
        'title',
        'video_link',
        'category',
    ];
}
