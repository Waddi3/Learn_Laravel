<?php

namespace Database\Factories;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\BlogPost;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Comment::class;
    public function definition(): array
    {
        return [
            'content' => $this->faker->text,
            'blog_post_id' => BlogPost::factory(), // إنشاء منشور مدونة وربطه مع التعليق
        ];
    }
}

// $factory->define(Comment::class, function(Faker $faker){
// return[
//     'content'=> $faker->text,
// ];
// });
