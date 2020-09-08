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
                    <td></td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if (!$user->isAdmin())
                            <button class="btn btn-success btn-md">Make Admin</button>    
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

