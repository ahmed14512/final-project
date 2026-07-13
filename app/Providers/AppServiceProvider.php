<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        try {
            view()->share('navCategories',
                \App\Models\Category::where('status', 1)->get());

            view()->share('navBrands',
                \App\Models\Brand::where('status', 1)->get());

        } catch (\Exception $e) {
            view()->share('navCategories', collect());
            view()->share('navBrands', collect());
        }
    }
}