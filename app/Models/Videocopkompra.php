<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videocopkompra extends Model
{
    use HasFactory;

    protected $table = 'videokompra';

    protected $fillable = ['title', 'video_link', 'image_path'];
}
