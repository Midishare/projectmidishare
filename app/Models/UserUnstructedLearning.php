<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserUnstructedLearning extends Model
{
    use HasFactory;

    protected $table = 'user_unstructed_learning_checklists';
    protected $fillable = [
        'user_id',
        'ks',
        'bs',
        'webinar',
        'sme',
        'leaderstalk',
        'onlinecourse',
        'cop',
        'podcast',
        'jurnal',
        'forumdiskusi'
    ];

    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
