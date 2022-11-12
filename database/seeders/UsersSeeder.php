<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'nama' => 'lutfi',
            'email' => 'lutfi@gmail.com',
            'password' => bcrypt('123456'),
            'role_user' => 2,
            'status' => 1
        ]);
    }
}
