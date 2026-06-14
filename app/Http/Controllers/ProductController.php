<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // index — show all products
   
    public function index()
    {
        $products = Product::with('category', 'brand')
                           ->latest()
                           ->get();

        return view('admin.products.index',
                     compact('products'));
    }

   
    // create — show add product form
   
    public function create()
    {
        $categories = Category::where('status', 1)->get();
        $brands     = Brand::where('status', 1)->get();

        return view('admin.products.create',
                     compact('categories', 'brands'));
    }

    // store — save new product
   
    public function store(Request $request)
    {

        $request->validate([
            'name'         => 'required|string|max:255|unique:products,name',
            'description'  => 'nullable|string',
            'sku'          => 'required|string|unique:products,sku',
            'category_id'  => 'required|exists:categories,id',
            'brand_id'     => 'required|exists:brands,id',
            'price'        => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'is_featured'  => 'boolean',
            'status'       => 'required|boolean',
            'image'        => 'nullable|image|mimes:jpg,png,jpeg,svg,webp|max:2048',
            'thumbnails'   => 'nullable|array',
            'thumbnails.*' => 'image|mimes:jpg,png,jpeg,svg,webp|max:2048',
        ]);

        // Upload main image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')
                                 ->store('products', 'public');
        }

        // Save product
        $product = Product::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'sku'         => $request->sku,
            'category_id' => $request->category_id,
            'brand_id'    => $request->brand_id,
            'price'       => $request->price,
            'image'       => $imagePath,
            'stock'       => $request->stock,
            'is_featured' => $request->is_featured ?? 0,
            'status'      => $request->status,
        ]);

        // Upload thumbnails
        if ($request->hasFile('thumbnails')) {
            foreach ($request->file('thumbnails') as $thumb) {
                $thumbPath = $thumb->store('products/thumbnails',
                                           'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => $thumbPath,
                ]);
            }
        }

        return redirect()->route('admin.products.index')
                         ->with('success', 'Product created successfully!');
    }

   
    // edit — show edit form
  
    public function edit(Product $product)
    {
        $categories = Category::where('status', 1)->get();
        $brands     = Brand::where('status', 1)->get();

        return view('admin.products.edit',
                     compact('product', 'categories', 'brands'));
    }

  
    // update — save edited product
  
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'         => 'required|string|max:255|unique:products,name,'.$product->id,
            'description'  => 'nullable|string',
            'sku'          => 'required|string|unique:products,sku,'.$product->id,
            'category_id'  => 'required|exists:categories,id',
            'brand_id'     => 'required|exists:brands,id',
            'price'        => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'is_featured'  => 'boolean',
            'status'       => 'required|boolean',
            'image'        => 'nullable|image|mimes:jpg,png,jpeg,svg,webp|max:2048',
            'thumbnails'   => 'nullable|array',
            'thumbnails.*' => 'image|mimes:jpg,png,jpeg,svg,webp|max:2048',
        ]);


        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')
                                 ->store('products', 'public');
        }

   
        $product->update([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'sku'         => $request->sku,
            'category_id' => $request->category_id,
            'brand_id'    => $request->brand_id,
            'price'       => $request->price,
            'image'       => $imagePath,
            'stock'       => $request->stock,
            'is_featured' => $request->is_featured ?? 0,
            'status'      => $request->status,
        ]);

        // Upload new thumbnails
        if ($request->hasFile('thumbnails')) {
            foreach ($request->file('thumbnails') as $thumb) {
                $thumbPath = $thumb->store('products/thumbnails',
                                           'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => $thumbPath,
                ]);
            }
        }

        return redirect()->route('admin.products.index')
                         ->with('success', 'Product updated successfully!');
    }


    // destroy — delete product
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')
                         ->with('success', 'Product deleted successfully!');
    }
}