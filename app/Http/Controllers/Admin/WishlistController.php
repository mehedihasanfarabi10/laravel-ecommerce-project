<?php

namespace App\Http\Controllers\Admin;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    //

    public function index()
    {
        $userId = Auth::id();
        if (Auth::id()) {

            $user = Auth::user();

            $userid = $user->id;

            $counts = Wishlist::where('user_id', $userid)->count();
        } else {
            $counts = '';
        }
        
        $wishlistItems = Wishlist::with('product')->where('user_id', $userId)->get();
        return view('home.pages.wishlist', compact('wishlistItems','counts'));
    }


    public function addToWishlist(Request $request)
    {

        $product_id = $request->input('product_id'); // Get product_id from the request

        if (Auth::check()) {
            $user_id = Auth::id();

            // Check if already in wishlist
            $exists = Wishlist::where('user_id', $user_id)
                ->where('product_id', $product_id)
                ->exists();

            if (!$exists) {
                Wishlist::create([
                    'user_id' => $user_id,
                    'product_id' => $product_id,
                ]);

                toastr()->timeOut(3000)->success('Product added to Wishlist .');
                return redirect()->back();
            }
            toastr()->timeOut(3000)->success('Product already in your Wishlist .');

            return redirect()->back();
            // return response()->json(['error' => 'Product already in wishlist']);
        }

        return response()->json(['error' => 'Please log in to add to wishlist']);
    }

    public function destroy($id)
    {
        $wishlist = Wishlist::findOrFail($id);
        $wishlist->delete();
        
        toastr()->timeOut(3000)->success('Product removed from wishlist!');

        return redirect()->back();
    }
}
