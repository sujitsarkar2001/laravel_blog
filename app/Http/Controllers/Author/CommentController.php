<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Comment;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Post;

class CommentController extends Controller
{
    public function index()
    {
        $posts = Auth::user()->posts;
        return view('author.comment', compact('posts'));
    }
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        if($comment->post->user->id == Auth::id()){
            $comment->delete();
            Toastr::success('Comment Successfully Saved', 'success');
            
        }else{
            Toastr::error('You are no authorized to delete this comment', 'error');
        }
        return redirect()->back();
    }
}
