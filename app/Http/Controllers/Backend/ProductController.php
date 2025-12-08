<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Category;
use App\Services\ProductService;
use Illuminate\Support\Facades\Request;

class ProductController extends Controller
{
    public function index(ProductsDataTable $dataTable)
    {
        return $dataTable->render('admin.products.index');
    }

    public function create()
    {
        $categories = \App\Models\Category::whereNull('parent_id')
            ->where('status', 1)
            ->with('translations')
            ->orderBy('order', 'asc')
            ->get();

        return view('admin.products.create', compact('categories'));
    }


    public function getChildren($parentId)
    {
        $children = \App\Models\Category::with('translations')
            ->where('parent_id', $parentId)
            ->where('status', 1) // Add this to only get active categories
            ->orderBy('order', 'asc')
            ->get()
            ->map(function ($cat) {
                return [
                    'id' => $cat->id,
                    'name' => $cat->name, // accessor returns translation
                ];
            });
        return response()->json($children);
    }

    public function store(StoreProductRequest $request, ProductService $service)
    {
        $service->create($request->validated());

        notify()->success('Product created successfully!');

        return redirect()->route('admin.products.index');
    }

    public function edit(Product $product)
    {
        $product = Product::with('translations')->findOrFail($product->id);
        $categories = \App\Models\Category::whereNull('parent_id')
            ->where('status', 1)
            ->with('translations')
            ->orderBy('order', 'asc')
            ->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, Product $product, ProductService $service)
    {
        $service->update($product, $request->validated());

        notify()->success('Product updated successfully!');

        return redirect()->route('admin.products.index');
    }

    public function destroy(Product $product, ProductService $service)
    {
        $service->delete($product);

        notify()->success('Product deleted successfully!');

        return redirect()->route('admin.products.index');
    }
}
