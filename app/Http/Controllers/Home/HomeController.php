<?php

namespace App\Http\Controllers\Home;

use App\Models\Post;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('posts.index', [
            'posts' => (new Post)->latest()->filter(request(['search', 'category', 'author']))
                ->paginate(6)->withQueryString() // simplePaginate(6) for simple version
        ]);
    }

    public function show(Post $post): View
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }
}
