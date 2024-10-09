<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'classes';

    // Kolom-kolom yang bisa diisi
    protected $fillable = ['name'];

    // Relasi ke model ClassUser
    public function classUsers()
    {
        return $this->hasMany(ClassUser::class, 'class_id');
    }
}
