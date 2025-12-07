<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\CategoryTranslation;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        /**
         * Run the database seeds.
         */
        $categories = [
            'fashion' => [
                'icon' => 'fas fa-tshirt',
                'translations' => [
                    'uz' => 'Moda va Kiyim',
                    'ru' => 'Мода и Одежда',
                    'en' => 'Fashion & Apparel',
                ],
                'children' => [
                    'men' => [
                        'translations' => [
                            'uz' => 'Erkaklar',
                            'ru' => 'Мужчины',
                            'en' => 'Men',
                        ],
                        'children' => ['Shirts', 'Pants', 'Shoes', 'Accessories'],
                    ],
                    'women' => [
                        'translations' => [
                            'uz' => 'Ayollar',
                            'ru' => 'Женщины',
                            'en' => 'Women',
                        ],
                        'children' => ['Dresses', 'Tops', 'Handbags', 'Jewelry'],
                    ],
                    'kids' => [
                        'translations' => [
                            'uz' => 'Bolalar',
                            'ru' => 'Дети',
                            'en' => 'Kids',
                        ],
                        'children' => ['Schoolwear', 'Baby Clothing', 'Footwear'],
                    ],
                ],
            ],

            'electronics' => [
                'icon' => 'fas fa-tv',
                'translations' => [
                    'uz' => 'Elektronika',
                    'ru' => 'Электроника',
                    'en' => 'Electronics',
                ],
                'children' => [
                    'mobile' => [
                        'translations' => [
                            'uz' => 'Telefonlar va Aksessuarlar',
                            'ru' => 'Мобильные и Аксессуары',
                            'en' => 'Mobile & Accessories',
                        ],
                        'children' => ['Smartphones', 'Chargers', 'Cases', 'Earphones'],
                    ],
                    'computers' => [
                        'translations' => [
                            'uz' => 'Kompyuterlar',
                            'ru' => 'Компьютеры',
                            'en' => 'Computers & Laptops',
                        ],
                        'children' => ['Desktops', 'Monitors', 'Keyboards', 'Storage Devices'],
                    ],
                    'home_appliances' => [
                        'translations' => [
                            'uz' => 'Uy Jihozlari',
                            'ru' => 'Бытовая техника',
                            'en' => 'Home Appliances',
                        ],
                        'children' => ['Refrigerators', 'Washing Machines', 'Microwaves'],
                    ],
                ],
            ],

            'home_living' => [
                'icon' => 'fas fa-home-lg-alt',
                'translations' => [
                    'uz' => 'Uy va Hayot',
                    'ru' => 'Дом и Жизнь',
                    'en' => 'Home & Living',
                ],
                'children' => [
                    'furniture' => [
                        'translations' => [
                            'uz' => 'Mebel',
                            'ru' => 'Мебель',
                            'en' => 'Furniture',
                        ],
                        'children' => ['Sofas', 'Beds', 'Tables', 'Chairs'],
                    ],
                    'kitchen' => [
                        'translations' => [
                            'uz' => 'Oshxona',
                            'ru' => 'Кухня',
                            'en' => 'Kitchen & Dining',
                        ],
                        'children' => ['Cookware', 'Dinnerware', 'Storage'],
                    ],
                    'decor' => [
                        'translations' => [
                            'uz' => 'Dekor',
                            'ru' => 'Декор',
                            'en' => 'Decor',
                        ],
                        'children' => ['Lighting', 'Rugs', 'Wall Art'],
                    ],
                ],
            ],

            'health_beauty' => [
                'icon' => 'fas fa-heartbeat',
                'translations' => [
                    'uz' => 'Salomatlik va Go‘zallik',
                    'ru' => 'Здоровье и Красота',
                    'en' => 'Health & Beauty',
                ],
                'children' => [
                    'skincare' => [
                        'translations' => [
                            'uz' => 'Teri Parvarishi',
                            'ru' => 'Уход за кожей',
                            'en' => 'Skincare',
                        ],
                        'children' => ['Moisturizers', 'Cleansers', 'Sunscreens'],
                    ],
                    'haircare' => [
                        'translations' => [
                            'uz' => 'Soch Parvarishi',
                            'ru' => 'Уход за волосами',
                            'en' => 'Haircare',
                        ],
                        'children' => ['Shampoos', 'Conditioners', 'Styling Products'],
                    ],
                    'makeup' => [
                        'translations' => [
                            'uz' => 'Kosmetika',
                            'ru' => 'Макияж',
                            'en' => 'Makeup',
                        ],
                        'children' => ['Foundations', 'Lipsticks', 'Eyeliners'],
                    ],
                ],
            ],
        ];

        /**
         * ==============================
         * INSERT DATA
         * ==============================
         */

        foreach ($categories as $categoryKey => $categoryData) {

            // Create main category
            $main = Category::create([
                'icon'      => $categoryData['icon'],
                'parent_id' => null,
                'status'    => 1,
                'order'     => 1,
            ]);

            $this->createTranslations($main, $categoryData['translations']);

            // Subcategories
            foreach ($categoryData['children'] as $subKey => $subData) {

                $sub = Category::create([
                    'icon'      => null,
                    'parent_id' => $main->id,
                    'status'    => 1,
                    'order'     => 1,
                ]);

                $this->createTranslations($sub, $subData['translations']);

                // Child categories
                foreach ($subData['children'] as $childName) {

                    $child = Category::create([
                        'icon'      => null,
                        'parent_id' => $sub->id,
                        'status'    => 1,
                        'order'     => 1,
                    ]);

                    $this->createTranslations($child, [
                        'uz' => $childName,
                        'ru' => $childName,
                        'en' => $childName,
                    ]);
                }
            }
        }
    }

    /**
     * Helper: create translations
     */
    private function createTranslations(Category $category, array $data): void
    {
        foreach ($data as $locale => $name) {
            CategoryTranslation::create([
                'category_id' => $category->id,
                'locale'      => $locale,
                'name'        => $name,
                'slug'        => Str::slug($name),
            ]);
        }
    }
}
