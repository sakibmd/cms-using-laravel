@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">My Profile</div>

    <div class="card-body">
        @include('partials.errors')
        <form action="{{ route('users.update-profile', $user->id) }}" method="post">
            @csrf 
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $user->name) }}">
            </div>


            <div class="form-group">
                <label for="about">About</label>
                <textarea name="about" id="about" cols="5" rows="5" class="form-control">{{ $user->about }}
                </textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </form>
        
    </div>
</div>
@endsection
