<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\ProductImageGallery;
use App\Models\Category;
use App\Helpers\FakeImageHelper;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::whereNull("parent_id")->get(); // main categories

        foreach ($categories as $category) {

            $subCategories = Category::where("parent_id", $category->id)->get();

            foreach ($subCategories as $sub) {

                $childCategories = Category::where("parent_id", $sub->id)->get();

                foreach ($childCategories as $child) {

                    // Create 2–3 products per child category
                    $count = rand(2, 3);

                    for ($i = 1; $i <= $count; $i++) {

                        $nameUz = "{$category->translate('uz')->name} {$sub->translate('uz')->name} {$child->translate('uz')->name}";
                        $nameRu = "{$category->translate('ru')->name} {$sub->translate('ru')->name} {$child->translate('ru')->name}";
                        $nameEn = "{$category->translate('en')->name} {$sub->translate('en')->name} {$child->translate('en')->name}";

                        $thumbImage = FakeImageHelper::generate();

                        $product = Product::create([
                            'thumb_image'       => $thumbImage,
                            'category_id'       => $category->id,
                            'sub_category_id'   => $sub->id,
                            'child_category_id' => $child->id,
                            'qty'               => rand(10, 200),
                            'sku'               => strtoupper(Str::random(8)),
                            'price'             => rand(50, 500),
                            'offer_price'       => rand(20, 49),
                            'offer_start_date'  => now(),
                            'offer_end_date'    => now()->addDays(10),
                            'product_type'      => 'new_arrival',
                            'status'            => 1,
                            'is_approved'       => 1,
                        ]);

                        // ===========================
                        // ADD TRANSLATIONS
                        // ===========================

                        $translations = [
                            'uz' => [
                                'name' => $nameUz,
                                'short_description' => "Bu mahsulot uchun qisqa ta'rif.",
                                'long_description'  => "Bu mahsulot uchun uzun ta'rif. Barcha ma'lumotlar bilan to'ldirilgan.",
                            ],
                            'ru' => [
                                'name' => $nameRu,
                                'short_description' => "Короткое описание продукта.",
                                'long_description'  => "Длинное описание продукта с подробностями.",
                            ],
                            'en' => [
                                'name' => $nameEn,
                                'short_description' => "Short description of the product.",
                                'long_description'  => "Long product description with all details.",
                            ],
                        ];

                        foreach ($translations as $locale => $data) {
                            ProductTranslation::create([
                                'product_id' => $product->id,
                                'locale'     => $locale,
                                'name'       => $data['name'],
                                'slug'       => Str::slug($data['name']),
                                'short_description' => $data['short_description'],
                                'long_description'  => $data['long_description'],
                            ]);
                        }

                        // ===========================
                        // ADD 3 GALLERY IMAGES
                        // ===========================

                        for ($g = 1; $g <= 3; $g++) {
                            ProductImageGallery::create([
                                'product_id' => $product->id,
                                'image'      => FakeImageHelper::generate('gallery', 800, 800),
                            ]);
                        }
                    }
                }
            }
        }
    }
}
