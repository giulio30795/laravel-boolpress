<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::all();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'title' => 'required|unique:posts|max:255',
            'body' => 'required|max:255',
            'category_id' => 'nullable|exists:categories,id'
        ]);

        // The blog post is valid...
        $data = $request->all();
        $new_post = new Post();

        $slug = Str::slug($data['title'], '-');
        $count = 1;
        $base_slug = $slug;

        while(Post::where('slug', $slug)->first()){
            $slug = $base_slug . '-' . $count;
            $count++;
        }

        $data['slug'] = $slug;

        $new_post->fill($data);
        $new_post->save();

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)

    {
        $post = Post::find($id);

        return view ('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        $data = $request->all();
        
        if( $post->title != $data['title']) {
            $slug = Str::slug($data['title'], '-');
            $count = 1;
            $base_slug = $slug;

        while(Post::where('slug', $slug)->first()){
            $slug = $base_slug . '-' . $count;
            $count++;
        }
        $data['slug'] = $slug;

        } else {
            $data['slug'] = $post->slug;

        }
        $post->update($data);

        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        
        $post->delete();

        return redirect()->route('admin.posts.index')->with('deleted' , $post->title);
    }
}
