<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class TechnicienSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Technicien Name',
            'email' => 'technicien@example.com',
            'password' => bcrypt('password123'),
            'role' => 'technicien'
        ]);
    }
}
