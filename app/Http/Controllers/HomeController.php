<?php

namespace App\Http\Controllers;

use Stripe;
use Session;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\ProductSize;

use App\Models\ProductColor;
// use Session;

// use Stripe\Stripe;
// use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function home()
    {

        $product = Product::all();

        if (Auth::id()) {

            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id', $userid)->count();
        } else {
            $count = '';
        }
        
        $userId = Auth::id();
        if (Auth::id()) {

            $user = Auth::user();

            $userid = $user->id;

            $counts = Wishlist::where('user_id', $userid)->count();
        } else {
            $counts = '';
        }
        

        $latestProducts = Product::where('is_latest', true)->get();
        $featuredProducts = Product::where('is_featured', true)->get();
        $hotDeals = Product::where('is_hot_deal', true)->get();
        $womensCollection = Product::where('collection', 'Womens')->get();
    
        return view('home.index', compact('product','count','counts','latestProducts', 'featuredProducts', 'hotDeals', 'womensCollection'));
    }

    public function product_search2(Request $request)
    {

        $product = Product::all();

        if (Auth::id()) {

            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id', $userid)->count();
        } else {
            $count = '';
        }

        $latestProducts = Product::where('is_latest', true)->get();
        $featuredProducts = Product::where('is_featured', true)->get();
        $hotDeals = Product::where('is_hot_deal', true)->get();
        $womensCollection = Product::where('collection', 'Womens')->get();
    

        $search = $request->search;
        // viewproduct e je variable use kora hoyece setai use korte hobe productData
        $product = Product::where('title', 'LIKE', '%' . $search . '%')->orWhere('description', 'LIKE', '%' . $search . '%')->paginate(10);

        
        return view('home.index', compact('product','count','latestProducts', 'featuredProducts', 'hotDeals', 'womensCollection'));

        // return view('home.index', compact('product'));
    }


    public function login_home()
    {

        $product = Product::all();

        if (Auth::id()) {

            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id', $userid)->count();
        } else {
            $count = '';
        }

        $latestProducts = Product::where('is_latest', true)->get();
        $featuredProducts = Product::where('is_featured', true)->get();
        $hotDeals = Product::where('is_hot_deal', true)->get();
        $womensCollection = Product::where('collection', 'Womens')->get();
    


        return view('home.index', compact('product','count','latestProducts', 'featuredProducts', 'hotDeals', 'womensCollection'));
    }

    public function updates(Request $request)
    {
        // Get the currently authenticated user
        $user = Auth::user();
    
        // Validate incoming data
        $request->validate([
            'user_name' => 'required|string|max:255',
            'user_phone' => 'required|string|max:15',
            'user_address' => 'required|string|max:255',
        ]);
    
        // Update user details
        $user->name = $request->user_name;
        $user->phone = $request->user_phone;
        $user->address = $request->user_address;
    
        // Save changes to the database
        $user->save();
    
        // Provide feedback to the user
        toastr()->success('User updated successfully');
        return redirect()->back();
    }
    



    // public function ckeditorupload(Request $request)
    // {
    //    if($request->has('upload'))
    //    {
    //     $originName = $request->file('upload')->getClientOriginalName();
    //     $filename = pathinfo($originName,PATHINFO_FILENAME);
    //     $extension = $request->file('upload')->getClientOriginalExtension();
    //     $fileName = $filename.'_'.time().'.'.$extension;


    //     $request->file('upload')->move(public_path('media'),$fileName);
    //     $url = asset('media/'.$fileName);
    //    }

    //    toastr()->success('Image Uploaded');
    //    return redirect()->back();
    // }

}
