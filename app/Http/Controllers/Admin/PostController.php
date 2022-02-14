<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use App\Tag;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
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
        $tags = Tag::all();

        return view('admin.posts.index', compact('posts', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
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
            'category_id' => 'nullable|exists:categories,id',
            'cover' => 'nullable|file|mimes:jpeg,jpg,bpm,png'
        ]);
        
        $data = $request->all();
        $new_post = new Post();

        if(array_key_exists('cover', $data)){
            
            $img_path = Storage::put('posts-cover', $data['cover']);

            $data['cover'] = $img_path;
        }



        // The blog post is valid...
        

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

        if(array_key_exists('tags', $data)){
            $new_post->tags()->attach($data['tags']);
        }

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

        
        if (!$post) {
            abort(404);
        }

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

        $categories = Category::all();

        $tags= Tag::all();

        return view ('admin.posts.edit', compact('post', 'categories', 'tags'));
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

        $validated = $request->validate([

            'title' => 'required|max:255',
            'body' => 'required|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'cover' => 'nullable|file|mimes:jpeg,jpg,bpm,png'
        ]);

        $data = $request->all();

        $post = Post::find($id);

        if(array_key_exists('cover', $data)){

            if($post->cover){
                Storage::delete($post->cover);
            }
            $data['cover'] = Storage::put('posts-cover', $data['cover']);
        }

        
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

        if(array_key_exists('tags', $data)){
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->detach();
        }


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
        
        if($post->cover){
            Storage::delete($post->cover);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')->with('deleted' , $post->title);
    }
}
