@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end py-2">
    <a href="{{ route('posts.create') }}" class="btn btn-success">Add Post</a>
</div>
<div class="card card-default">
    <div class="card-header">
        <strong>{{ isset($trash) ? 'Trashed Posts' : 'All Posts' }}</strong>
    </div>
    <div class="card-body">
       @if ($posts->count() > 0)
       <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td><img src="{{ asset('storage/'.$post->image) }}" width="120px" height="65px" alt="image"></td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->category->name }}</td>
                        @if ($post->trashed())
                            <td>
                                <form action="{{ route('restore.posts', $post->id) }}" method="POST">
                                    @csrf 
                                    @method('PUT')
                                    <button type="submit" class="btn btn-info">Restore</button>
                                </form>
                            </td>
                        @else
                            @if (Auth::id() == $post->user_id)
                            <td>
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info">Edit</a>
                            </td> 
                            @endif
                            
                        @endif
                    <td>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">{{ $post->trashed() ? 'Delete' : 'Trash' }}</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
       @else
            <h2 class="text-center text-info font-weight-bold">No Posts Found</h2>
       @endif
    </div>
</div>
@endsection

