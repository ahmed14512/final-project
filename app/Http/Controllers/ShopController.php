<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ShopController extends Controller
{
    public function index(Request $request){
            $query = Product::with('category','brand')
                        ->where('status', 1);


            // Search
            if ($request->filled('search')) {
                $query->where(function($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%')

                    ->orWhere('description', 'like', '%' . $request->search . '%')

                    ->orWhereHas('category', function($cat) use ($request) {
                        $cat->where('name', 'like', '%' . $request->search . '%');
                    })
                    
                    ->orWhereHas('brand', function($brand) use ($request) {
                        $brand->where('name', 'like', '%' . $request->search . '%');
                    });
                });
            }             

            //filter by category
            if($request->has('category')){
                $query->wherein('category_id',$request->category);
            }

            //filter by brand
            if($request->has('brand')){
                $query->wherein('brand_id',$request->brand);
            }


            //sorting
            if($request->sort==='price-lh'){
                $query->orderBy('price','asc');
            }
            elseif($request->sort==='price-hl'){
                $query->orderBy('price','desc');
            }
            else{
                 $query->latest();
            }

            $products = $query->paginate(12);

            //category ha atleast 1 product
            $categories = Category::where('status',1)
                                    ->whereHas('products',function($q) {
                                    $q->where('status', 1);
                                    })
                                    ->get();
            
            //brand has atleast 1 product
            $brands = Brand::where('status',1)
                                    ->whereHas('products',function($q) {
                                    $q->where('status', 1);
                                    })
                                    ->get();

            

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
