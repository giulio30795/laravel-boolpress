@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Crea un nuovo Post</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="form" action="{{ route('admin.posts.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-laber" for="title">Title</label>
            <input class="form-control" type="text" name="title" id="title" value="{{old('title')}}">
        </div>

        <div class="mb-3">
            <label class="form-label" for="body">Body</label>
            <textarea class="form-control" name="body" id="body" rows="10">{{old('body')}}</textarea>
        </div>

        <div class="mb-3">
            <label for="category_id">Category</label>

            <select class="form-control" name="category_id" id="category_id">
                <option value="">Uncategorized</option>

                @foreach ( $categories as $category )

                    <option value="{{$category->id}}"
                        @if ($category->id == old('category_id')) selected @endif>
                        {{$category->name}}
                    </option>
                @endforeach
            </select>
        </div>
            <div class="mb-3">
                <h4>Tags</h4>
                
                @foreach ( $tags as $tag )
                    <input type="checkbox" name="tags[]" id="tag{{$loop->iteration}}" value="{{$tag->id}}"
                    >

                    <label for="tag{{$loop->iteration}}">
                        {{$tag->name}}
                    </label>
                @endforeach
            </div>

        
            <button class="btn btn-success" type="submit"> Add Post</button>
        </form>
    </div>
@endsection
