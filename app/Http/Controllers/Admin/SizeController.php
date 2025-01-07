<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductSize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SizeController extends Controller
{
    //
    
    public function view_size()
    {
        $sss = ProductSize::all();
        return view('admin.pages.size', compact('sss'));
    }
    
    public function add_size(Request $request)
    {
        
        $sizes = new ProductSize();
        $sizes->size = $request->size;
        $sizes->save();
        toastr()->timeOut(5000)->success('Size added successful');
        return redirect()->back();
    }

    public function size_update(Request $request,$id)
    {
        $size = ProductSize::find($id);
        
        return view('admin.pages.update_size',compact('size'));
    }

    public function edit_size(Request $request,$id)
    {
        
        $sizes = ProductSize::find($id);
        $sizes->size = $request->sizes;
        $sizes->save();
        toastr()->timeOut(5000)->success('Size updated successful');
        return redirect('/view_size');
    }

    public function delete_size($id)
    {
        ProductSize::findOrFail($id)->delete();
        toastr()->timeOut(5000)->warning('Size deleted successful');
        return redirect()->back();
    }

}
