<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
   public function success(Order $order)
    {
        // Make sure customers can only see their own order
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('pages.order-success', compact('order'));
    }
}
