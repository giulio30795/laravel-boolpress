@extends('layouts.app')

@section('content')
<div class="container">

    <table class="table">
        <button class="btn btn-success my-3">
            <a class="text-white" href="{{ route('admin.posts.create') }}">Add New Post</a>
        </button>

        @if (session('deleted'))
            <div class="alert alert-success">
                <strong>
                    {{ session('deleted') }}
                </strong>
                    Cancellato Con Successo

            </div>
        @endif

        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th colspan="3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                    <td>
                        <a href="{{route('admin.category', $post->category->id)}}">
                            {{$post->category->name}}
                        </a>
                    </td>

                    <td class="d-flex">
                        <button class="btn btn-primary">
                            <a class="text-white"href="{{ route('admin.posts.show', $post->id) }}">View Details</a>
                        </button>
                        <button class=" mx-3 btn btn-warning">
                            <a class="text-white" href="{{ route('admin.posts.edit', $post->id) }}">Edit Post</a>
                        </button>

                        <form action="{{route('admin.posts.destroy', $post->id)}}" method="POST">
                       @csrf
                       @method('DELETE') 
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            
        </tbody>
    </table>
</div>
@endsection