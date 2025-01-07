<?php

namespace App\Http\Controllers\Home;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    //
    
    public function shop()
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
    


        return view('home.pages.shop', compact('product','count','latestProducts', 'featuredProducts', 'hotDeals', 'womensCollection'));
    }
    public function contact()
    {

        $product = Product::all();

        if (Auth::id()) {

            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id', $userid)->count();
        } else {
            $count = '';
        }

        return view('home.pages.contact', compact('product', 'count'));
    }
    public function why()
    {

        $product = Product::all();

        if (Auth::id()) {

            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id', $userid)->count();
        } else {
            $count = '';
        }

        return view('home.pages.why', compact('product','count'));
    }
    public function testimonial()
    {
        $product = Product::all();

        if (Auth::id()) {

            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id', $userid)->count();
        } else {
            $count = '';
        }

        return view('home.pages.testimonial',compact('product','count'));
    }
}
