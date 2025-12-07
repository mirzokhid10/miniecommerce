<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'icon',
        'parent_id',
        'status',
        'order',
    ];


    // -------------------------------
    // Relationships
    // -------------------------------

    // Translations
    public function translations()
    {
        return $this->hasMany(CategoryTranslation::class);
    }

    // Parent category
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Children categories (subcategories)
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // -------------------------------
    // Helpers
    // -------------------------------

    public function translate($locale = null)
    {
        $locale = $locale ?? app()->getLocale();

        return $this->translations->where('locale', $locale)->first();
    }

    public function getNameAttribute()
    {
        return optional($this->translate())->name;
    }

    public function getSlugAttribute()
    {
        return optional($this->translate())->slug;
    }
}
