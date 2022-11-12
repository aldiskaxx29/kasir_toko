<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'nama'	=> 'aldi',
            'username'	=> 'aldi',
            'password'	=> bcrypt('123456'),
            'role_user' => 1, // kasir
            'status' => 1,
            'foto' => 'default.png'
        ]);

        \App\Models\User::create([
            'nama'	=> 'aldo',
            'username'	=> 'aldo',
            'password'	=> bcrypt('123456'),
            'role_user' => 2, // kepala toko
            'status' => 1,
            'foto' => 'default.png'
        ]);
    }
}
