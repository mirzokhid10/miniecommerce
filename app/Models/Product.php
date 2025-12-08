<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [

        'thumb_image',
        'category_id',
        'sub_category_id',
        'child_category_id',
        'qty',
        'sku',
        'price',
        'offer_price',
        'offer_start_date',
        'offer_end_date',
        'product_type',
        'status',
        'is_approved',
    ];

    // Translations
    public function translations()
    {
        return $this->hasMany(ProductTranslation::class);
    }

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

    public function getShortDescriptionAttribute()
    {
        return optional($this->translate())->short_description;
    }

    public function getLongDescriptionAttribute()
    {
        return optional($this->translate())->long_description;
    }

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productVariant()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function productImageGallery()
    {
        return $this->hasMany(ProductImageGallery::class);
    }
}
