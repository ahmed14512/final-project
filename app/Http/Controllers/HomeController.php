<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(){
    $products = Product::where('status', 1)
                        ->latest()
                        ->take(8)
                        ->get();

    return view('pages.home', compact('products'));
    }
}
