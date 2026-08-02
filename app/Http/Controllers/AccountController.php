<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Address;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    //---------------------------------------index
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

    
    //---------------------------------------update
    public function updateProfile(Request $request){
        $user = auth()->user();

        $request->validate([
           'name'  => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\s]+$/',
        ],
            'email' => [
                'required',
                'email:rfc,dns',
                'max:255',
                'unique:users,email,'.$user->id,
        ],
            'phone' => [
                'nullable',
                'digits:10',
        ],
    ], [
        'name.required'  => 'Name is required.',
        'name.regex'     => 'Name must contain letters only.',
        'email.required' => 'Email address is required.',
        'email.email'    => 'Please enter a valid email address e.g. user@example.com',
        'email.unique'   => 'This email address is already used by another account.',
        'phone.digits'   => 'Phone number must be exactly 10 digits.',
        ]);

        $user->update($request->only('name','email','phone'));

        return redirect()->route('account.index')
                        ->with('success', 'Profile updated successfully!');
    }



    //---------------------------------------update pw
    public function updatePassword (Request $request){
        
        $user = auth()->user();

        $request->validate([
            'current_password' => [
                'required',
        ],
            'new_password'     => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-zA-Z])(?=.*[0-9]).+$/',
        ],
    ], [
        'current_password.required' => 'Current password is required.',
        'new_password.required'     => 'New password is required.',
        'new_password.min'          => 'New password must be at least 8 characters.',
        'new_password.confirmed'    => 'New password and confirm password do not match.',
        'new_password.regex'        => 'Password must contain at least one letter and one number e.g. Admin123', 
        ]);

        // cjeck the current pw is correct?
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('account.index')
                            ->with('error', 'Current password is incorrect.');
        }

        // new pw not  equal to older 
        if (Hash::check($request->new_password, $user->password)) {
            return redirect()->route('account.index')
                            ->with('error', 'New password must be different from your current password.');
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('account.index')
                    ->with('success','password updated successfully!');

    }



    public function saveAddress(Request $request){
        $request->validate([
        'name'     => [
            'required',
            'string',
            'max:255',
            'regex:/^[a-zA-Z\s]+$/',
        ],

        'phone'          => [
            'required',
            'digits:10',
        ],

        'email'          => [
            'required',
            'email:rfc',
            'max:255',
        ],

        'city'           => [
            'required',
            'string',
            'max:255',
            'regex:/^[a-zA-Z\s]+$/',
        ],
        'zip_code'       => [
            'required',
            'digits:5',
        ],

        'street_address' => [
            'required',
            'string',
            'max:500',
        ],
    ], 
        [
        'name.required' => 'First name is required.',
        'name.regex'    => 'First name must contain letters only.',
        'phone.required'      => 'Phone number is required',
        'phone.digits'        => 'Phone number must be exactly 10 digits without 0',
        'email.required'      => 'Email address is required',
        'email.email'         => 'Please enter a valid email address e.g. user@example.com',
        'city.required'       => 'City is required.',
        'city.regex'          => 'City name must contain letters only',
        'zip_code.required'   => 'Zip code is required.',
        'zip_code.digits'     => 'Zip code must be exactly 5 digits.',
        'street_address.required' => 'Street address is required',
        ]);

        Address::updateOrCreate([
            'user_id' => auth()->id()
        ],
        
        $request->only([
            'name', 'phone',
            'email', 'city', 'zip_code', 'street_address'
        ])
        
        );

        return redirect()->route('account.index')
                    ->with('success','Address saved successfully!');
    } 


}
