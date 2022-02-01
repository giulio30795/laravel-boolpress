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
            <label class="form-label" for="body">Title</label>
            <textarea class="form-control" name="body" id="body" rows="10">{{old('body')}}</textarea>
        </div>

            <button class="btn btn-success" type="submit"> Add Post</button>
        </form>
    </div>
@endsection
