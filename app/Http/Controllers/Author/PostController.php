<?php

namespace App\Http\Controllers\Author;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\Tag;
use App\User;
use Illuminate\Http\Request;

use App\Notifications\NewAuthorPost;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;

use Intervention\Image\Facades\Image as Image;
use Brian2694\Toastr\Facades\Toastr;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Auth::User()->posts()->latest()->get();
        return view('author.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('author.post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:posts',
            'image' => 'required',
            'body' => 'required',
            'categories' => 'required',
            'tags' => 'required',
        ]);
        $image = $request->file('image');
        $slug = Str::slug($request->title);
        if (isset($image)) {
            // make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            // check post image dir
            if (!Storage::disk('public')->exists('post')) {
                Storage::disk('public')->makeDirectory('post');
            }
            // Save image to storage
            $postImg = Image::make($image)->resize(1600, 1066)->stream();
            Storage::disk('public')->put('post/' . $imageName, $postImg);
        } else {
            $imageName = 'default.png';
        }
        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug  = $slug;
        $post->image = $imageName;
        $post->body = $request->body;
        if (isset($request->status)) {
            $post->status = true;
        } else {
            $post->status = false;
        }
        $post->is_approved = false;
        $post->save();

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);
        $users = User::where('role_id', '1')->get();
        Notification::send($users, new NewAuthorPost($post));

        Toastr::success('Post Successfully Saved', 'success');
        return redirect()->route('author.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if($post->user_id == Auth::id()){
            return view('author.post.show', compact('post'));
        }else{
            Toastr::error('You does not access this post', 'error');
            return redirect()->back();
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if ($post->user_id == Auth::id()) {
            $categories = Category::all();
            $tags = Tag::all();
            return view('author.post.edit', compact('post', 'categories', 'tags'));
        } else {
            Toastr::error('You does not access this post', 'error');
            return redirect()->back();
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'image',
            'body' => 'required',
            'categories' => 'required',
            'tags' => 'required',
        ]);
        $image = $request->file('image');
        $slug = Str::slug($request->title);
        if (isset($image)) {
            // make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            // check post image dir
            if (!Storage::disk('public')->exists('post')) {
                Storage::disk('public')->makeDirectory('post');
            }
            // delete storage image
            if (Storage::disk('public')->exists('post/' . $post->image)) {
                Storage::disk('public')->delete('post/' . $post->image);
            }
            // Save image to storage
            $postImg = Image::make($image)->resize(1600, 1066)->stream();
            Storage::disk('public')->put('post/' . $imageName, $postImg);
        } else {
            $imageName = $post->image;
        }
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug  = $slug;
        $post->image = $imageName;
        $post->body = $request->body;
        if (isset($request->status)) {
            $post->status = true;
        } else {
            $post->status = false;
        }
        $post->is_approved = false;
        $post->save();

        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);

        Toastr::success('Post Successfully Updated', 'success');
        return redirect()->route('author.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->user_id == Auth::id()) {
            // delete category old image
            if (Storage::disk('public')->exists('post/' . $post->image)) {
                Storage::disk('public')->delete('post/' . $post->image);
            }
            $post->categories()->detach();
            $post->tags()->detach();

            $post->delete();

            Toastr::error('Post Successfully Deleted', 'success');
            return redirect()->back();
        } else {
            Toastr::success('You does not access this post', 'error');
            return redirect()->back();
        }
        
    }
}
