@extends('layouts.app')

@section('content')
<div class="container">

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post){
                <tr>
                    <td>{{$post->id}}</td>
                </tr>
            }
        </tbody>
    </table>
</div>
@endsection