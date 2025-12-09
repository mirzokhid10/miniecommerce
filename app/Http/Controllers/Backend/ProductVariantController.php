<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductVariantRequest;
use App\Http\Requests\UpdateProductVariantRequest;
use App\Services\ProductVariantService;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    public function index(ProductVariantDataTable $dataTable, Request $request, ProductVariant $variant)
    {
        $product = Product::findOrFail($request->product);
        return $dataTable->render(
            'admin.products.products-variant.index',
            compact('product')
        );
    }

    public function create()
    {
        return view('admin.products.products-variant.create');
    }

    public function store(StoreProductVariantRequest $request, ProductVariantService $service)
    {
        $service->create($request->validated());

        notify()->success('Product Variant created successfully!');

        return redirect()->route('admin.products-variant.index', [
            'product' => $request->product_id
        ]);
    }

    public function edit(ProductVariant $products_variant)
    {
        return view('admin.products.products-variant.edit', [
            'product_variant' => $products_variant
        ]);
    }

    public function update(UpdateProductVariantRequest $request, ProductVariant $products_variant, ProductVariantService $service)
    {
        $service->update($products_variant, $request->validated());

        notify()->success('Product Variant updated successfully!');

        return redirect()->route('admin.products-variant.index', [
            'product' => $products_variant->product_id
        ]);
    }



    public function destroy(ProductVariant $product_variant)
    {
        $product_id = $product_variant->product_id;

        $product_variant->delete();
        notify()->success('Product Variant deleted successfully!');
        return redirect()
            ->route('admin.products-variant.index', $product_id)
            ->with('success', 'Variant deleted successfully');
    }
}
