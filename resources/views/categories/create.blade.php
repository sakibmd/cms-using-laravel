@extends('layouts.app')

@section('content')
    
    <div class="card">
        <div class="card-header">
           <strong> {{ isset($category) ? 'Update Category' : 'Create Category' }}</strong>
        </div>
        <div class="card-body"> 
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form action="{{  isset($category) ? route('categories.update', $category->id) :  route('categories.store') }}" method="POST">
                @csrf
                @if (isset($category))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="enter category name"
                    value="{{ isset($category) ?  $category->name :  '' }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">{{ isset($category) ? 'Update' : 'Create' }}</button>
                    <a href="{{ URL::previous() }}" class="btn btn-danger">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection

