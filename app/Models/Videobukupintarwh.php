<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videobukupintarwh extends Model
{
    use HasFactory;

    protected $table = 'videobukupintarwh';

    protected $fillable = ['title', 'video_link', 'image_path'];
}
