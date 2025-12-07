<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryService
{
    /**
     * Create category with translations
     */
    public function create(array $data): Category
    {
        return Category::create([
            'parent_id' => $data['parent_id'] ?? null,
            'icon'      => $data['icon'],
            'status'    => $data['status'],
            'order'     => $data['order'] ?? 0,
        ]);
    }

    /**
     * Update category + translations
     */
    public function update(Category $category, array $data): Category
    {
        $category->update([
            'parent_id' => $data['parent_id'] ?? null,
            'icon'      => $data['icon'],
            'status'    => $data['status'],
            'order'     => $data['order'] ?? 0,
        ]);

        // sync translations after category update
        $this->syncTranslations($category, $data);

        return $category;
    }

    /**
     * Delete category + translations
     */
    public function delete(Category $category): void
    {
        // delete children recursively or restrict deletion (you choose)
        foreach ($category->children as $child) {
            $this->delete($child);
        }

        $category->translations()->delete();
        $category->delete();
    }

    /**
     * Sync translations cleanly
     */
    private function syncTranslations(Category $category, array $data): void
    {
        if (!isset($data['name']) || !is_array($data['name'])) {
            return;
        }

        foreach ($data['name'] as $locale => $name) {
            if (!$name) continue;

            $category->translations()->updateOrCreate(
                ['locale' => $locale],
                [
                    'name' => $name,
                    'slug' => Str::slug($name),
                ]
            );
        }
    }
}
