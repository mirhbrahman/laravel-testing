<?php

namespace Tests\Feature;

use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ViewABlogPostTest extends TestCase
{
    use DatabaseMigrations;

    public function testCanViewABlogPost()
    {
        // Arrangement
        // create a blog post
        $post = factory(Post::class)->create();

        // Action
        // visition a route
        $res = $this->get("/post/{$post->id}");

        // Assert
        // assert status code 200
        $res->assertStatus(200);
        // assert that we see post title
        $res->assertSee($post->title);
        // assert that we see post body
        $res->assertSee($post->body);
        // assert that we see publication date
        $res->assertSee($post->created_at);
    }

    /**
    * @group post-not-found
    */

    public function testViewA404PageIfPostNotFound()
    {
        // Action
        try{
        $res = $this->get("/post/INVALID_ID");

        }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $ex){
            abort(404, 'Page not found');
        }
        // Assert
        $res->assertStatus(404);
        $res->assertSee('The page you are looking for could not be found!');
    }
}
