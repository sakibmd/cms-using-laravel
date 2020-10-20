@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end py-2">
    <a href="{{ URL::previous() }}" class="btn btn-danger">Back</a>
</div>
<div class="card card-default">
    <div class="card-header">
        <strong>Post Details</strong>
    </div>
    <div class="card-body">
      
       <div class="table-responsive">
        <table class="table">
            <tr>
                <th>Title</th>
                <th>{{ $post->title }}</th>
            </tr>
            <tr>
                <th>Image</th>
                <th><img src="{{ asset('storage/'.$post->image) }}" width="360px" height="260px" alt="image"></th>
            </tr>
            <tr>
                <th>Category</th>
                <th>{{ $post->category->name }}</th>
            </tr>
            <tr>
                <th>Tags</th>
                <th>
                    @foreach ($post->tags as $tag)
                        <a class="btn btn-sm btn-success text-white">{{ $tag->name }}</a>
                    @endforeach    
                </th>
            </tr>
            <tr>
                <th>Publish Time</th>
                <th>{{ $post->published_at }}</th>
            </tr>
            <tr>
                <th>View Count</th>
                <th>{{ $post->view_count }}</th>
            </tr>
            <tr>
                <th>Description</th>
                <th>{{ $post->description }}</th>
            </tr>
            <tr>
                <th>Content</th>
                <th>{!! $post->content !!}</th>
            </tr>
            
        </table>
    </div>
      
    </div>
</div>
@endsection

