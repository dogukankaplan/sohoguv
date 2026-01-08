<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::where('is_active', true)
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        $title = 'Blog & Haberler';
        $description = 'Güvenlik sistemleri hakkında güncel bilgiler, haberler ve makaleler.';

        return view('blog.index', compact('posts', 'title', 'description'));
    }

    public function show($slug)
    {
        $post = BlogPost::where('slug', $slug)
            ->where('is_active', true)
            ->where('published_at', '<=', now())
            ->firstOrFail();

        $title = $post->title;
        $description = $post->excerpt;

        return view('blog.show', compact('post', 'title', 'description'));
    }
}
