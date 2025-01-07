<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //

    public function view_orders()
    {
        $orders = Order::whereHas('product') // Ensure the product relationship exists
            ->with('product', 'user') // Load related product and user data
            ->get();

        return view('admin.pages.orders', compact('orders'));
    }



    public function on_the_way($id)
    {
        $order = Order::find($id);

        $order->status = 'On The Way';

        $order->save();

        return redirect('/view_orders');
    }

    public function delievered($id)
    {
        $order = Order::find($id);

        $order->status = 'Delivered';

        $order->save();

        return redirect('/view_orders');
    }

    public function cancelled($id)
    {
        $order = Order::find($id);

        $order->status = 'Cancelled';

        $order->save();

        return redirect('/view_orders');
    }

    public function print_pdf($id)
    {
        $order = Order::with('product', 'user')->findOrFail($id);

        // Data to pass to the view
        $data = [
            'order' => $order,
        ];

        $pdf = Pdf::loadView('admin.pages.invoice', $data);

        // Download the generated PDF
        // return $pdf->download('invoice_' . $order->id . '.pdf');

        // $pdf = Pdf::loadView('admin.invoice',);
        return $pdf->download('invoice.pdf');
    }

    public function print_pdf_user($id)
    {
        $order = Order::with('product', 'user')->findOrFail($id);

        // Data to pass to the view
        $data = [
            'order' => $order,
        ];

        $pdf = Pdf::loadView('home.pages.invoice', $data);
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOption('isHtml5ParserEnabled', true);
        $pdf->setOption('isRemoteEnabled', true);
        
        // Download the generated PDF
        return $pdf->download('invoice_' . $order->id . '.pdf');

        
        // return $pdf->download('invoices.pdf');
    }

    public function delete_order($id)
    {

        $order = Order::findOrFail($id);

        $order->delete();

        toastr()->timeOut(10000)->closeButton()->success('Order deleted successful.');

        return redirect()->back();
    }

    public function place_order(Request $request)
    {
        $name = $request->receiver_name;
        $address = $request->receiver_address;
        $phone = $request->phone;

        $userid = Auth::user()->id;

        $cart = Cart::where('user_id', $userid)->get();


        foreach ($cart as $carts) {
            $order = new Order();
            $order->name = $name;
            $order->rec_address = $address;
            $order->phone = $phone;
            $order->price = $carts->product->price; // Current product price
            // Calculate total price
 // Assuming a `price` column exists in the `products` table
            $order->quantity = $carts->quantity; // Assuming a `quantity` column exists in the `cart` table
            $order->size = $carts->size;
            $order->color = $carts->color;
            $order->user_id = $userid;
            $order->product_id = $carts->product_id;

            $order->save();
        }

        $cart_remove = Cart::where('user_id', $userid)->get();

        foreach ($cart_remove as $remove) {
            $cart = Cart::find($remove->id);
            //Cart table theke order korar por sei cart table theke data remove kore dey
            $cart->delete();
        }

        toastr()->timeOut(5000)->success('Order has been placed!');

        return redirect()->back();
    }

    public function order_search(Request $request)
    {


        $search = $request->search;
        // viewproduct e je variable use kora hoyece setai use korte hobe productData
        $orders = Order::where('phone', 'LIKE', '%' . $search . '%')->orWhere('name', 'LIKE', '%' . $search . '%')->paginate(10);

        return view('admin.pages.orders', compact('orders'));
    }


    public function myorders()
    {
        if (Auth::id()) {

            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id', $userid)->count();
        } else {
            $count = '';
        }

        $user = Auth::user()->id;

        // $orders = Order::where('user_id', $user)
        //     ->whereHas('product') // Ensures only orders with valid products are fetched
        //     ->with('product')
        //     ->get();

        // Eager load 'cart', 'product', and include 'size' and 'color' from the Cart
        // $orders = Order::where('user_id', $user)
        //     ->whereHas('cart.product')  // Ensure orders have valid product in cart
        //     ->with(['cart.product', 'cart']) // Eager load product and cart
        //     ->get();

        // Fetch orders with cart details and product
        // $orders = Order::where('user_id', $user)
        //     ->with(['product', 'cart']) // Eager load product and cart details
        //     ->get();


        // Fetch orders with related cart, size, and color details
        $orders = Order::where('user_id', $user)
            ->with(['product']) // Eager-load size and color via cart
            ->get();

        return view('home.orders.myorders', compact('count', 'orders'));
    }
}
