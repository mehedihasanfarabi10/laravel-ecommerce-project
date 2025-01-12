<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    //

    public function index(){

        $branddata = Brand::get()->all();
        return view('admin.pages.brand.index',compact('branddata'));
    }

    public function brandstore(Request $request){

        $brand = new Brand();

        $brand->name = $request->brand_name;
        $brand->slug = Str::slug($request->brand_name,'-');

        // dd($brand);

        // if ($request->hasFile('brandimage')) {
        //     $image = $request->file('brandimage'); 
        //     $brand_image_name = time().'.'.$image->getClientOriginalExtension();
        //     $image->move(public_path('brands'), $brand_image_name); 
        //     $brand->logo = $brand_image_name; 
        // }

            $logoName = null;
            if (isset($request->brandimage)) {
                $logoName = time() . '.' . $request->brandimage->extension();
                $request->brandimage->move(public_path('brands'), $logoName);
            }

            $brand->logo = $logoName;


        
        $brand->description = $request->description;

        

        $brand->save();

        toastr()->success('Brand created successful');
        return redirect()->back();

    }

    public function delete($id){
        $data = Brand::findOrFail($id);

        $data->delete();

        
        toastr()->success('Brand deleted successful');
        return redirect()->back();
    }

    public function edit($id){

        $branddata = Brand::findOrFail($id);
        return view('admin.pages.brand.edit',compact('branddata'));
    }

    public function update(Request $request,$id){

        $brand = Brand::findOrFail($id);

        $brand->name = $request->brand_name;
        $brand->slug = Str::slug($request->brand_name,'-');


           
            if (isset($request->brandimage)) {
                $logoName = null;
                $logoName = time() . '.' . $request->brandimage->extension();
                $request->brandimage->move(public_path('brands'), $logoName);
                $brand->logo = $logoName;

            }else{
                $brand->logo;
            }

            


        
        $brand->description = $request->description;

        $brand->save();

        toastr()->success('Brand updated successful');
        return redirect()->route('brand.index');

    }
}
