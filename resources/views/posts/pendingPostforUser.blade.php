@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end py-2">
    
</div>
<div class="card card-default">
    <div class="card-header">
        <strong>Pending Posts</strong>
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
                    <th>Details</th>
                    <th>Edit</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td><img src="{{ asset('storage/'.$post->image) }}" width="120px" height="65px" alt="image"></td>
                    <td>{{ str_limit($post->title, 40) }}</td>
                    <td>{{ $post->category->name }}</td>
                    <td>
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-success btn-sm">Show</a>
                    </td>
                    <td>
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info btn-sm">Edit</a>
                    </td>
                    <td><a href="{{ route('pending.remove', $post->id) }}" class="btn btn-danger btn-sm">Remove</a></td> 
                        
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
       @else
            <h2 class="text-center text-info font-weight-bold">No Pending Posts Found</h2>
       @endif
    </div>
</div>
@endsection

