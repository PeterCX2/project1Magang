<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin
        $superAdmin = User::factory()->create([
            'name' => 'Super',
            'email' => 'super@example.com',
        ]);

        $superAdmin->assignRole('super-admin');
    }
}
