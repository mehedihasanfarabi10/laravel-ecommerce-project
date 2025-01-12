<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;



class CategoryController extends Controller
{
    //

    public function view_category()
    {
        // Fetch top-level categories with their children recursively
        $categories = Category::all();

        // If the request is AJAX, return only the content
        if (request()->ajax()) {
            toastr()->success("Data Loaded With Ajax");
            return view('admin.partials.category', compact('categories'))->render();
        }


        toastr()->error('failed to load');
        // Otherwise, return the full layout
        return view('admin.pages.category', compact('categories'));
    }


    public function add_category(Request $request)
    {

        // $validated = $request->validate([
        //     'name' => 'required|string|max:255',

        // ]);

        // $data = array();

        // $data['category_name'] = $request->category;

        // $data['category_slug'] = Str::slug($request->category,'-');


        // Category::create([
        //     'category_name' => $data['category_name'],
        //     'category_slug' => $data['category_slug'],

        // ]);

        Category::create([
            'category_name' => $request->category,
            'category_slug' =>  Str::slug($request->category, '-'),

        ]);

        toastr()->closeButton()->success('Category created successful.');
        // toastr()->closeButton()->success('Category created successful.');

        return redirect()->back();
    }

    public function delete_category($id)
    {

        $data =  Category::find($id);

        $data->delete();


        toastr()->timeOut(5000)->closeButton()->success('Category deleted successful.');
        // toastr()->closeButton()->success('Category created successful.');

        return redirect()->back();
    }

    public function edit($id)
    {

        $olddata =  Category::find($id);

        return view('admin.pages.editcategory', compact('olddata'));
    }
    public function update_category(Request $request, $id)
    {

        $data = Category::find($id);

        $data->category_name = $request->category_new_name;
        $data->category_slug = Str::slug($request->category_new_name);

        $data->save();
        toastr()->timeOut(5000)->closeButton()->success('Category updated successful.');

        return redirect('/view_category');
    }
}
