<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testHomePageIsWorkingCorrectly(): void
    {
        $response = $this->get('/');

        $response->assertSeeText('Welcome to laravel!');
        $response->assertSeeText('This is the content of the main page');  
    }

    public function testContactPageIsWorkingCorrectly(): void
    {
        $response = $this->get('/contact');
        $response->assertSeeText('Contact page');
        $response->assertSeeText('Hello this is content');
    }
}
