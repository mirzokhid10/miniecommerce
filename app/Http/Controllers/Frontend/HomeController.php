<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
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

        return view('frontend.home.home', compact('sliders', 'categories'));
    }

    public function lgoin()
    {
        return view('auth.login');
    }
}
