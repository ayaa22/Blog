<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;

class BlogController extends Controller
{
    public function getSingle($slug) {
    	
    	$post  = Post::find($slug);
    	return view('blog.single')->withPost($post);
    }

    public function getIndex() {
    	
    	$posts  = Post::paginate(2);
    	
    	return view('blog.index')->withPosts($posts);
    }
}
