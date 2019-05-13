<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index($id)
    {
    	$post = \App\Post::findOrFail($id);
    	return view('post')->withPost($post);
    }
}
