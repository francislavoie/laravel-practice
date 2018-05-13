@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Edit User
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-{{ session('status-mode') ?? 'success' }}">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            Please fix the following problems:
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST">
                        @csrf

                        <h2 class="d-inline-block">Details</h2>

                        {{-- <a href="" class="btn btn-primary float-right">Change Password</a> --}}

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{ $user->username ?? "" }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ $user->email ?? "" }}">
                        </div>

                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="user_roles_id">
                                @foreach (\App\Models\UserRole::all() as $role)
                                    <option 
                                        value="{{ $role->id }}"
                                        {{ $user->user_roles_id == $role->id ? 'selected' : '' }}
                                        >
                                        {{ $role->label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <h2>Address</h2>

                        <input type="hidden" name="address[user_id]" value="{{ $user->id }}" />

                        <div class="form-group">
                            <label for="street">Street Address</label>
                            <input type="text" class="form-control" id="street" name="address[address]" placeholder="Street Address" value="{{ $user->address->address ?? "" }}">
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <label for="city">City</label>
                                <input type="text" class="form-control" id="city" name="address[city]" placeholder="City" value="{{ $user->address->city ?? "" }}">
                            </div>

                            <div class="form-group col">
                                <label for="province">Province</label>
                                <input type="text" class="form-control" id="province" name="address[province]" placeholder="Province" value="{{ $user->address->province ?? "" }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" id="country" name="address[country]" placeholder="Country" value="{{ $user->address->country ?? "" }}">
                            </div>

                            <div class="form-group col">
                                <label for="postal_code">Postal Code</label>
                                <input type="text" class="form-control" id="postal_code" name="address[postal_code]" placeholder="Postal Code" value="{{ $user->address->postal_code ?? "" }}">
                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="/admin/users" class="btn btn-default">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
