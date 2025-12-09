<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\DataTables\ProductVariantItemDataTable;

use App\Http\Requests\StoreProductVariantItemRequest;
use App\Http\Requests\UpdateProductVariantItemRequest;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use App\Services\ProductVariantItemService;

class ProductVariantItemController extends Controller
{
    /**
     * Show all variant items of a product + variant
     */

    public function index(
        ProductVariantItemDataTable $dataTable,
        Product $product,
        ProductVariant $variant
    ) {
        return $dataTable->with([
            'product_id' => $product->id,
            'variant_id'  => $variant->id
        ])->render(
            'admin.products.products-variant-item.index',
            compact('product', 'variant')
        );
    }


    /**
     * Show create form
     */
    public function create(Product $product, ProductVariant $variant)
    {
        return view(
            'admin.products.products-variant-item.create',
            compact('product', 'variant')
        );
    }

    /**
     * Store new item
     */
    public function store(
        StoreProductVariantItemRequest $request,
        Product $product,
        ProductVariant $variant,
        ProductVariantItemService $service
    ) {
        $service->create($request->validated());

        notify()->success('Variant Item created successfully!');

        return redirect()->route('admin.products-variant-item.index', [
            'product' => $product->id,
            'variant' => $variant->id,
        ]);
    }

    /**
     * Edit form
     */
    public function edit(
        Product $product,
        ProductVariant $variant,
        ProductVariantItem $item
    ) {
        return view(
            'admin.products.products-variant-item.edit',
            compact('product', 'variant', 'item')
        );
    }

    /**
     * Update item
     */
    public function update(
        UpdateProductVariantItemRequest $request,
        Product $product,
        ProductVariant $variant,
        ProductVariantItem $item,
        ProductVariantItemService $service
    ) {
        $service->update($item, $request->validated());

        notify()->success('Variant item updated successfully!');

        return redirect()->route('admin.products-variant-item.index', [
            'product' => $product->id,
            'variant' => $variant->id,
        ]);
    }

    /**
     * Delete item
     */
    public function destroy(
        Product $product,
        ProductVariant $variant,
        ProductVariantItem $item,
        ProductVariantItemService $service
    ) {
        $service->delete($item);

        notify()->success('Variant item deleted successfully!');

        return redirect()->route('admin.products-variant-item.index', [
            'product' => $product->id,
            'variant' => $variant->id,
        ]);
    }

    // public function changeStatus(Request $request)
    // {
    //     $item = ProductVariantItem::findOrFail($request->id);

    //     $item->update([
    //         'status' => $request->status ? 1 : 0,
    //     ]);

    //     return response()->json([
    //         'message' => 'Status updated successfully!'
    //     ]);
    // }
}
