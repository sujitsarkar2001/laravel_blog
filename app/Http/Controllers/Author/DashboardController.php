<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        $posts = $user->posts;
        $popularPost = $user->posts()
            ->withCount('comments')
            ->withCount('favorite_to_users')
            ->orderBy('view_count', 'desc')
            ->orderBy('comments_count')
            ->orderBy('favorite_to_users_count')
            ->take(5)
            ->get();
        $pendingPost = $posts->where('is_approved', false)->count();
        $viewCount = $posts->sum('view_count');
        return view('author.dashboard', compact('posts', 'popularPost', 'pendingPost', 'viewCount'));
    }
}
