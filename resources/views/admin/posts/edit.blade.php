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

        <form class="form" action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
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
        
        <select class="form-control" name="category_id" id="category_id">
            <option value="">Uncategorized</option>

            @foreach ( $categories as $category )

                <option value="{{$category->id}}"
                    @if ($category->id == old('category_id', $post->category_id)) selected @endif>
                    {{$category->name}}
                </option>
            @endforeach
        </select>

        <div class="mb-3">
            @foreach ( $tags as $tag )
                    <input type="checkbox" name="tags[]" id="tag{{$loop->iteration}}" value="{{$tag->id}}"

                    @if($errors->any() && in_array($tag->id, old('tags')))
                        checked

                   @elseif(!$errors->any() && $post->tags->contains($tag->id))
                    checked

                     @endif>

                    <label for="tag{{$loop->iteration}}">
                        {{$tag->name}}
                    </label>
                @endforeach
        </div>

        <div class="mb-3">
            <label for="cover" class="form-label">Cover</label>
            <input type="file" class="form-control-file"  name="cover" id="cover">
        </div>

            <button class="btn btn-success" type="submit"> Edit Service</button>
        </form>
    </div>
@endsection
