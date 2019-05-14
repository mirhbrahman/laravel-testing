<?php

namespace Tests\Feature;

use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ViewAllBlogPostTest extends TestCase
{
    use DatabaseMigrations;
    /**
    *@group posts
    */
    public function testCanViewAllBlogPost()
    {
        // Arrange
        $post1 = factory(Post::class)->create();
        $post2 = factory(Post::class)->create();

        // Action
        $res = $this->get('/posts');

        // Assert
        $res->assertStatus(200);
        $res->assertSee($post1->title);
        $res->assertSee($post2->title);
        $res->assertSee(str_limit($post1->body));
        $res->assertSee(str_limit($post2->body));
    }
}
