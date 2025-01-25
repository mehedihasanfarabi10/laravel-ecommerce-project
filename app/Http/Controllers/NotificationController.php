<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    //



    // public function placeOrder(Request $request) {
    //     // Your order placement logic here

    //     // Add notification for admin
    //     Notification::create([
    //         'title' => 'New Order Placed',
    //         'message' => 'A new order has been placed by ' . $request->user()->name,
    //     ]);
    // }

    public function getNotifications()
    {
        return Notification::where('is_read', false)->latest()->take(10)->get();
    }

    public function clearNotifications()
    {
        // Use bulk delete to remove all notifications
        Notification::query()->delete();

        // toastr()->success('Notifications cleared');



        return redirect()->back()->with('success','Notifications cleared');
    }
}
