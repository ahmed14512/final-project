<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // View cart
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())
                         ->with('product')
                         ->get()
                         ->filter(fn($i) => $i->product !== null);

        $total      = $cartItems->sum(fn($i) => $i->product->price * $i->quantity);
        $shipping   = 350;
        $grandTotal = $total + $shipping;

        return view('pages.cart', compact(
            'cartItems', 'total', 'shipping', 'grandTotal'
        ));
    }

    //------------------add — add product to cart

    public function add(Request $request)
{
    if (!auth()->check()) {
        $back = url()->previous();

        // Remove any existing login_required param
        // before adding it fresh
        $back = preg_replace('/([&?])login_required=\d+/', '', $back);
        $back = rtrim($back, '?&');

        $sep = str_contains($back, '?') ? '&' : '?';
        return redirect($back . $sep . 'login_required=1');
    }

    $product  = Product::findOrFail($request->product_id);
    $cartItem = Cart::where('user_id', auth()->id())
                    ->where('product_id', $product->id)
                    ->first();

    if ($cartItem) {
        return redirect()->back()->with('already_in_cart', true);
    }

    Cart::create([
        'product_id' => $product->id,
        'user_id'    => auth()->id(),
        'quantity'   => 1,
    ]);

    return redirect()->back()->with('added_to_cart', true);
}

    // Buy Now
    public function buyNow(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->back()
                             ->with('guest_add_attempt', true);
        }

        $product  = Product::findOrFail($request->product_id);
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

    // Update quantity
    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:99'
        ]);

        $cart->update(['quantity' => $request->quantity]);

        return redirect()->route('cart.index')
                         ->with('success', 'Cart updated!');
    }

    // Remove single item
    public function remove(Cart $cart)
    {
        $cart->delete();
        return redirect()->route('cart.index')
                         ->with('success', 'Item removed from cart!');
    }

    // Clear entire cart
    public function clear()
    {
        Cart::where('user_id', auth()->id())->delete();
        return redirect()->route('cart.index')
                         ->with('success', 'Cart cleared!');
    }
}