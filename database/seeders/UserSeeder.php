<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Import class Hash untuk melakukan hashing password
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        // Buat user admin
        $admin = User::create([
            'name' => 'Admin User',
            'nik' => 'Midishareadmin99777', // NIK disimpan sebagai string
            'password' => 'M1d1s4har3@', // Gunakan Hash::make() untuk mengenkripsi password
            'lokasi' => 'HO',
            'branch' => 'Head office',
        ]);
        $adminRole = Role::where('name', 'admin')->first();
        $admin->assignRole($adminRole);


        // Buat 10 user dengan role user
        for ($i = 1; $i <= 10; $i++) {
            $user = User::create([
                'name' => 'User ' . $i,
                'nik' => '100000000' . $i, // NIK disimpan sebagai string
                'password' => 'password', // Gunakan Hash::make() untuk mengenkripsi password
                'lokasi' => 'HO',
                'branch' => 'Head office',
            ]);

            $userRole = Role::where('name', 'user')->first();
            $user->assignRole($userRole);
        }
    }
}
