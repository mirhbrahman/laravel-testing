<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index($id)
    {
    	$post = Post::findOrFail($id);
    	return view('post')->withPost($post);
    }

    public function showAllPost()
    {
    	return view('posts')->withPosts(Post::all());
    }

    public function storePost(Request $request)
    {
    	$this->validate($request, [
    		'title' => 'required',
    		'body' => 'required'
    	]);

    	$post = Post::create([
    		'title' => $request->title,
    		'body' => $request->body
    	]);
    }
}
