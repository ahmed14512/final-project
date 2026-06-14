<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;

class ProductImageController extends Controller
{
    public function destory(ProductImage $image){
        $productId = $image->product_id;
        $image -> delete();

        return redirect() -> route('admin.products.edit', $productId)
                        -> with('success', 'Image removed!');
    }
}
