@extends('layouts.app')

@section('content')
    
<h1 class="text-center">
    {{$category->name}}
</h1>

    @foreach ($category->posts as $post)
        <div class="container mb-3">
            <h3>{{$post->title}}</h3>
            <p>{{$post->body}}</p>
        </div>
    @endforeach

    <div class="container">
        <button class="btn btn-primary">
            <a class="text-white" href="{{ route('admin.posts.index') }}">Back To Home</a>
        </button>
    </div>


@endsection