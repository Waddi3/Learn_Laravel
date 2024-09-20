<?php

namespace Database\Factories;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostFactory extends Factory
{
    protected $model = BlogPost::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(10),
            'content' => $this->faker->paragraph(5 , true),
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

