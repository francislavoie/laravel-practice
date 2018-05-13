<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Resources\Post as PostResource;
use App\Http\Requests\Admin\StorePostsRequest;
use App\Http\Requests\Admin\UpdatePostsRequest;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        return new PostResource(Post::with(['user'])->get());
    }

    public function show($id)
    {
        $post = Post::with(['user'])->findOrFail($id);

        return new PostResource($post);
    }

    public function store(StorePostsRequest $request)
    {
        $post = Post::create($request->all());

        return (new PostResource($post))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdatePostsRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());

        return (new PostResource($post))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response(null, 204);
    }
}
