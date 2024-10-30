<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGapKnowledgeChecklist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'OHK',
        'BPA',
        'MOM'
    ];

    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
