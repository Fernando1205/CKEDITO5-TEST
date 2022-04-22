<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::all();
        return view('welcome',compact('posts'));
    }

    public function create(): View
    {
        return view('create');
    }

    public function store(Request $request): RedirectResponse
    {
        Post::create($request->all());
        return redirect()->back();
    }

    public function show(Post $post):View
    {
        return view('show',compact('post'));
    }

    public function edit(Post $post): View
    {
        return view('edit',compact('post'));
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $post->update($request->all());
        return redirect()->back();
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();
        return redirect()->back();
    }
}
