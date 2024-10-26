<?php

namespace Database\Factories;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
class BlogPostFactory extends Factory
{
    protected $model = BlogPost::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(10),
            'content' => $this->faker->paragraph(5 , true),
            'created_at'=> $this->faker->dateTimeBetween('-3 monthes'),
             'user_id'=>User::factory(),
             'created_at'=> now(),
             'updated_at'=> now(),
            // أضف الحقول الأخرى التي تريدها في الـBlogPost
        ];
    }
    public function NewTitle()
    {
        return $this->state(fn(array $attributes)=>[
            'title'=>'New title',
        ]);
    }
}

