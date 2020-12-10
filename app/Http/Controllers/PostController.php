<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function index(){
        $posts = Post::latest()->approved()->published()->paginate(6);
        return view('post', compact('posts'));
        
    }
    public function details($slug){
        $post = Post::where('slug', $slug)->first();
        $blogKey = "blog"."_".$post->id;
        if(!Session::has($blogKey)){
            $post->increment('view_count');
            Session::put($blogKey, 1);
        }
        $randomPost = Post::approved()->published()->take(3)->inRandomOrder()->get();
        return view('single-post', compact('post', 'randomPost'));
    }
    public function postByCategory($slug){
        $category = Category::where('slug', $slug)->first();
        $posts = $category->posts()->approved()->published()->get();
        return view('category-post', compact('category', 'posts'));
    }
    public function postByTag($slug){
        $tags = Tag::where('slug', $slug)->first();
        $posts = $tags->posts()->approved()->published()->get();
        return view('tag-post', compact('tags', 'posts'));
    }
}
