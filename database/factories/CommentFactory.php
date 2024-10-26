<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BlogPost;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'content' => $this->faker->text,
            'created_at'=> $this->faker->dateTimeBetween('-3 months'),
            // هنا لا نستخدم blog_post_id مباشرة، بل يجب تعريف العلاقة polymorphic
            // 'commentable_id' و 'commentable_type' سيتم تعريفها في الـ seeder 
        ];
    }
}
