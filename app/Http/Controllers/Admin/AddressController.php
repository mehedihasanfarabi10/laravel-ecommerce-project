<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    //

    // public function edit($id){

    //     $address = Address::findOrFail($id);


    //     return view('home.customer.editaddress',compact('address'));
    // }

    public function store(Request $request)
    {
        // $request->validate([
        //     'first_name' => 'required|string|max:255',
        //     'last_name' => 'required|string|max:255',
        //     'country' => 'required|string',
        //     'street_address' => 'required|string',
        //     'district' => 'required|string',
        //     'phone' => 'required|string|max:20',
        //     'email' => 'required|email|max:255',
        // ]);

        if ($request) {
            Address::create([
                'user_id' => Auth::id(),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'country' => $request->country,
                'street_address' => $request->street_address,
                'district' => $request->district,
                'postcode' => $request->postcode,
                'phone' => $request->phone,
                'email' => $request->email,
            ]);
        } else {
            toastr()->warning('Address created failed');
        }

        toastr()->success('Address created successfully');
        return redirect()->back()->with('success', 'Address saved successfully!');
    }

    public function update(Request $request, $id)
    {
        $address = Address::findOrFail($id);
        $address->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'street_address' => $request->street_address,
            'district' => $request->district ?  $request->district: $address->district,
            'country' => $request->country,
            'postcode' => $request->postcode,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);
        toastr()->success('Address updated successfully');
        return redirect()->back()->with('success', 'Address updated successfully!');
    }
}
