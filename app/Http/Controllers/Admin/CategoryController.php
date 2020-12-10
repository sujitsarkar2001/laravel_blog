<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Category;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

use Intervention\Image\Facades\Image as Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'name' => 'required|unique:categories',
            'image' => 'required|image|mimes:jpeg,bmp,jpg,png',
        ]);
        // get form image
        $image = $request->file('image');
        $slug = Str::slug($request->name);
        if(isset($image)){
            // make unique name for image
            $current_date = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$current_date.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            // Check dir is exists
            if(!Storage::disk('public')->exists('category')){
                Storage::disk('public')->makeDirectory('category');
            }

            // resize image for category and upload
            $category = Image::make($image)->resize(1600, 479)->stream();
            Storage::disk('public')->put('category/'.$imageName, $category);
            
            // Check slider dir is exits
            if (!Storage::disk('public')->exists('category/slider')) {
                Storage::disk('public')->makeDirectory('category/slider');
            }
            
            // resize image for category slider and upload
            $slider = Image::make($image)->resize(500, 333)->stream();
            Storage::disk('public')->put('category/slider/' . $imageName, $slider);
        }else{
            $imageName = 'default.png';
        }
        $category = new Category;
        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $imageName;
        $category->save();

        Toastr::success('Category Successfully Saved', 'success');
        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'image|mimes:jpeg,bmp,jpg,png',
        ]);
        // get form image
        $image = $request->file('image');
        $slug = Str::slug($request->name);

        $data = Category::find($id);

        if (isset($image)) {
            // make unique name for image
            $current_date = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $current_date . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Check dir is exists
            if (!Storage::disk('public')->exists('category')) {
                Storage::disk('public')->makeDirectory('category');
            }

            // delete category old image
            if (Storage::disk('public')->exists('category/'. $data->image)) {
                Storage::disk('public')->delete('category/'.$data->image);
            }

            // resize image for category and upload
            $category = Image::make($image)->resize(1600, 479)->stream();
            Storage::disk('public')->put('category/' . $imageName, $category);
            // Check slider dir is exits
            if (!Storage::disk('public')->exists('category/slider')) {
                Storage::disk('public')->makeDirectory('category/slider');
            }

            // delete category slider old image
            if (Storage::disk('public')->exists('category/slider/'.$data->image)) {
                Storage::disk('public')->delete('category/slider/'.$data->image);
            }

            // resize image for category slider and upload
            $slider = Image::make($image)->resize(500, 333)->stream();
            Storage::disk('public')->put('category/slider/' . $imageName, $slider);
        } else {
            $imageName = $data->image;
        }

        $data->name = $request->name;
        $data->slug = $slug;
        $data->image = $imageName;
        $data->save();

        Toastr::success('Category Successfully Updated', 'success');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Category::find($id);

        // delete category old image
        if (Storage::disk('public')->exists('category/' . $data->image)) {
            Storage::disk('public')->delete('category/' . $data->image);
        }
        // delete category slider old image
        if (Storage::disk('public')->exists('category/slider/' . $data->image)) {
            Storage::disk('public')->delete('category/slider/' . $data->image);
        }
        $data->delete();

        Toastr::success('Category Successfully Deleted', 'success');
        return redirect()->back();
    }
}
