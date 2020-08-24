@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end py-2">
    <a href="{{ route('posts.create') }}" class="btn btn-success">Add Post</a>
</div>
<div class="card card-default">
    <div class="card-header">
        <strong>Posts</strong>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        <td><img src="{{ asset('storage/'.$post->image) }}" width="120px" height="65px" alt="image"></td>
                        <td>{{ $post->title }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection