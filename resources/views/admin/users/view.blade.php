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

                    <h2>Posts</h2>

                    @forelse($user->posts as $post)
                        @if ($user->id != Auth::user()->id && ! $post->published)
                            @continue
                        @endif

                        <a href="/posts/view/{{ $post->id }}"
                            class="list-group-item list-group-item-action mb-3">
                            <div class="lead">{{ $post->title }}</div>
                            <div class="text-muted pt-2">
                                {{ $post->published_at->diffForHumans() }} —
                                @if ($post->published)
                                    <span class="text-primary">Published</span>
                                @else
                                    <span class="text-danger">Not Published</span>
                                @endif
                            </div>
                        </a>
                    @empty
                        <p>No published posts</p>
                    @endforelse


                    <button onclick="window.history.back();" class="btn btn-outline-primary">Back</button>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
