<?php

namespace App\Http\Controllers;

use SEO;
use App\Models\Post;
use App\Models\PostCategory;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (request('search')) {
            $posts = Post::where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('body', 'like', '%' . request('search') . '%')
                ->paginate(8);
        } else {
            $posts = Post::latest()->paginate(8);
        }
        $categories = PostCategory::all();

        SEO::setTitle('Blog');
        SEO::setDescription('Noticias de la plataforma');
        SEO::opengraph()->setUrl(url()->current());
        SEO::setCanonical(url()->current());
        SEO::opengraph()->addProperty('type', 'website');


        return view('blog.index', compact('posts', 'categories'));
    }


    public function category($slug)
    {
        $category = PostCategory::where('slug', $slug)->first();

        if (!$category) {
            abort(403);
        }

        $post = Post::with('categories')->whereHas('categories', function ($cat) use ($category) {
            return $cat->where('category_id', $category->id);
        })->get();

        $posts = Post::whereHas('categories', function ($cat) use ($category) {
            $cat->where('post_categories.id', $category->id);
        })->latest()->paginate(9);

        $titulo = "";

        // dd($post->toArray());

        return view('blog.category', compact('post', 'category', 'titulo', 'posts'));
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($postSlug)
    {
        $post = Post::with('categories')->where('slug', $postSlug)->first();
        // dd($post->categories()->get());
        if (!$post) {
            abort(404);
        }

        $latestPosts = Post::latest()->take(3)->get();

        $categories = PostCategory::all();

        $posts = Post::whereHas('categories', function ($cat) use ($post) {
            $cat->whereIn('post_categories.id', $post->categories->pluck('id'));
        })->latest()->take(3)->get();

        SEO::setTitle($post->title);
        SEO::setDescription($post->description ?? '');
        SEO::opengraph()->setUrl(url()->current());
        SEO::setCanonical(url()->current());
        SEO::opengraph()->addProperty('type', 'website')->addProperty('image', $post->main_image);

        return view('blog.show', compact('post', 'latestPosts', 'posts', 'categories'));
    }
}