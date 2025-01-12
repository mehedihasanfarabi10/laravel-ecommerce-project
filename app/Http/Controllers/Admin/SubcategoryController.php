<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    //

    public function index()
    {

        $subcategories = DB::table('subcategories')->leftJoin('categories', 'subcategories.category_id', 'categories.id')->select('subcategories.*', 'categories.category_name')->get();
        $category = Category::all();
        return view('admin.pages.subcategory.index', compact('subcategories', 'category'));
    }

    public function store(Request $request)
    {
        Subcategory::create(
            [
                'category_id' => $request->category_id,
                'subcategory_name' => $request->subcategory_name,
                'subcategory_slug' => Str::slug($request->subcategory_name, '-'),
            ]

        );


        // toastr()->success('Subcategory created !!!');
        session()->flash('success', 'Subcategory added successfully!');



        return redirect()->back();
    }

    public function destroy($id)
    {

        $data =  Subcategory::find($id);

        $data->delete();


        toastr()->timeOut(5000)->closeButton()->success('Subcategory deleted successful.');
        // toastr()->closeButton()->success('Category created successful.');

        return redirect()->back();
    }
    public function edit($id)
    {
        $olddata = Subcategory::find($id);
        $category = Category::all();

        if (!$olddata) {
            toastr()->timeOut(5000)->closeButton()->success('Subategory updated error.');
            return redirect()->back();
        }

        return view('admin.pages.subcategory.edit', compact('olddata', 'category'));
    }

    public function update(Request $request, $id)
    {

        $data = Subcategory::find($id);

        $data->category_id = $request->category_id;
        $data->subcategory_name = $request->subcategory_new_name;
        $data->subcategory_slug = Str::slug($request->subcategory_new_name);

        $data->save();
        toastr()->timeOut(5000)->closeButton()->success('Subategory updated successful.');

        return redirect()->route('subcategory.index');
    }
}
