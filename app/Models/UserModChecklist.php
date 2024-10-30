<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModChecklist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'existing_grade_genap',
        'ip',
        'existing_grade_ganjil',
        'mdp'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
