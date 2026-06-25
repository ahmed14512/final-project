<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
     public function index() {
        
          //get cart items for logged users
          $cartItems = Cart::where('user_id', auth()->id())
                              ->with('product')
                              ->get();

          //calculate total
          $total= $cartItems -> sum(function($item){
                    return $item->product->price * $item->quantity;
          });

          $shipping = 350;
          $grandTotal = $total + $shipping;

          return view('pages.cart', compact('cartItems', 'total', 'shipping', 'grandTotal' ));
                    
     }
     
     //------------------add — add product to cart

     public function add (Request $request) {

          if(!auth()->check()){
              return redirect()->back()
                         ->with('guest_add_attempt', true);
          }    

          $product = Product::findOrFail($request->product_id);

          //check if product already in the cart
          $cartItems = Cart::where('user_id', auth()->id())
                              ->where('product_id',$product->id)
                              ->first();

          if($cartItems){
                return redirect()->back()
                         ->with('already_in_cart', true);

          }
          
          if($cartItems){
               $cartItems->increment('quantity');
          } else
          
          {
               Cart::create([
                    'product_id' => $product->id,
                    'user_id' => auth()->id(),
                    'quantity' => 1
               ]);
          }

          return redirect()->back()
                         ->with('added_to_cart', true);
          
     }

     //-----------------------buy now
     public function buyNow(Request $request)
     {
     if (!auth()->check()) {
          return redirect()->back()
                              ->with('guest_add_attempt', true);
     }

     $product = Product::findOrFail($request->product_id);

     $cartItem = Cart::where('user_id', auth()->id())
                         ->where('product_id', $product->id)
                         ->first();

     if (!$cartItem) {
          Cart::create([
               'product_id' => $product->id,
               'user_id'    => auth()->id(),
               'quantity'   => 1,
          ]);
     }

     return redirect()->route('cart.index');
     }

     //-----------------------update item quantity
     public function update(Request $request, Cart $cart){
          $request->validate([
               'quantity' => 'required|integer|min:1|max:99'
          ]);

          $cart->update([
               'quantity' => $request->quantity,
          ]);

          return redirect()->route('cart.index')
                         ->with('success', 'Cart updated!');
     }


     //----------------remove cart
     public function remove(Cart $cart){
          $cart->delete();

          return redirect()->route('cart.index')
                         ->with('success', 'Item removed from cart!');
     }


     // //----------------------clear cart
     // public function clear(){
     //      Cart::where('user_id', auth()->id())->delete();
          
     //      return redirect()->route('cart.index')
     //                     ->with('success', 'Cart cleared!');
     // }


}

