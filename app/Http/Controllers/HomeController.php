<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(){
    $products = Product::where('status', 1)
                        ->latest()
                        ->take(5)
                        ->get();

    $mobilePhones = Product::where('status', 1)
                        ->whereHas('category', function($query){
                        $query->where('name','Mobile Phones');
                        })
                        ->latest()
                        ->take(5)
                        ->get();

    
    $laptops = Product::where('status', 1)
                            ->whereHas('category', function($query){
                            $query->where('name','Computer & Laptops');
                            })
                            ->latest()
                            ->take(5)
                            ->get();                        

    return view('pages.home', compact('products','mobilePhones', 'laptops'));
    }
}
