<?php

namespace App\Services;

use App\Models\ProductVariantItem;

class ProductVariantItemService
{
    public function create(array $data): ProductVariantItem
    {
        $item = ProductVariantItem::create([
            'product_id'         => $data['product_id'],
            'product_variant_id' => $data['product_variant_id'],
            'price'              => $data['price'],
            'is_default'         => $data['is_default'],
            'status'             => $data['status'],
        ]);

        $this->syncTranslations($item, $data);

        return $item->fresh('translations');
    }

    public function update(ProductVariantItem $item, array $data): ProductVariantItem
    {

        $item->update([
            'product_id'         => $data['product_id'],
            'product_variant_id' => $data['product_variant_id'],
            'price'              => $data['price'],
            'is_default'         => $data['is_default'],
            'status'             => $data['status'],
        ]);

        $this->syncTranslations($item, $data);

        return $item->fresh('translations');
    }

    public function delete(ProductVariantItem $item): void
    {
        $item->translations()->delete();
        $item->delete();
    }

    private function syncTranslations(ProductVariantItem $item, array $data)
    {
        if (!isset($data['name']) || !is_array($data['name'])) {
            return;
        }

        foreach ($data['name'] as $locale => $name) {
            if (empty($name)) {
                continue;
            }

            $item->translations()->updateOrCreate(
                ['locale' => $locale],
                ['name' => $name]
            );
        }
    }
}
