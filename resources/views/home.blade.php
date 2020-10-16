@extends('layouts.app')

@section('content')

            <div class="card text-center">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (Auth::id() == 1)
                        <h2>Welcome Admin - <strong>{{ Auth::user()->name }}</strong></h2>
                    @else
                    <h2>Welcome - <strong>{{ Auth::user()->name }}</strong></h2>
                    @endif
                </div>
            </div>
       
@endsection
