<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $categories = Category::latest()->get();

        return view ('admin.categories.index',
            compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate ([

            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        $imagepath = null;

        if ($request -> hasFile('image')){
            $imagepath = $request -> file('image')
                                -> store('categories', 'public');
        }


        //save to database
        Category::create ([
            'name' => $request-> name,
            'slug' => Str::slug ($request->name),
            'description' => $request -> description,
            'image' => $imagepath,
            'status' => $request -> status,
        ]);
        

        return redirect() -> route ('admin.categories.index')
                            -> with ('success','Category created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view ('admin.categories.edit',
                    compact ('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request -> validate ([

            'name' => 'required|string|max:255',
            'description' => 'nullable | string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,svg|max:2048',
            'status' => 'required | boolean',
        ]);

        $imagepath = $category -> image;

        if($request -> hasFile('image')){
            $imagepath = $request -> file('image')
                                    -> store('categories','public');
        }

        $category->update ([
            'name' => $request -> name,
            'slug' => Str::slug($request-> name),
            'description' => $request -> description,
            'image' => $imagepath,
            'status' => $request -> status,
        ]);

        return redirect() -> route('admin.categories.index')
                            -> with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category -> delete();

        return redirect() -> route ('admin.categories.index')
                    ->with ('success', 'Category deleted successfully!');
    }
}
