<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Cache;
use Database\Seeders\TagsTableSeeder;
use Database\Seeders\BlogPostTagTableSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        if($this->command->confirm('Do you want to refresh the detabase')){
            $this->command->call('migrate:refresh');
            $this->command->info('Database was refreshed');
        }

        Cache::tags(['blog-post'])->flush();

        $this->call([
            UsersTableSeeder::class,
            BlogPostTableSeeder::class,
            CommentsTableSeeder::class,
            TagsTableSeeder::class,
            BlogPostTagTableSeeder::class,
    ]);
       // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        


       
        
        
    }
}
