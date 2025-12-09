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

        $variant = ProductVariant::create([
            'product_id' => $data['product_id'],
            'status' => $data['status'],
        ]);

        $this->syncTranslations($variant, $data);

        return $variant->fresh('translations');
    }

    /**
     * Update product variant + translations
     */
    public function update(ProductVariant $variant, array $data): ProductVariant
    {
        $variant->update([
            'status' => $data['status'],
        ]);
        $this->syncTranslations($variant, $data);

        return $variant->fresh('translations');
    }

    /**
     * Delete product variant + translations
     */
    public function delete(ProductVariant $variant): void
    {
        $variant->translations()->delete();
        $variant->delete();
    }

    /**
     * Sync translations for product variant
     */
    private function syncTranslations(ProductVariant $variant, array $data): void
    {
        if (!isset($data['name']) || !is_array($data['name'])) {
            return;
        }

        foreach ($data['name'] as $locale => $name) {
            if (empty($name)) {
                continue;
            }

            $variant->translations()->updateOrCreate(
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
