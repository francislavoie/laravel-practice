@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Users
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-{{ session('status-mode') ?? 'success' }}">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th class="text-right">Action</th>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td><a href="users/view/{{ $user->id }}">{{ $user->username }}</a></td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role->label }}</td>
                                <td class="text-right">
                                    <div class="btn-group" role="group">
                                        <a href="users/edit/{{ $user->id }}" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="users/delete/{{ $user->id }}"
                                            class="btn btn-warning btn-sm"
                                            onclick="return confirm('Are you sure you want to delete {{ $user->username }}?')">
                                            Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
