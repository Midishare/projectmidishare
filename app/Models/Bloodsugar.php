<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bloodsugar extends Model
{
    protected $table = 'blood_sugars';

    protected $fillable = [
        'user_id',
        'blood_sugar_level',
        'condition',
        'result_status',
        'result_level',
        'result_risk',
        'checked_at'
    ];

    protected $casts = [
        'checked_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
