<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Wishlist;
use Illuminate\Support\Str;
use App\Models\Notification;
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

        // Check if the shipping address is present in the request
        $shippingAddress = $request->input('shipping_address', []);

        // If shipping address is not empty, proceed
        if ($request->has('use_address') && $request->use_address) {
            // Prepare the shipping details as an array
            $shippingDetails = [
                'first_name' => $shippingAddress['first_name'] ?? null,
                'last_name' => $shippingAddress['last_name'] ?? null,
                'street_address' => $shippingAddress['street_address'] ?? null,
                'district' => $shippingAddress['district'] ?? null,
                'country' => $shippingAddress['country'] ?? null,
                'postcode' => $shippingAddress['postcode'] ?? 'N/A',
            ];
        } else {
            // If shipping address is missing, set default values or handle the case
            $shippingDetails = [
                'first_name' => 'N/A',
                'last_name' => 'N/A',
                'street_address' => 'N/A',
                'district' => 'N/A',
                'country' => 'N/A',
                'postcode' => 'N/A',
            ];
        }
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

            $date = now()->format('dmY'); // Format: ddmmyyyy

            // Generate a random unique identifier or sequential number
            $uniqueId = Str::random(6); // 7 random characters (adjust length as needed)
            $uniqueNumber = rand(100000, 999999); // Generates a random number between 1000000 and 9999999
            // Combine them into the order number
            $orderNumber = '#' . strtoupper($uniqueId) . '_' . $date . '_' . $uniqueNumber; // Uppercase for consistency
            $order->order_number = $orderNumber;

            // Store the shipping details as a JSON object
            $order->shipping_details = json_encode($shippingDetails);

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

        // When User Place a Order then also make a notification

        // Add notification for admin
        Notification::create([
            'title' => 'New Order Placed',
            'message' => 'A new order has been placed by ' . $request->user()->name.'. Order Number is '.$order->order_number,
        ]);

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
        $orders = Order::where('phone', 'LIKE', '%' . $search . '%')
                        ->orWhere('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('order_number', 'LIKE', '%' . $search . '%')
                        ->paginate(10);

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



    public function tracking(Request $request)
    {


        return view('home.pages.trackings');
    }
    public function track_order(Request $request)
    {
        $search = $request->search;

        // If no search query, pass an empty collection
        if (empty($search)) {
            $orders = collect(); // Empty collection
        } else {
            // Fetch orders based on the search query
            $orders = Order::where('order_number', 'LIKE', '%' . $search . '%')
                ->orWhere('phone', 'LIKE', '%' . $search . '%')
                ->paginate(10);
        }

        return view('home.pages.track_order', compact('orders'));
    }
}
