<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;

class CheckoutController extends Controller
{    
    //-------------------------------index    
     public function index() {
        
        $cartData= $this->getCartData();

        // blovk out of stock products
        $hasOutOfStock = $cartData['cartItems']
                     ->contains(fn($i) => $i->product->stock == 0);

             if ($hasOutOfStock) {
                return redirect()->route('cart.index')
                        ->with('error',
                        'Remove out of stock items before checkout.');
    }

        $address = Address::where('user_id', auth()->id())->first();
        $user      = auth()->user();

        return view('pages.checkout', 
                    array_merge($cartData, compact('address', 'user')));
     }

     //-------------------------------save address  
     public function saveAddress(Request $request){
          
        $request->validate([
            'name'     => [
                    'required',
                    'string',
                    'max:255',
                    'regex:/^[a-zA-Z\s]+$/',
                ],


            'phone'     => [
                'required',
                'digits:10',
            ],

            'email'     => [
                'required',
                'email:rfc',
                'max:255',
            ],
        
            'city'      => [
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
        'name.required' => 'Name is required',
        'name.regex'    => 'Name must contain letters only',
        'phone.required'      => 'Phone number is required',
        'phone.digits'        => 'Phone number must be exactly 10 digits',
        'email.required'      => 'Email address is required',
        'email.email'         => 'Please enter a valid email address e.g. user@example.com',
        'city.required'       => 'City is required',
        'city.regex'          => 'City name must contain letters only',
        'zip_code.required'   => 'Zip code is required',
        'zip_code.digits'     => 'Zip code must be exactly 5 digits.',
        'street_address.required' => 'Street address is required.', 
          ]);

          Address::updateOrCreate(
               [ 'user_id' => auth()->id()],
          $request->only([
               'name', 'phone' , 'email' , 'city', 'zip_code', 'street_address'
          ])         
          );

          return redirect()->route('payment.index');
     }

     //-------------------------------payment   
     public function payment() {
        
          $cartData= $this->getCartData();
          return view('pages.payment', $cartData);
     }


     //------------------------------------------store   
     public function store(Request $request)
    {
        $cartData = $this->getCartData();
    
        $cart     = $cartData['cartItems'];
        $subtotal = $cartData['total'];
        $shipping = $cartData['shipping'];
        $total    = $cartData['grandTotal'];


        if ($cart->isEmpty()) {
            return redirect()->route('cart.index')
                             ->with('error', 'Your cart is empty.');
        }

        $address = Address::where('user_id', auth()->id())->first();

        if (!$address) {
            return redirect()->route('checkout.index')
                             ->with('error', 'Please add a shipping address first.');
        }


        // order snapshot
        $order = Order::create([
            'user_id'        => auth()->id(),
            'name'           => $address->name,
            'phone'          => $address->phone,
            'email'          => $address->email,
            'city'           => $address->city,
            'zip_code'       => $address->zip_code,
            'street_address' => $address->street_address,
            'subtotal'       => $subtotal,
            'shipping'       => $shipping,
            'total'          => $total,
            'status'         => 'pending',
        ]);


        // product snapshot
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id'     => $order->id,
                'product_id'   => $item->product->id,
                'product_name' => $item->product->name,
                'image'        => $item->product->image,
                'price'        => $item->product->price,
                'quantity'     => $item->quantity,
            ]);
        }


        // delete the cart
        Cart::where('user_id', auth()->id())->delete();

        // order confirmation email
            Mail::to($order->email)
            ->send(new OrderConfirmationMail($order));

        return redirect()->route('order.success', $order->id);
    }

    //-------------------------------cart data (from Cart contrl)   
     private function getCartData(){
          
          $cartItems = Cart::where('user_id', auth()->id())
                              ->with('product')
                              ->get();

 
          $total = $cartItems -> sum(function($item){
                    return $item->product->price * $item->quantity;
          });

          $shipping = 350;
          $grandTotal = $total + $shipping;

          return compact('cartItems', 'total', 'shipping', 'grandTotal' );
     }      
}
