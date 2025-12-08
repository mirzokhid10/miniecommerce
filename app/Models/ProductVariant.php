<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'status'
    ];

    public function translations()
    {
        return $this->hasMany(ProductVariantTranslation::class);
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

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productVariantItems()
    {
        return $this->hasMany(ProductVariantItem::class);
    }
}
