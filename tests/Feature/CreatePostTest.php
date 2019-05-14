<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreatePostTest extends TestCase
{
    use DatabaseMigrations;

    /**
    *@group create-post
    */

    public function testCanCreatePost()
    {
        // Arrange
        // Action
        $res = $this->post('/store-post',[
            'title' => 'A simple title',
            'body' => 'A simple body'
        ]);
        // Assert
        $this->assertDatabaseHas('posts', [
            'title' => 'A simple title',
            'body' => 'A simple body'
        ]);

        $post = \App\Post::find(1);
        $this->assertEquals('A simple title', $post->title);
        $this->assertEquals('A simple body', $post->body);
    }



    /**
    *@group title-required
    */

    public function testTitleIsRequiredWhenCretePost()
    {
        // Arrange
        // Action
        $res = $this->post('/store-post',[
            'title' => null,
            'body' => 'A simple body'
        ]);
        // Assert

        $res->assertSessionHasErrors('title');
    }

    /**
    *@group body-required
    */

    public function testBodyIsRequiredWhenCretePost()
    {
        // Arrange
        // Action
        $res = $this->post('/store-post',[
            'title' => 'A siple test',
            'body' => null
        ]);
        // Assert
        $res->assertSessionHasErrors('body');
    }
}
