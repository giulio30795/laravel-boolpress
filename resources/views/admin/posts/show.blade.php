@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>
            {{ $post->title }}
        </h1>

        <p>{{ $post->body }}</p>

        <div class="d-flex mt-3">
            <button class="btn btn-primary">
                <a class="text-white" href="{{ route('admin.posts.index') }}">Back To Home</a>
            </button>
    
            <form action="{{route('admin.posts.destroy', $post->id)}}" method="POST">
                @csrf
                @method('DELETE') 

                <button type="submit" class=" mx-3 btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
@endsection