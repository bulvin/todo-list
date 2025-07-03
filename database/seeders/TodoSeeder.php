<?php

namespace Database\Seeders;

use App\Models\Todos\Todo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->warn('No users found. Please run UserSeeder first.');
            return;
        }

        $users->each(function (User $user) {
            Todo::factory(rand(5, 15))->create(['user_id' => $user['id']]);
        });

        $this->command->info('Todo seeder completed successfully!');
        $this->command->info('Demo user credentials: a@b.pl / 1234');
    }
}
