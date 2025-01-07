<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function add_to_cart(Request $request, $id)
    {

        $product_id = $id;

        $user = Auth::user();

        $user_id = $user->id;

        // $data = new Cart();

        // $data->user_id = $user_id;

        // $data->product_id = $product_id;

        // $cart = new Cart();
        // $cart->user_id = Auth::id();
        // $cart->product_id = $request->id;
        // $cart->size = $request->size; // Store size ID directly
        // $cart->color = $request->color; // Store color ID directly
        // $cart->quantity = $request->quantity;

        // $carts = Cart::all();

        // foreach ($carts as $cart) {
        //     if (strpos($cart->size, ',') !== false) {
        //         $sizes = explode(',', $cart->size);
        //         $cart->size = $sizes[0]; // Keep the first value
        //     }

        //     if (strpos($cart->color, ',') !== false) {
        //         $colors = explode(',', $cart->color);
        //         $cart->color = $colors[0]; // Keep the first value
        //     }

        //     $cart->save();
        // }

        // $cart->save();


        // Check if the product is already in the cart
        $existingCartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $id)
            ->where('size', $request->size)
            ->where('color', $request->color)
            ->where('quantity', $request->quantity)
            ->first();

        if ($existingCartItem) {
            // If the item already exists, just update the quantity
            $existingCartItem->quantity += $request->quantity;
            $existingCartItem->save();
        } else {
            // Create a new cart item
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $id,
                'size' => $request->size,
                'color' => $request->color,
                'quantity' => $request->quantity,
            ]);
        }




        toastr()->timeOut(10000)->success('Add to Cart Successful');

        // $data->save();
        // return redirect()->route('add.cart')->with('success', 'Add to Cart Successful');
        return redirect()->back();
    }

    public function mycart()
    {



        if (Auth::id()) {

            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id', $userid)->count();
        } else {
            $count = '';
        }

        $cart = Cart::where('user_id', $userid)->get();

        return view('home.orders.mycart', compact('count', 'cart'));
    }

    public function remove($id)
    {
        try {
            // Find the cart item by ID
            $cartItem = Cart::findOrFail($id);

            // Optional: Check if the cart item belongs to the logged-in user
            // if (auth()->id() !== $cartItem->user_id) {
            //     return redirect()->back()->with('error', 'Unauthorized action.');
            // }

            // Delete the cart item
            $cartItem->delete();

            // Redirect back with a success message
            toastr()->timeOut(5000)->success('Item Remove Succesful');
            return redirect()->back();
        } catch (\Exception $e) {
            // Handle errors (e.g., item not found)
            toastr()->timeOut(5000)->error('Remove Failed');
            return redirect()->back();
        }
    }

    public function update_cart_quantity(Request $request, $cartId)
    {
        $cart = Cart::find($cartId);

        if ($cart) {
            $cart->quantity = $request->quantity;
            $cart->save();
            toastr()->timeOut(5000)->success('Updated Cart');
            return redirect()->back();
        }
        toastr()->timeOut(5000)->error('Updated Cart Failed');
        return response()->json(['success' => false, 'message' => 'Failed to update cart!']);
    }
}
