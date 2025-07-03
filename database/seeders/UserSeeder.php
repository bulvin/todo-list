<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'User 1',
            'email' => 'a@b.pl',
            'password' => Hash::make('1234'),
        ]);


        User::factory()->create([
            'name' => 'User 2',
            'email' => 'a@c.pl',
            'password' => Hash::make('1234'),
        ]);

    }
}
