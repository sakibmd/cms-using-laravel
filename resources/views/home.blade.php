@extends('layouts.app')

@section('content')

            <div class="card text-center">
                <div class="card-header"><strong>Dashboard</strong></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @auth
                    @if (Auth::id() == 1)
                        <h2>Welcome Admin - <strong>{{ Auth::user()->name }}</strong></h2>
                    @else
                        <h2>Welcome User - <strong>{{ Auth::user()->name }}</strong></h2>
                    @endif                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ Auth::user()->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ Auth::user()->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>About</th>
                                        <td style="text-align: justify">{{ Auth::user()->about }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('users.edit-profile') }}" class="btn btn-success">Edit Profile</a>
                            </div>
                        </div>
                   
                        
                    @endauth
                </div>
            </div>
       
@endsection
