<?php

namespace App\Http\Controllers\Blog;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Session;

class PostsController extends Controller
{
    public function show(Post $post)
    {
        $blogKey = 'blog_' . $post->id;
        if (!Session::has($blogKey)) {
            $post->increment('view_count');
            Session::put($blogKey, 1);
        }

        return view('blog.show')->with('post', $post);
    }

    public function category(category $category)
    {
        return view('blog.category')
            ->with('category', $category)
            ->with('posts', $category->posts()->searched()->paginate(4))
            ->with('categories', Category::all())
            ->with('tags', Tag::all());
    }

    public function tag(Tag $tag)
    {
        return view('blog.tag')
            ->with('tag', $tag)
            ->with('posts', $tag->posts()->searched()->paginate(4))
            ->with('categories', Category::all())
            ->with('tags', Tag::all());
    }
}
