<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ShopController extends Controller
{
    public function index(Request $request){
            $quary = Product::with('category','brand')
                        ->where('status', 1);

            //filter by category
            if($request->has('category')){
                $quary->wherein('category_id',$request->category);
            }

            //filter by brand
            if($request->has('brand')){
                $quary->wherein('brand_id',$request->brand);
            }


            //sorting
            if($request->sort==='price-lh'){
                $quary->orderBy('price','asc');
            }
            elseif($request->sort==='price-hl'){
                $quary->orderBy('price','desc');
            }
            else{
                 $quary->latest();
            }

            $products = $quary->paginate(12);

            $categories = Category::where('status',1)->get();
            $brands = Brand::where('status',1)->get();

            

            return view ('pages.products',
                        compact('products','categories','brands'));
    }

    //shiw single product
    public function show($id){
        $product = Product::with('category','brand','images')
                            ->where('status',1)
                            ->findOrFail($id);

    return view('pages.product', compact('product'));
    }
}
