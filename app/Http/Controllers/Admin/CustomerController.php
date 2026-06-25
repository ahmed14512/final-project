<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class CustomerController extends Controller
{   
    public function index(){
        $customers = User::where('role','customer')
                        ->withCount('orders')
                        ->withSum('orders','total')
                        ->latest()
                        ->get();

        return view('admin.customers.index', compact('customers'));
    }

    public function show(User $customer){
            $orders = $customer->orders()
                            ->with('items')
                            ->latest()  
                            ->get();

        return view('admin.customers.show', compact('customer','orders'));
    }
}
