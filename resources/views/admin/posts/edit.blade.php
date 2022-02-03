@extends('layouts.app')
@section('content')

    <div class="container">
        <h1>Edit Post</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="form" action="{{ route('admin.posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label class="form-laber" for="title">Title</label>
            <input class="form-control" type="text" name="title" id="title" value="{{old('title', $post->title)}}">
        </div>

        <div class="mb-3">
            <label class="form-label" for="body">Title</label>
            <textarea class="form-control" name="body" id="body" rows="10">{{old('body', $post->body)}}</textarea>
        </div>

            <button class="btn btn-success" type="submit"> Edit Service</button>
        </form>
    </div>
@endsection