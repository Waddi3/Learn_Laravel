<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Database\Factories\UserFactory;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usersCount = max((int)$this->command->ask('How many users would you like', 5), 1);

        User::factory()->NewUser()->create();

        User::factory($usersCount)->create();
 
        
    }
}
