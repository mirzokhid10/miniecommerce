<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantTranslation;

class ProductVariantSeeder extends Seeder
{
    /**
     * Mapping: category_key => product variants
     */
    private array $variantMap = [

        // Fashion
        'fashion' => ['Size', 'Color', 'Material'],

        // Electronics
        'electronics' => ['Storage', 'Color', 'RAM', 'SSD'],

        // Home & Living
        'home_living' => ['Material', 'Color'],

        // Health & Beautycha
        'health_beauty' => ['Volume', 'Type'],
    ];

    /**
     * Fully translated variant names
     */
    private array $translations = [
        'Storage' => [
            'uz' => 'Hajmi',
            'ru' => 'Хранение',
            'en' => 'Storage',
        ],
        'Color' => [
            'uz' => 'Rangi',
            'ru' => 'Цвет',
            'en' => 'Color',
        ],
        'Size' => [
            'uz' => 'O‘lcham',
            'ru' => 'Размер',
            'en' => 'Size',
        ],
        'Capacity' => [
            'uz' => 'Sig‘im',
            'ru' => 'Ёмкость',
            'en' => 'Capacity',
        ],
        'RAM' => [
            'uz' => 'RAM',
            'ru' => 'RAM',
            'en' => 'RAM',
        ],
        'SSD' => [
            'uz' => 'SSD',
            'ru' => 'SSD',
            'en' => 'SSD',
        ],
        'Material' => [
            'uz' => 'Material',
            'ru' => 'Материал',
            'en' => 'Material',
        ],
        'Volume' => [
            'uz' => 'Hajm',
            'ru' => 'Объём',
            'en' => 'Volume',
        ],
        'Type' => [
            'uz' => 'Turi',
            'ru' => 'Тип',
            'en' => 'Type',
        ],
    ];

    public function run(): void
    {
        $products = Product::all();

        foreach ($products as $product) {

            $category = $product->category;

            if (!$category) {
                continue;
            }

            // ✅ Use slug from category translations
            $slug = $category->translate('en')->slug ?? null;

            if (!$slug) {
                continue;
            }

            // ✅ Normalize keys to match your map
            // fashion-apparel → fashion
            // home-living → home_living
            // health-beauty → health_beauty
            // electronics → electronics

            $normalized = match ($slug) {
                'fashion-apparel' => 'fashion',
                'electronics' => 'electronics',
                'home-living' => 'home_living',
                'health-beauty' => 'health_beauty',
                default => null,
            };

            if (!$normalized || !isset($this->variantMap[$normalized])) {
                continue;
            }

            // ✅ Get 2–3 random variants for this category
            $variantNames = collect($this->variantMap[$normalized])
                ->shuffle()
                ->take(rand(2, 3));

            foreach ($variantNames as $variantName) {

                // ✅ Create variant
                $variant = ProductVariant::create([
                    'product_id' => $product->id,
                    'status' => 1,
                ]);

                // ✅ Create translations
                foreach ($this->translations[$variantName] as $locale => $translated) {
                    ProductVariantTranslation::create([
                        'product_variant_id' => $variant->id,
                        'locale' => $locale,
                        'name' => $translated,
                    ]);
                }
            }
        }
    }
}
