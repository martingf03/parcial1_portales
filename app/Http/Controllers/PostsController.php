<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('blog.index', ['posts' => $posts]);
    }

    public function view(int $id)
    {
        return view('blog.view', ['post' => Post::findOrFail($id),]);
    }

    public function create()
    {
        return view('blog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string|max:1000',
            'content'=> 'required|string|max:100000',
            'publish_date' => 'required|date',
            'featured' => 'boolean',
        ]);

        $input = $request->all();

        $post = new Post();
        $post->fill($input);
        $post->save();

        return redirect()
            ->route('blog.index')->with('success', 'La publicación <span class="fw-bold">' . e($input['title']) .  '</span> se creó exitosamente');
    }
}
