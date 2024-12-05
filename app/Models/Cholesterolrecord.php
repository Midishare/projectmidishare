<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CholesterolRecord extends Model
{
    protected $table = 'cholesterol_records';

    protected $fillable = [
        'user_id',
        'total_cholesterol',
        'ldl_cholesterol',
        'hdl_cholesterol',
        'triglycerides',
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
