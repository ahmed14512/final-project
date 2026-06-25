<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
   public function index() {
        //Orders count
        $totalOrders = Order::count();

        //sum of all order totals
        $totalRevenue = Order::sum('total');

        $totalCustomers = User::where('role','customer')->count();

        $totalProducts = Product::count();

        $recentOrders = Order::with('user')
                        ->latest()
                        ->take(5)
                        ->get();
        
        return view('admin.dashboard', compact(
            'totalOrders',
            'totalRevenue',
            'totalCustomers',
            'recentOrders',
            'totalProducts',

        ));
   }
}
