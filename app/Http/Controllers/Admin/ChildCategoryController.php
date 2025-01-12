<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ChildCategoryController extends Controller
{

    public function index(Request $request)
    {
        // if ($request->ajax()) {
        //     $data = DB::table('childcategories')
        //         ->leftJoin('categories', 'childcategories.category_id', '=', 'categories.id')
        //         ->leftJoin('subcategories', 'childcategories.subcategory_id', '=', 'subcategories.id')
        //         ->select(
        //             'childcategories.id as childcategory_id',
        //             'childcategories.childcategory_name',
        //             'categories.category_name',
        //             'subcategories.subcategory_name'
        //         )
        //         ->get();
    
        //     return DataTables::of($data)
        //         ->addIndexColumn()
        //         ->addColumn('action', function ($row) {
        //             return '<a href="' . url('edit_childcategory', $row->childcategory_id) . '" class="btn btn-success">Edit</a> 
        //                     <a href="' . url('delete_childcategory', $row->childcategory_id) . '" class="btn btn-danger">Delete</a>';
        //         })
        //         ->rawColumns(['action'])
        //         ->make(true);
        // }

        $categories = Category::all();
        $subcategory = Subcategory::all();
    
        return view('admin.pages.childcategory.index',compact('categories','subcategory'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'childcategory_name' => 'required|string|max:255',
        ]);

        ChildCategory::create([
            'category_id'=>$request->category_id,
            'subcategory_id'=>$request->subcategory_id,
            'childcategory_name'=>$request->childcategory_name,
            'childcategory_slug'=>Str::slug($request->childcategory_name,'-'),

        ]);

        // toastr()->success('Child category added successfully!');
        session()->flash('success', 'Child category added successfully!');

        return redirect()->back();
    }

    public function edit($id){

        $childcategory = ChildCategory::findOrFail($id);
        $category = Category::all();
        $subcategory = Subcategory::all();

        return view('admin.pages.childcategory.edit',compact('childcategory','category','subcategory'));

    }

    public function update(Request $request,$id){

        $data = ChildCategory::find($id);

        $data->category_id = $request->category_id;
        $data->subcategory_id = $request->subcategory_id;
        $data->childcategory_name = $request->childcategory_new_name;
        $data->childcategory_slug = Str::slug($request->childcategory_new_name);

        $data->save();

        session()->flash('success', 'Child category updated successfully!');
        

        return redirect()->route('childcategory.index');

    }

    public function destroy($id){

        $data = ChildCategory::findOrFail($id)->delete();

        session()->flash('success', 'Child category deleted successfully!');

        return redirect()->route('childcategory.index');


    }
    
}
