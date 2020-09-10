@extends('layouts.app')

@section('content')

<div class="card card-default">
    <div class="card-header">
        <strong>Users</strong>
    </div>
    <div class="card-body">
       @if ($users->count() > 0)
       <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>
                        <img width="50px" height="50px" style="border-radius: 50%;"  src="{{ Gravatar::src($user->email) }}" alt="" srcset="">
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if (!$user->isAdmin())
                            <form action="{{ route('users.make-admin', $user->id) }}" method="post">
                                @csrf
                                <button class="btn btn-success btn-md">Make Admin</button>    
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
       @else
            <h2 class="text-center text-info font-weight-bold">No Users Found</h2>
       @endif
    </div>
</div>
@endsection

