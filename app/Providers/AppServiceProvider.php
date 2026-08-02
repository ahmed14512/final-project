<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

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
             \App\Models\Category::where('status', 1)
                                ->whereHas('products', function($q) {
                                 $q->where('status', 1);
                                })
                                    ->get()
        );

            view()->share('navBrands',
                \App\Models\Brand::where('status', 1)
                ->whereHas('products', function($q) {
                    $q->where('status', 1);
                    })
                        ->get()
        );

            view()->share('navBtmCategories', 
            \App\Models\Category::where('status', 1)->take(4)->get());

        } catch (\Exception $e) {
            view()->share('navCategories', collect());
            view()->share('navBrands', collect());
            view()->share('navBtmCategories', collect());
        }

        catch (\Exception $e) {
        view()->share('navCategories', collect());
        }

        catch (\Exception $e) {
            view()->share('navBrands', collect());
        }

        
    Password::defaults(function () {
        return Password::min(8)              
                       ->mixedCase()     
                       ->numbers();       
    });
    }
}