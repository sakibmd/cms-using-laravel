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
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td><img src="{{ asset('storage/'.$post->image) }}" width="120px" height="65px" alt="image"></td>
                    <td>{{ $post->title }}</td>
                    <td>
                        @if (!$post->trashed())
                             <a href="" class="btn  btn-info">Edit</a>
                        @endif
                    </td>  
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

