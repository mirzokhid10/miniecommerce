<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {

        $sliders = Cache::rememberForever('sliders', function () {
            return Slider::where('status', 1)->orderBy('serial', 'asc')->get();
        });

        $categories = Cache::rememberForever('categories', function () {
            return Category::with(['translations', 'children.translations', 'children.children.translations'])
                ->whereNull('parent_id')
                ->where('status', 1)
                ->orderBy('order', 'asc')
                ->get();
        });

        $typeBaseProducts = $this->getTypeBaseProduct();


        return view('frontend.home.home', compact('sliders', 'categories', 'typeBaseProducts'));
    }

    public function getTypeBaseProduct()
    {
        $typeBaseProducts = [];
        // withAvg('reviews', 'rating')->withCount('reviews')->
        $typeBaseProducts['new_arrival'] = Product::with(['variant', 'category', 'productImageGallery'])
            ->where(['product_type' => 'new_arrival', 'is_approved' => 1, 'status' => 1])
            ->orderBy('id', 'DESC')->take(8)->get();

        // withAvg('reviews', 'rating')->withCount('reviews')->
        $typeBaseProducts['featured_product'] = Product::with(['variant', 'category', 'productImageGallery'])
            ->where(['product_type' => 'featured_product', 'is_approved' => 1, 'status' => 1])
            ->orderBy('id', 'DESC')->take(8)->get();

        // withAvg('reviews', 'rating')->withCount('reviews')->
        $typeBaseProducts['top_product'] = Product::with(['variant', 'category', 'productImageGallery'])
            ->where(['product_type' => 'top_product', 'is_approved' => 1, 'status' => 1])
            ->orderBy('id', 'DESC')->take(8)->get();

        // withAvg('reviews', 'rating')->withCount('reviews')->
        $typeBaseProducts['best_product'] = Product::with(['variant', 'category', 'productImageGallery'])
            ->where(['product_type' => 'best_product', 'is_approved' => 1, 'status' => 1])
            ->orderBy('id', 'DESC')->take(8)->get();
        return $typeBaseProducts;
    }

    public function login()
    {
        return view('auth.login');
    }
}
