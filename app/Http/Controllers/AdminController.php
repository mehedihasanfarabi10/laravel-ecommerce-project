<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Color;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\Seller;
use App\Models\Size;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

// use Flasher\Prime\FlasherInterface;

class AdminController extends Controller
{
    //

    public function index()
    {

        $user = User::where('usertype', 'user')->get()->count();

        $product = Product::get()->count();

        $order = Order::get()->count();

        $delivered = Order::where('status', 'Delivered')->get()->count();

        $seller = Seller::where('usertype', 'seller')->get()->count();



        // return view('admin.index', compact('user', 'product', 'order', 'delivered'));
        return view('admin.dashboard', compact('user', 'product', 'order', 'delivered', 'seller'));
    }


    public function seller_details()
    {

        $sellers = Seller::all();
        // toastr()->timeOut(5000)->success('All seller data');
        return view('admin.pages.seller_details', compact('sellers'));
    }


    public function user_details()
    {

        $users = User::all();
        // toastr()->timeOut(5000)->success('All user data');
        return view('admin.pages.user_detail', compact('users'));
    }

    public function edit_seller($id)
    {
        $seller = Seller::findOrFail($id);
        return view('admin.pages.edit_seller', compact('seller'));
    }

    public function delete_seller($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->delete();
        toastr()->timeOut(5000)->success('Seller deleted successfully.');
        return redirect()->route('seller.details');
    }

    public function activate_seller($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->is_active = true;
        $seller->save();

        toastr()->success('Seller activated successfully.');
        return redirect()->route('seller.details');
    }

    public function toggleSellerStatus($id)
    {
        // Find the seller by ID
        $seller = Seller::findOrFail($id);

        // Toggle the is_active status
        $seller->is_active = !$seller->is_active;
        $seller->save();

        // Provide feedback to the admin
        $status = $seller->is_active ? 'activated' : 'deactivated';
        toastr()->success("Seller has been $status successfully.");

        // Redirect back to the seller details page
        return redirect()->route('seller.details');
    }

    public function delete_user($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        toastr()->timeOut(5000)->success('User deleted successfully.');
        return redirect()->route('users.details');
    }
}
