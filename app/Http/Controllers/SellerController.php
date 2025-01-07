<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    //

    public function showLogin()
    {
        return view('sellers.auth.login');
    }

    // Handle login logic
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('seller')->attempt($credentials)) {

            $request->session()->regenerate();
            toastr()->timeOut(5000)->success('Seller Log In Successful');
            return redirect()->route('seller.dashboard');
        }
        toastr()->timeOut(5000)->warning('Email/Password did not matched with our records. Please try again.');
        return redirect()->route('seller.login')->withErrors(['email' => 'Invalid credentials.']);
    }

    // Show the seller dashboard
    public function dashboard()
    {
        //  return view('seller.partials.index');
        return view('sellers.pages.dashboard');
    }

    // Show the seller registration form
    public function showRegisterForm()
    {
        return view('sellers.auth.register');
    }

    // Handle seller registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:sellers,email',
            'phone' => 'required|string|max:255',
            'business' => 'required|string|max:255',
            'password' => 'required|confirmed|min:6',
        ]);

        // Create the seller
        Seller::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'business' => $request->business,
            'address' => $request->address,

            'password' => Hash::make($request->password),
        ]);
        toastr()->timeOut(5000)->success('Your account has been created. Thank you!');
        return redirect()->route('seller.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('seller')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        toastr()->timeOut(5000)->success('You have been logged out.');
        return redirect()->route('sellers.login');
    }
}
