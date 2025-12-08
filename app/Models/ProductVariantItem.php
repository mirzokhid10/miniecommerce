<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'product_variant_id',
        'price',
        'is_default',
        'status',
    ];


    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

    public function translations()
    {
        return $this->hasMany(ProductVariantItemTranslation::class);
    }

    public function translate($locale)
    {
        return $this->translations->firstWhere('locale', $locale);
    }
}
