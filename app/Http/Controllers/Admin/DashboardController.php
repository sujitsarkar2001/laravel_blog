<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Category;
use App\Tag;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){
        $posts = Post::all();
        $popularPost = Post::withCount('comments')
            ->withCount('favorite_to_users')
            ->orderBy('view_count', 'desc')
            ->orderBy('comments_count', 'desc')
            ->orderBy('favorite_to_users_count', 'desc')
            ->take(5)
            ->get();
        $pendingPost = $posts->where('is_approved', false)->count();
        $viewCount = $posts->sum('view_count');
        $authorCount = User::where('role_id', 2)->count();
        $newAuthorToday = User::where('role_id', 2)
            ->whereDate('created_at', Carbon::today())
            ->count();
        $activeAuthor = User::where('role_id', 2)
            ->withCount('posts')
            ->withCount('comments')
            ->withCount('favorite_posts')
            ->orderBy('posts_count', 'desc')
            ->orderBy('comments_count', 'desc')
            ->orderBy('favorite_posts_count', 'desc')
            ->take(10)
            ->get();
        $categoryCount = Category::all();
        $tagCount = Tag::all();
        return view('admin.dashboard', compact('posts', 'popularPost', 'pendingPost', 'viewCount', 'authorCount', 'newAuthorToday', 'activeAuthor', 'categoryCount', 'tagCount'));
    }
}
