<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class PostController extends Controller
{
    // Show the form to create a new post
    public function create()
    {
        return view('posts.create');
    }

    // Store the new post in the database
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Create a new post
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        // Redirect to the list of posts (or anywhere you like)
        return redirect()->route('posts.index');
    }

    // List all posts
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }
    public function edit($id)
{
    $post = Post::findOrFail($id);
    return view('posts.edit', compact('post'));
}

// Update the post in the database
public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ]);

    $post = Post::findOrFail($id);
    $post->update([
        'title' => $request->title,
        'content' => $request->content,
    ]);

    return redirect()->route('posts.index')->with('success', 'Post updated successfully');
}
}
