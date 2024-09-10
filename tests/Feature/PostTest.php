<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class PostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/posts/create');
        $response->assertSeeText('Title');
    }

    public function testSeeBlogPostWhenThereIs1()
    {
        //Arrange
        $post = new BlogPost();
        $post->title = 'New title';
        $post->content = 'Content of the blog post';
        $post->save();
        //Act
        $response = $this->get('/posts');
        //Assert
        $response->assertSeeText('New title');
        $this->assertDatabaseHas('blog_posts', ['title'=>'New title']);
    }
}
