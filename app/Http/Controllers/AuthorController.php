<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AuthorController extends Controller
{
    public function index($username){
        $author = User::where('username', $username)->first();
        if($author->username == $username){
            $posts  = $author->posts()->approved()->published()->get();
            return view('profile', compact('author', 'posts'));
        }else{
            return redirect()->route('home');
        }
        
    }
}
