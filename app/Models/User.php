<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nik',
        'lokasi',
        'branch',
        'jabatan',
        'class',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }
    public function modChecklists()
    {
        return $this->hasOne(UserModChecklist::class);
    }

    public function gapknowledge()
    {
        return $this->hasOne(UserGapKnowledgeChecklist::class);
    }
    public function rekomendasiBelajar()
    {
        return $this->hasMany(RekomendasiBelajar::class, 'user_id');
    }
    public function unstructedlearningchecklist()
    {
        return $this->hasOne(UserUnstructedLearning::class);
    }
}
