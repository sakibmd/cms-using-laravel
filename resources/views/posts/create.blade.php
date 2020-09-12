@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
        <strong>{{ isset($post) ? 'Update Post' : 'Create Post' }}</strong>
    </div>
    <div class="card-body">
        @include('partials.errors')
        <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($post))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', isset($post) ? $post->title : '' ) }}">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="5" rows="5" class="form-control">{{ old('description', isset($post) ? $post->description : '' ) }}
                </textarea>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <input id="content" type="hidden" name="content" value="{{ old('content', isset($post) ? $post->content : '' ) }}">
                <trix-editor input="content"></trix-editor>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            @isset($post)
                                @if ($category->id == $post->category_id)
                                    selected
                                @endif
                            @endisset
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @if ($tags->count() > 0)
            <div class="form-group">
                <label for="tags">Tags</label>
                <select name="tags[]" id="tags" class="form-control select-tags" multiple>
                    @foreach ($tags as $tag)
                        <option 
                            
                            @foreach($post->tags as $postTag) 
                                 {{ $postTag->id == $tag->id ? 'selected' : '' }}
                             @endforeach 
                             
                             value="{{ $tag->id }}"
                        >
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @endif
            <div class="form-group">
                <label for="published_at">Published At</label>
                <input type="text" name="published_at" id="published_at" class="form-control"  value="{{ old('published_at', isset($post) ? $post->published_at : '' ) }}">
            </div>
            {{-- @if (isset($post))
                <div class="form-control">
                    <img src="{{ asset('storage/'.$post->image) }}" alt="" height="100px" width="100px">
                </div>
            @endif --}}
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">{{ isset($post) ? 'Update' : 'Create' }}</button>
                <a href="{{ URL::previous()  }}" class="btn btn-danger">Back</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/trix.js') }}"></script>
<script src="{{ asset('js/flatpickr.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    flatpickr('#published_at', {
        enableTime:true
    })

    $(document).ready(function() {
        $('.select-tags').select2();
    })
</script>
@endsection

@section('css')
<link href="{{ asset('css/trix.css') }}" rel="stylesheet">
<link href="{{ asset('css/flatpickr.min.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection