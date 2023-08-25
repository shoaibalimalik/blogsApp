<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index() : View
    {
        $posts = Post::withCount('likes')->get();

        return view('admin.posts.index', compact('posts'));
    }

    public function create() : View
    {
        return view('admin.posts.create');
    }

    public function store(StorePostRequest $request) : RedirectResponse
    {
        $post = Post::create($request->only('title','body'));

        return redirect()->route('admin.posts.index')->with('message', 'Post was created successfully');;
    }

    public function edit(Post $post) : View
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post) : RedirectResponse
    {
        $post->update($request->only('title','body'));

        return redirect()->route('admin.posts.index')->with('message', 'Post was created successfully');;
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return back();
    }
}
