@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Posts

                    @can('post_create')
                        <a href="/posts/create" class="btn btn-primary btn-sm float-right">Create</a>
                    @endcan
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-{{ session('status-mode') ?? 'success' }}">
                            {{ session('status') }}
                        </div>
                    @endif

                    @forelse($posts as $post)
                        <a href="/posts/view/{{ $post->id }}"
                            class="list-group-item list-group-item-action mb-3">
                            <div class="lead pb-2">{{ $post->title }}</div>
                            <div class="">{{ str_limit($post->content, 200, ' ...') }}</div>
                            <div class="text-muted pt-2">{{ $post->published_at->diffForHumans() }} by {{ $post->user->username ?? "Unknown" }}</div>
                        </a>
                    @empty
                        <p>No published posts</p>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
