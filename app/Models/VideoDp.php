<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoDp extends Model
{
    use HasFactory;

    protected $table = 'video_dp';

    protected $fillable = ['title', 'link', 'category'];
}
