@extends('layouts.app')

@section('content')
    
    <div class="card">
        <div class="card-header">
           <strong> {{ isset($tag) ? 'Update Tag' : 'Create Tag' }}</strong>
        </div>
        <div class="card-body"> 
           
            @include('partials.errors')

            <form action="{{  isset($tag) ? route('tags.update', $tag->id) :  route('tags.store') }}" method="POST">
                @csrf
                @if (isset($tag))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Tag name"
                    value="{{ isset($tag) ?  $tag->name :  '' }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">{{ isset($tag) ? 'Update' : 'Create' }}</button>
                    <a href="{{ URL::previous() }}" class="btn btn-danger">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection

