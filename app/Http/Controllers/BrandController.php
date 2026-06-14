<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::latest()->get();

        return view ('admin.brands.index',
                    compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view ('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request -> validate([
            'name'          => 'required|string|max:255|unique:brands,name',
            'description'   => 'nullable|string',
            'logo'          => 'nullable|image|mimes:jpg,png,jpeg,svg|max:2048',
            'status'        => 'required|boolean',
       ]);

        $logopath = null;

       if ($request -> hasFile('logo')){
            $logopath = $request -> file('logo')
                ->store('brands','public');
        }

        Brand::create([
            'name' => $request -> name,
            'slug' => Str::slug($request->name),
            'description' => $request -> description,
            'logo' => $logopath,
            'status' => $request -> status,
        ]);

        return redirect()->route('admin.brands.index')
                        -> with ('success','Brand created successfully!');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view ('admin.brands.edit',
                    compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $request -> validate([
            'name'          => 'required|string|max:255',
            'description'   => 'nullable|string',
            'logo'          => 'nullable|image|mimes:jpg,png,jpeg,svg|max:2048',
            'status'        => 'required|boolean',
       ]);

       $logopath = null;

       if ($request -> hasFile('logo')){
            $logopath = $request -> file('logo')
                ->store('brands','public');
        }

        $brand -> update([
            'name' => $request -> name,
            'slug' => Str::slug($request->name),
            'description' => $request -> description,
            'logo' => $logopath,
            'status' => $request -> status,
        ]);

        return redirect()->route('admin.brands.index')
                        -> with ('success','Brand updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand -> delete();

            return redirect()->route('admin.brands.index')
                            ->with('success','Brand deleted successfully!');    
    }
}
