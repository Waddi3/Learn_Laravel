<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Comment;



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

    public function testSeeBlogPostWhenThereIs1WithNoComments()
    {
        //Arrange
        $post = $this->createDummyBlogPost();
        //Act
        $response = $this->get('/posts');
        //Assert
        $response->assertSeeText('New title');
        $response->assertSeeText('No comments yet!');

        $this->assertDatabaseHas('blog_posts', ['title'=>'New title']);
    }

    public function testSee1BlogPostWithComments()
    {
        $post = $this->createDummyBlogPost();
        Comment::factory()->count(4)->create([
            'blog_post_id' => $post->id,
        ]);

        $response = $this->get('/posts');
        
        $response->assertSeeText('4 comments');
    }

    public function testStoreValid()
    {
        $params = [
            'title' =>'valid Title',
            'content'=> 'At least 10 characters'
        ];
        $this->post('/posts', $params)
        ->assertStatus(302)
        ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'The blog post was created');
    }
    public function testStoreFail()
    {
        $params = [
            'title' => 'x',
            'content' => 'x'
        ];
        $this->post('/posts', $params)
        ->assertStatus(302)
        ->assertSessionHas('errors');

        $messages = session('errors')->getMessages();

        $this->assertEquals($messages['title'][0],'The title field must be at least 5 characters.');
        $this->assertEquals($messages['content'][0],'The content field must be at least 10 characters.');
        
        
    }
    public function testUpdateValid()
{
    $post = $this->createDummyBlogPost();
    //$this->assertDatabaseHas('blog_posts', $post->toArray());
    $this->assertDatabaseHas('blog_posts', [
        'title' => 'New title',
        'content' => 'Content of the blog post',
        'id' => 1
    ]);

    $params = [
        'title' => 'A new named title',
        'content' => 'Content was changed'
    ];
    $this->put("/posts/{$post->id}", $params)
    ->assertStatus(302)
    ->assertSessionHas('status');

    $this->assertEquals(session('status'), 'The blog post was updated');
    $this->assertDatabaseMissing('blog_posts', $post->toArray());
    $this->assertDatabaseHas('blog_posts',[
        'title' => 'A new named title'
    ]);
}

private function createDummyBlogPost(): BlogPost 
{
    // $post = new BlogPost();
    // $post->title = 'New title';
    // $post->content = 'Content of the blog post';
    // $post->save();
    // return $post;
    return BlogPost::factory()->NewTitle()->create();
}
}
