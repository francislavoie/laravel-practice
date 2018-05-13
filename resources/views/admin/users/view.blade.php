@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    View User
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-{{ session('status-mode') ?? 'success' }}">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2 class="d-inline-block">Details</h2>

                    @can('user_edit', $user)
                        <a href="/admin/users/edit/{{ $user->id }}" class="btn btn-primary float-right">Edit</a>
                    @endcan

                    <dl class="row">
                        <dt class="col-md-4">Username</dt><dd class="col-md-8">{{ $user->username }}</dd>
                        <dt class="col-md-4">Email</dt><dd class="col-md-8">{{ $user->email }}</dd>
                        <dt class="col-md-4">Role</dt><dd class="col-md-8">{{ $user->role->label }}</dd>
                    </dl>

                    <h2>Address</h2>

                    <dl class="row">
                        <dt class="col-md-4">Street Address</dt><dd class="col-md-8">{{ $user->address->address ?? "" }}</dd>
                        <dt class="col-md-4">City</dt><dd class="col-md-8">{{ $user->address->city ?? "" }}</dd>
                        <dt class="col-md-4">Province</dt><dd class="col-md-8">{{ $user->address->province ?? "" }}</dd>
                        <dt class="col-md-4">Country</dt><dd class="col-md-8">{{ $user->address->country ?? "" }}</dd>
                        <dt class="col-md-4">Postal Code</dt><dd class="col-md-8">{{ $user->address->postal_code ?? "" }}</dd>
                    </dl>

                    <button onclick="window.history.back();" class="btn btn-outline-primary">Back</button>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
