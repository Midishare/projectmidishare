<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UricAcid extends Model
{
    protected $table = 'uric_acids';

    protected $fillable = [
        'user_id',
        'uric_acid_level',
        'gender',
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
