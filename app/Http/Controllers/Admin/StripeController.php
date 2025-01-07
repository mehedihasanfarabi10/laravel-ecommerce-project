<?php

namespace App\Http\Controllers\Admin;

use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Cart;
use App\Models\Order;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// use Stripe;

class StripeController extends Controller
{
    //

    
    public function stripe($value)

    {

        return view('home.orders.stripe', compact('value'));
    }

    //     public function stripePost(Request $request, $value)
    // {
    //     \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    //     try {
    //         // Create a Payment Intent
    //         $paymentIntent = \Stripe\PaymentIntent::create([
    //             'amount' => $value * 100, // Amount in cents
    //             'currency' => 'usd',
    //             'payment_method' => $request->paymentMethodId,
    //             'confirmation_method' => 'manual', // For manual confirmation
    //             'confirm' => true,
    //         ]);

    //         return response()->json([
    //             'clientSecret' => $paymentIntent->client_secret,
    //         ]);
    //     } catch (\Stripe\Exception\ApiErrorException $e) {
    //         return response()->json(['error' => $e->getMessage()], 400);
    //     }
    // }


    // public function stripePost(Request $request, $value)
    // {
    //     \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    //     try {
    //         // Create a Payment Intent
    //         $paymentIntent = \Stripe\PaymentIntent::create([
    //             'amount' => $value * 100, // Convert to cents
    //             'currency' => 'usd',
    //             'payment_method' => $request->input('paymentMethodId'),
    //             'confirmation_method' => 'manual',
    //             'confirm' => true,
    //             'description' => 'Test payment successful',
    //         ]);

    //         if ($paymentIntent->status === 'succeeded') {
    //             Session::flash('success', 'Payment successful!');
    //             return response()->json(['success' => true]);
    //         } else {
    //             return response()->json(['error' => 'Payment not completed']);
    //         }
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }



    // public function stripePost(Request $request, $value)
    // {
    //     Stripe::setApiKey(env('STRIPE_SECRET'));

    //     // Create a Payment Intent
    //     $paymentIntent = PaymentIntent::create([
    //         'amount' => $value * 100, // Convert to cents
    //         'currency' => 'usd',
    //         'payment_method' => $request->paymentMethodId,
    //         'confirmation_method' => 'manual',
    //         'confirm' => true,
    //         "description" => "Test payment successful",
    //     ]);

    //     if ($paymentIntent->status === 'succeeded') {
    //         Session::flash('success', 'Payment successful!');
    //         return back();
    //     } else {
    //         return response()->json(['error' => 'Payment not completed'], 400);
    //     }
    // }



    public function stripePost(Request $request, $value)

    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));



        Charge::create([

            "amount" => $value * 100, //100 * 100 = 1$ => 576 * 100 = $576

            "currency" => "usd",

            "source" => $request->stripeToken,

            "description" => "Test payment successful"

        ]);

        $name =Auth::user()->name;
        $address =Auth::user()->address;
        $phone =Auth::user()->phone;
        
        $userid = Auth::user()->id;

        $cart = Cart::where('user_id', $userid)->get();


        foreach ($cart as $carts) {
            $order = new Order();
            $order->name = $name;
            $order->rec_address = $address;
            $order->phone = $phone;
            $order->user_id = $userid;
            $order->product_id = $carts->product_id;

            $order->payment_status = 'Paid';

            $order->save();
        }

        $cart_remove = Cart::where('user_id', $userid)->get();

        foreach ($cart_remove as $remove) {
            $cart = Cart::find($remove->id);
            //Cart table theke order korar por sei cart table theke data remove kore dey
            $cart->delete();
        }

        toastr()->timeOut(5000)->success('Order has been placed!');



        // Session::flash('success', 'Payment successful!');



        return back();
    }


}
