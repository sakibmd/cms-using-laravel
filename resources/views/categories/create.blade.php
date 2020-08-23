@extends('layouts.app')

@section('content')
    
    <div class="card">
        <div class="card-header">
            Create Category
        </div>
        <div class="card-body"> 
            <form action="{{ route('categories.store') }}" method="POST">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="enter category name">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection