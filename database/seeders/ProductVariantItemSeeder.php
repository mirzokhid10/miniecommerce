<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use App\Models\ProductVariantItemTranslation;

class ProductVariantItemSeeder extends Seeder
{
    /**
     * Variant → Items
     */
    private array $items = [

        // ========= FASHION =========
        'Size'      => ['XS', 'S', 'M', 'L', 'XL'],
        'Color'     => ['Black', 'White', 'Red', 'Blue', 'Green'],
        'Material'  => ['Cotton', 'Polyester', 'Denim', 'Leather'],

        // ========= ELECTRONICS =========
        'Storage' => ['128GB', '256GB', '512GB'],
        'RAM'     => ['8GB', '16GB', '32GB'],
        'SSD'     => ['256GB SSD', '512GB SSD', '1TB SSD'],
        'Color'   => ['Black', 'White', 'Silver', 'Grey'],

        // ========= HOME & LIVING =========
        'Material' => ['Wood', 'Metal', 'Plastic', 'Glass'],
        'Color'    => ['Brown', 'White', 'Black', 'Beige'],

        // ========= HEALTH & BEAUTY =========
        'Volume' => ['50ml', '100ml', '150ml', '250ml'],
        'Type'   => ['Regular', 'Organic', 'Premium'],
    ];

    /**
     * FULL REALISTIC MULTILANG TRANSLATIONS
     */
    private function translateItem(string $value): array
    {
        // === COLOR TRANSLATIONS ===
        $translations = [

            // === COLORS ===
            'Black' => ['uz' => 'Qora',      'ru' => 'Чёрный',      'en' => 'Black'],
            'White' => ['uz' => 'Oq',        'ru' => 'Белый',       'en' => 'White'],
            'Red'   => ['uz' => 'Qizil',     'ru' => 'Красный',     'en' => 'Red'],
            'Blue'  => ['uz' => 'Ko‘k',      'ru' => 'Синий',       'en' => 'Blue'],
            'Green' => ['uz' => 'Yashil',    'ru' => 'Зелёный',     'en' => 'Green'],
            'Silver' => ['uz' => 'Kumush',    'ru' => 'Серебристый', 'en' => 'Silver'],
            'Grey'  => ['uz' => 'Kulrang',   'ru' => 'Серый',       'en' => 'Grey'],
            'Brown' => ['uz' => 'Jigarrang', 'ru' => 'Коричневый',  'en' => 'Brown'],
            'Beige' => ['uz' => 'Bej',       'ru' => 'Бежевый',     'en' => 'Beige'],

            // === MATERIALS ===
            'Cotton'    => ['uz' => 'Paxta',     'ru' => 'Хлопок',     'en' => 'Cotton'],
            'Polyester' => ['uz' => 'Polyester', 'ru' => 'Полиэстер',  'en' => 'Polyester'],
            'Denim'     => ['uz' => 'Denim',     'ru' => 'Деним',      'en' => 'Denim'],
            'Leather'   => ['uz' => 'Teri',      'ru' => 'Кожа',       'en' => 'Leather'],
            'Wood'      => ['uz' => 'Yog‘och',   'ru' => 'Дерево',     'en' => 'Wood'],
            'Metal'     => ['uz' => 'Metall',    'ru' => 'Металл',     'en' => 'Metal'],
            'Plastic'   => ['uz' => 'Plastik',   'ru' => 'Пластик',    'en' => 'Plastic'],
            'Glass'     => ['uz' => 'Shisha',    'ru' => 'Стекло',     'en' => 'Glass'],

            // === HEALTH & BEAUTY TYPES ===
            'Regular' => ['uz' => 'Oddiy',   'ru' => 'Обычный',   'en' => 'Regular'],
            'Organic' => ['uz' => 'Organik', 'ru' => 'Органик',   'en' => 'Organic'],
            'Premium' => ['uz' => 'Premium', 'ru' => 'Премиум',   'en' => 'Premium'],
        ];

        // === TECHNICAL VALUES (unchanged) ===
        if (preg_match('/\d+GB|\d+TB|ml|SSD/i', $value)) {
            return [
                'uz' => $value,
                'ru' => $value,
                'en' => $value,
            ];
        }

        // === MATCH TRANSLATIONS ===
        if (isset($translations[$value])) {
            return [
                'uz' => $translations[$value]['uz'],
                'ru' => $translations[$value]['ru'],
                'en' => $value,
            ];
        }

        // === FALLBACK ===
        return [
            'uz' => $value,
            'ru' => $value,
            'en' => $value,
        ];
    }

    public function run(): void
    {
        $variants = ProductVariant::all();

        foreach ($variants as $variant) {

            $variantName = $variant->translate('en')->name ?? null;

            if (!$variantName || !isset($this->items[$variantName])) {
                continue;
            }

            // Select 3–5 random items
            $selectedItems = collect($this->items[$variantName])
                ->shuffle()
                ->take(rand(3, 5));

            foreach ($selectedItems as $itemValue) {

                // Create main item
                $item = ProductVariantItem::create([
                    'product_id' => $variant->product_id,
                    'product_variant_id' => $variant->id,
                    'price' => rand(10, 20),
                    'is_default' => 1,
                    'status' => 1,
                ]);

                // Translations
                $t = $this->translateItem($itemValue);

                foreach ($t as $locale => $name) {
                    ProductVariantItemTranslation::create([
                        'product_variant_item_id' => $item->id,
                        'locale' => $locale,
                        'name' => $name,
                    ]);
                }
            }

            // Mark one as default
            $variant->items()->inRandomOrder()->first()?->update([
                'is_default' => true
            ]);
        }
    }
}
