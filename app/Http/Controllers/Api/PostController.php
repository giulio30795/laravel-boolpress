<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){

        $posts = Post::paginate(3);

        
        return response()->json($posts);
    }

    public function show($slug) {
        $post = Post::where('slug', $slug)->with('category', 'tags')->first();

        if(! $post){
            $post['not_found'];
        }

        elseif($post->cover){
            $post->cover = url('storage/' . $post->cover);

        }


        return response()->json($post);
    }
}
