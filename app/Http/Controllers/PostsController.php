<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

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
                'title.max' => 'El título no debe tener más de :max caracteres',
                'summary.required' => 'El resumen debe tener un valor',
                'summary.max' => 'El resumen no debe tener más de :max caracteres',
                'content.required' => 'El contenido debe tener un valor',
                'content.max' => 'El contenido no debe tener más de :max caracteres',
                'publish_date.required' => 'La fecha debe tener un valor',
            ]
        );

        $input = $request->all();

        if($request->hasFile('image')) {
            $input['image'] = $request->file('image')->store('post_images', 'public');
        }

        $post = new Post();
        $post->fill($input);
        $post->save();

        return redirect()
            ->route('blog.index')->with('success', 'La publicación <span class="fw-bold">' . e($input['title']) .  '</span> se creó exitosamente.');
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

        if(
            $post->image &&
            Storage::has($post->image)
        ) {
            Storage::delete($post->image);
        }

        return redirect()->route('blog.index')
        ->with('success', 'La publicación <span class="fw-bold">' . e($post->title) .  '</span> se eliminó exitosamente');
    }

    public function edit(int $id)
    {
        return view('blog.edit', [
            'post' => Post::findOrFail($id),
        ]);
    }

    public function update(Request $request, int $id)
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
                'title.max' => 'El título no debe tener más de :max caracteres',
                'summary.required' => 'El resumen debe tener un valor',
                'summary.max' => 'El resumen no debe tener más de :max caracteres',
                'content.required' => 'El contenido debe tener un valor',
                'content.max' => 'El contenido no debe tener más de :max caracteres',
                'publish_date.required' => 'La fecha debe tener un valor',
            ]
        );

        $post = Post::findOrFail($id);

        $wasFeatured = $post->featured;

        // $post->update($request->all());

        $input = $request->except(['_token', '_method']);
        $oldImage = $post->image;

        if($request->hasFile('image')) {
            $input['image'] = $request->file('image')->store('post_images', 'public');
        }

        $post->update($input);

        if(
            $request->hasFile('image') &&
            $oldImage &&
            Storage::has($oldImage)
        ) {
            Storage::delete($oldImage);
        }

        $redirect = redirect()->route('blog.index');

        if ($wasFeatured && !$post->featured) {
            $redirect->with('info', 'Editaste la publicación <span class="fw-bold">' . e($post->title) . '</span> para que ya no aparezca en la sección de novedades.');
        } else {
            $redirect->with('success', 'La publicación <span class="fw-bold">' . e($post->title) . '</span> se editó exitosamente.');
        }

        return $redirect;
    }
}
