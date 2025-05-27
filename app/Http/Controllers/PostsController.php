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

        return view('blog.index', ['posts'=> $posts]);
    }

    public function view(int $id)
    {
        return view('blog.view', ['post'=> Post::findOrFail($id),]);
    }
}
