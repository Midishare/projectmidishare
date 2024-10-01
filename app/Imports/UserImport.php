<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UserImport implements ToModel
{
    public function model(array $row)
    {
        return new User([
            'name' => $row[0], // Sesuaikan dengan index kolom yang sesuai dalam file CSV
            'nik' =>  $row[1], // Sesuaikan dengan index kolom yang sesuai dalam file CSV
            'password' => $row[2], // Gunakan Hash::make() untuk mengenkripsi password
            'lokasi' => $row[3],
            'branch' => $row[4],
        ]);
    }
}
