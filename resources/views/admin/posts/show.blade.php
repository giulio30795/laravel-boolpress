@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>
            {{ $post->title }}
        </h1>

        <p>{{ $post->body }}</p>

        <button class="btn btn-primary">
            <a class="text-white" href="{{ route('admin.posts.index') }}">Back To Home</a>
        </button>
    </div>
@endsection