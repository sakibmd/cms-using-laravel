@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end py-2">
    @isset($trash)

    @else   
        <a href="{{ route('posts.create') }}" class="btn btn-success">Add Post</a>
    @endisset
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
                    <th>View Count</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td><img src="{{ asset('storage/'.$post->image) }}" width="120px" height="65px" alt="image"></td>
                    <td>{{  str_limit($post->title, 30) }}</td>
                    <td>{{ $post->category->name }}</td>
                    <td>{{ $post->view_count }}</td>

                    


                    <td>
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-success btn-sm">Details</a>
                    </td>
                    
                        
                   
                    <td>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">{{ $post->trashed() ? 'Delete' : 'Trash' }}</button>
                        </form>
                    </td>

                    @if ($post->trashed())
                            <td>
                                <form action="{{ route('restore.posts', $post->id) }}" method="POST">
                                    @csrf 
                                    @method('PUT')
                                    <button type="submit" class="btn btn-info btn-sm">Restore</button>
                                </form>
                            </td>
                        @else
                            @if (Auth::id() == $post->user_id)
                            <td>
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info btn-sm">Edit</a>
                            </td> 
                            @endif
                            
                        @endif
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

