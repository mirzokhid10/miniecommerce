<?php

namespace App\Providers;

use App\Models\Category;
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
        view()->composer('frontend.layouts.menu', function ($view) {
            $categories = Category::with([
                'translations',
                'children.translations',
                'children.children.translations'
            ])
                ->whereNull('parent_id')
                ->where('status', 1)
                ->orderBy('order', 'asc')
                ->get();

            $view->with('categories', $categories);
        });
    }
}
