@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Edit Post
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

                    <h2 class="d-inline-block">Details</h2>

                    <form method="POST">
                        @csrf

                        <input type="hidden" name="user_id" value="{{ \Auth::user()->id }}" />

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ $post->title ?? "" }}">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="published_at">Published At</label>
                                <input type="date" class="form-control" id="published_at" name="published_at" value="{{ $post->published_at->toDateString() ?? "" }}" />
                            </div>

                            <div class="col-md-4" style="margin-top: 38px;">
                                <div class="custom-control custom-checkbox text-center">
                                    <input type="hidden" name="published" value="0">
                                    <input type="checkbox" class="custom-control-input" id="published" name="published" value="1" {{ $post->published ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="published">Published</label>
                                </div>
                            </div>
                        </div>

                        <h2 class="d-inline-block">Content</h2>

                        <div class="form-group">
                            <textarea class="form-control" id="content" name="content" placeholder="Content" rows="5">{{ $post->content ?? "" }}</textarea>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Create</button>
                            <a href="/posts" class="btn btn-default">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
