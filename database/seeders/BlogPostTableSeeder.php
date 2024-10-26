<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlogPost;
use App\Models\User;
class BlogPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogCount = (int)$this->command->ask('How many blog posts would you like', 10);

        $users = User::all();

        BlogPost::factory($blogCount)->create();
    }
}
