<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassUser extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'class_users';

    // Kolom-kolom yang bisa diisi
    protected $fillable = ['user_id', 'class_id', 'added_by'];

    // Relasi ke model User (user yang mengikuti kelas)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke model Class
    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    // Relasi ke model User (admin yang menambahkan user ke kelas)
    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}
