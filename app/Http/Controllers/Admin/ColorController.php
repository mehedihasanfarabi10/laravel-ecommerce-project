<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductColor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ColorController extends Controller
{
    //

    public function view_color()
    {
        $colors = ProductColor::all();
        return view('admin.pages.color', compact('colors'));
    }

    public function add_color(Request $request)
    {
        $request->validate(['color' => 'required']);
        // Color::create(['name' => $request->color]);
        $color = new ProductColor();

        $color->color = $request->color;

        $color->save();
        toastr()->timeOut(5000)->success('Color created successful');
        return redirect()->back();
    }

    public function color_update(Request $request,$id)
    {
        $color = ProductColor::find($id);
        
        return view('admin.pages.update_color',compact('color'));
    }
    public function edit_color(Request $request,$id)
    {
        
        $color = ProductColor::find($id);
        $color->color = $request->color;
        $color->save();
        toastr()->timeOut(5000)->success('Color updated successful');
        return redirect('/view_color');
    }


    public function delete_color($id)
    {
        ProductColor::findOrFail($id)->delete();
        toastr()->timeOut(5000)->success('Color deleted successful');
        return redirect()->back();
    }
}
