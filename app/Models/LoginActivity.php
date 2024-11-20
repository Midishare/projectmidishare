<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginActivity extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'ip_address',
        'device',
        'browser',
        'location',
        'status',
        'login_at',
        'logout_at',
        'duration_minutes',
        'is_active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeCurrentlyActive($query)
    {
        return $query->where('status', 'login')
            ->where('is_active', true)
            ->where('login_at', '>=', now()->subHours(2));
    }
}
