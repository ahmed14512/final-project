<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{        
     public function index() {
        
          $cartItems= $this -> getCartData();

          $address = Address::where('user_id', auth()->id())->first();
          return view('pages.checkout', 
                    array_merge($cartItems, compact('address')));
     }

     public function saveAddress(Request $request){
          
          $request->validate([
               'first_name'        => 'required|string|max:255',
               'last_name'         => 'required|string|max:255',
               'phone'             => 'required|string|max:9',
               'email'             => 'required|string',
               'city'              => 'required|string|max:255',
               'zip_code'          => 'required|string|max:20',
               'street_address'  => 'required|string|max:255',
          ]);

          Address::updateOrCreate(
               [ 'user_id' => auth()->id()],
          $request->only([
               'first_name', 'last_name', 'phone' , 'email' , 'city', 'zip_code', 'street_address'
          ])         
          );

          return redirect()->route('payment.index');
     }

     public function payment() {
        
          $cartItems= $this->getCartData();
          return view('pages.payment', $cartItems);
     }

     public function store(Request $request)
    {
        $cart = Cart::where('user_id', auth()->id())
                    ->with('product')
                    ->get();

        if ($cart->isEmpty()) {
            return redirect()->route('cart.index')
                             ->with('error', 'Your cart is empty.');
        }

        $address = Address::where('user_id', auth()->id())->first();

        if (!$address) {
            return redirect()->route('checkout.index')
                             ->with('error', 'Please add a shipping address first.');
        }

        $subtotal = $cart->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $shipping = 350;
        $total = $subtotal + $shipping;

        // Create the order — snapshot of address at this moment
        $order = Order::create([
            'user_id'        => auth()->id(),
            'first_name'     => $address->first_name,
            'last_name'      => $address->last_name,
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

        // Create one order_item row per cart item —
        // snapshot of product name/price at this moment
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

        // Clear the cart — order is now permanent,
        // cart's job is done
        Cart::where('user_id', auth()->id())->delete();

        return redirect()->route('order.success', $order->id);
    }


     private function getCartData(){
          //get cart items for logged users
          $cartItems = Cart::where('user_id', auth()->id())
                              ->with('product')
                              ->get();

          //calculate total
          $total = $cartItems -> sum(function($item){
                    return $item->product->price * $item->quantity;
          });

          $shipping = 350;
          $grandTotal = $total + $shipping;

          return compact('cartItems', 'total', 'shipping', 'grandTotal' );
     }      
}
