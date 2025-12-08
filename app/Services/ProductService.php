<?php

namespace App\Services;

use App\Models\Product;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Str;

class ProductService
{
    use ImageUploadTrait;

    /**
     * Create product + translations
     */
    public function create(array $data): Product
    {
        // upload image
        $imagePath = null;

        if (isset($data['thumb_image']) && $data['thumb_image'] instanceof UploadedFile) {
            $fake = new HttpRequest();
            $fake->files->set('thumb_image', $data['thumb_image']);
            $imagePath = $this->uploadImage($fake, 'thumb_image', 'uploads');
        }

        $product = Product::create([
            'thumb_image'       => $imagePath,
            'category_id'       => $data['category'],
            'sub_category_id'   => $data['sub_category'] ?? null,
            'child_category_id' => $data['child_category'] ?? null,
            'price'             => $data['price'],
            'qty'               => $data['qty'],
            'sku'               => $data['sku'] ?? null,
            'offer_price'       => $data['offer_price'] ?? null,
            'offer_start_date'  => $data['offer_start_date'] ?? null,
            'offer_end_date'    => $data['offer_end_date'] ?? null,
            'product_type'      => $data['product_type'],
            'status'            => $data['status'],
            'is_approved'       => 1,
        ]);

        // sync translations
        $this->syncTranslations($product, $data);

        return $product;
    }

    /**
     * Update product
     */
    public function update(Product $product, array $data): Product
    {

        dd($data);
        // upload image if provided
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {

            // delete old image
            $this->deleteImage($product->thumb_image);

            $fake = new HttpRequest();
            $fake->files->set('image', $data['image']);

            $product->thumb_image = $this->uploadImage($fake, 'image', 'uploads');
        }

        $product->update([
            'category_id'       => $data['category'],
            'sub_category_id'   => $data['sub_category'] ?? null,
            'child_category_id' => $data['child_category'] ?? null,
            'price'             => $data['price'],
            'qty'               => $data['qty'],
            'sku'               => $data['sku'] ?? null,
            'offer_price'       => $data['offer_price'] ?? null,
            'offer_start_date'  => $data['offer_start_date'] ?? null,
            'offer_end_date'    => $data['offer_end_date'] ?? null,
            'product_type'      => $data['product_type'],
            'status'            => $data['status'],
        ]);

        $this->syncTranslations($product, $data);

        return $product;
    }

    /**
     * Delete product + images
     */
    public function delete(Product $product): void
    {
        if ($product->thumb_image) {
            $this->deleteImage($product->thumb_image);
        }

        $product->translations()->delete();
        $product->delete();
    }

    /**
     * Sync translations
     */
    private function syncTranslations(Product $product, array $data): void
    {
        if (!isset($data['name'])) {
            return;
        }

        foreach ($data['name'] as $locale => $name) {
            if (!$name) continue;

            $product->translations()->updateOrCreate(
                ['locale' => $locale],
                [
                    'name'             => $name,
                    'slug'             => Str::slug($name),
                    'short_description' => $data['short_description'][$locale] ?? null,
                    'long_description' => $data['long_description'][$locale] ?? null,
                ]
            );
        }
    }
}
