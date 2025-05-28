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
        $request->validate(
            [
                'title' => 'required|string|max:255',
                'summary' => 'required|string|max:1000',
                'content' => 'required|string|max:10000',
                'publish_date' => 'required|date',
                'featured' => 'boolean',
            ],
            [
                'title.required' => 'El título debe tener un valor',
                'title.max' => 'El título no debe tener más de 255 caracteres',
                'summary.required' => 'El resumen debe tener un valor',
                'summary.max' => 'El resumen no debe tener más de 1000 caracteres',
                'content.required' => 'El contenido debe tener un valor',
                'content.max' => 'El contenido no debe tener más de 10000 caracteres',
                'publish_date.required' => 'La fecha debe tener un valor',
            ]
        );

        $input = $request->all();

        $post = new Post();
        $post->fill($input);
        $post->save();

        return redirect()
            ->route('blog.index')->with('success', 'La publicación <span class="fw-bold">' . e($input['title']) .  '</span> se creó exitosamente');
    }

    public function delete(int $id)
    {
        return view('blog.delete', [
            'post' => Post::findOrFail($id),
        ]);
    }

    public function destroy(int $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('blog.index')->with('success', 'La publicación <span class="fw-bold">' . e($post->title) .  '</span> se eliminó exitosamente');
    }
}
