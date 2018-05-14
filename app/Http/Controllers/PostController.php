<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Show the list of users
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(\Auth::user()->cannot('post_access'), 403, 'Unauthorized.');

        return view('posts.index', [
        	'posts' => Post::where('published', true)
                ->orderBy('published_at', 'desc')
                ->get()
        ]);
    }

    public function createView()
    {
        abort_if(\Auth::user()->cannot('post_create'), 403, 'Unauthorized.');

        return view('posts.create');
    }

    public function create(Request $request)
    {
        abort_if(\Auth::user()->cannot('post_create'), 403, 'Unauthorized.');

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'user_id' => 'required|integer',
            'published' => 'boolean',
            'published_at' => 'required|date',
        ]);

        // Create a post using the form inputs
        $post = Post::create($request->all());

        return redirect('/posts')
            ->with('status', "Successfully created post.")
            ->with('status-mode', 'success');
    }

    public function view(Post $post)
    {
        abort_if(\Auth::user()->cannot('post_view', $post), 403, 'Unauthorized.');

        return view('posts.view', compact('post'));
    }

    public function editView(Post $post)
    {
        abort_if(\Auth::user()->cannot('post_edit', $post), 403, 'Unauthorized.');

        return view('posts.edit', compact('post'));
    }

    public function edit(Request $request, Post $post)
    {
        abort_if(\Auth::user()->cannot('post_edit', $post), 403, 'Unauthorized.');

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'user_id' => 'required|integer',
            'published' => 'boolean',
            'published_at' => 'required|date',
        ]);

        // Update the post with form inputs
        $post->update($request->all());

        return redirect('/posts')
            ->with('status', "Successfully updated post.")
            ->with('status-mode', 'success');
    }
}
