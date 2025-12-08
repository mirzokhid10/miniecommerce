<?php

namespace App\Services;

use App\Models\ProductVariant;


class ProductVariantService

{
    /**
     * Create product variant + translations
     */
    public function create(array $data): ProductVariant
    {

        $product_variant = ProductVariant::create([
            'product_id' => $data['product_id'],
            'status' => $data['status'],
        ]);

        $this->syncTranslations($product_variant, $data);

        return $product_variant->fresh('translations');
    }

    /**
     * Update product variant + translations
     */
    public function update(ProductVariant $product_variant, array $data): ProductVariant
    {
        $product_variant->update([
            'product_id' => $data['product_id'],
            'status' => $data['status'],
        ]);
        $this->syncTranslations($product_variant, $data);

        return $product_variant->fresh('translations');
    }

    /**
     * Delete product variant + translations
     */
    public function delete(ProductVariant $product_variant): void
    {
        $product_variant->translations()->delete();
        $product_variant->delete();
    }

    /**
     * Sync translations for product variant
     */
    private function syncTranslations(ProductVariant $product_variant, array $data): void
    {
        if (!isset($data['name']) || !is_array($data['name'])) {
            return;
        }

        foreach ($data['name'] as $locale => $name) {
            if (empty($name)) {
                continue;
            }

            $product_variant->translations()->updateOrCreate(
                [
                    'locale' => $locale,
                ],
                [
                    'name' => $name,
                ]
            );
        }
    }
}
