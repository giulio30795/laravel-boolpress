@extends('layouts.app')

@section('content')
<div class="container">

    <table class="table">
        <button class="btn btn-success my-3">
            <a class="text-white" href="{{ route('admin.posts.create') }}">Add New Post</a>
        </button>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                    <td>
                        <button class="btn btn-primary">
                            <a class="text-white"href="{{ route('admin.posts.show', $post->id) }}">View Details</a>
                        </button>
                        <button class="btn btn-warning">
                            <a href="{{ route('admin.posts.edit', $post->id) }}">Edit Post</a>
                        </button>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            @endforeach
            
        </tbody>
    </table>
</div>
@endsection