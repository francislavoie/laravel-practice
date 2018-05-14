@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    View Post

                    @can('post_edit', $post)
                        <a href="/posts/edit/{{ $post->id }}" class="btn btn-primary btn-sm float-right">Edit</a>
                    @endcan
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-{{ session('status-mode') ?? 'success' }}">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2 class="d-inline-block">{{ $post->title }}</h2>

                    <div class="text-muted">{{ $post->published_at->diffForHumans() }} by 
                        @if ($post->user)
                            <a href="/users/view/{{ $post->user->id }}">{{ $post->user->username }}</a>
                        @else
                            Unknown
                        @endif
                    </div>

                    <p class="mt-4" 
                        style="line-height: 2; text-align: justify;"
                        >
                        {{ $post->content }}
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
