<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Address;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    
    public function index(){
        $orders = Order::where('user_id', auth()->id())
                        ->with('items')
                        ->latest()
                        ->get();

        $address = Address::where('user_id', auth()->id())
                                ->first();

        $user = auth()->user();

        return view('pages.my-account', compact('orders','address', 'user'));
    }

    
    
    public function updateProfile(Request $request){
        $user = auth()->user();

        $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|unique:users,email,'.$user->id,
            'phone'            => 'nullable|string|max:20',
        ]);

        $user->update($request->only('name','email','phone'));

        return redirect()->route('account.index')
                        ->with('success', 'Profile updated successfully!');
    }

    public function updatePassword (Request $request){
        
        $user = auth()->user();

        $request->validate([
            'current_password'      => 'required',
            'new_password'          => 'required|string|min:8|confirmed',  
        ]);

        if(!Hash::check($request->current_password, $user->password)){
            return redirect()->route('account.index')
                    ->with('error','current password is incorrect');
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('account.index')
                    ->with('success','password updated successfully!');

    }


    public function saveAddress(Request $request){
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone'          => 'required|string|max:20',
            'email'          => 'required|email',
            'city'           => 'required|string|max:255',
            'zip_code'       => 'required|string|max:20',
            'street_address' => 'required|string|max:255',
        ]);

        Address::updateOrCreate([
            'user_id' => auth()->id()
        ],
        
        $request->only([
            'first_name', 'last_name', 'phone',
            'email', 'city', 'zip_code', 'street_address'
        ])
        
        );

        return redirect()->route('account.index')
                    ->with('success','Address saved successfully!');
    } 


}
