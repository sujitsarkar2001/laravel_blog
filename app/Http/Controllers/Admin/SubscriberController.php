<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subscriber;
use Brian2694\Toastr\Facades\Toastr;

class SubscriberController extends Controller
{
    public function index(){
        $subscriber = Subscriber::latest()->get();
        return view('admin.subscriber', compact('subscriber'));
    }
    public function destroy($id){
        $sub = Subscriber::findOrFail($id)->delete();
        Toastr::success('Subscriber Successfully Deleted', 'success');
        return redirect()->back();
    }
}
