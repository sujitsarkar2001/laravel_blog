<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class SearchController extends Controller
{
    public function index(Request $request){
        $keyword = $request->input('keyword');
        $posts = Post::where("title","LIKE", "%$keyword%")->approved()->published()->get();
        return view('search-post', compact('posts', 'keyword'));
    }
}
