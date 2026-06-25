<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       view()->share('navCategories', \App\Models\Category::where('status', 1)->get());
        view()->share('navBrands', \App\Models\Brand::where('status', 1)->get());
    }
}
