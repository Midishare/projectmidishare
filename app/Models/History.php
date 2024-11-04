<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'history';

    protected $fillable = ['user_id', 'history'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function history()
    {
        return $this->hasOne(History::class);
    }
}
