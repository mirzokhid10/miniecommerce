<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendProductController extends Controller
{
    public function productsIndex(Request $request, Product $product)
    {
        $category = null;


        if ($request->has('category')) {
            $category = Category::findBySlug($request->category);
        } elseif ($request->has('subcategory')) {
            $category = Category::findBySlug($request->subcategory);
        } elseif ($request->has('childcategory')) {
            $category = Category::findBySlug($request->childcategory);
        }

        $products = Product::with(['variant', 'category', 'productImageGallery'])
            ->where(['status' => 1, 'is_approved' => 1]);


        if ($category) {
            $products->where('category_id', $category->id);
        }


        if ($request->has('range')) {
            [$from, $to] = explode(';', $request->range);
            $products->whereBetween('price', [$from, $to]);
        }


        if ($request->has('search')) {
            $products->where(function ($q) use ($request) {
                $search = '%' . $request->search . '%';

                $q->where('name', 'like', $search)
                    ->orWhere('long_description', 'like', $search)
                    ->orWhereHas('category.translations', function ($q) use ($search) {
                        $q->where('name', 'like', $search);
                    });
            });
        }

        $products = $products->paginate(8);


        $categories = Category::whereNull('parent_id')
            ->where('status', 1)
            ->get();




        return view('frontend.pages.product', compact('categories', 'products'));
    }

    public function showProduct(string $slug,)
    {
        $product = Product::whereHas('translations', function ($q) use ($slug) {
            $q->where('slug', $slug);
        })
            ->where('status', 1)
            ->with([
                'category',
                'productImageGallery',
                'variant.translations',
                'variant.items.translations'
            ])
            ->first();





        return view('frontend.pages.product-detail', compact('product'));
    }
}
