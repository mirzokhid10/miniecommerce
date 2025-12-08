<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantItemTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_variant_item_id',
        'locale',
        'name'
    ];

    public function item()
    {
        return $this->belongsTo(ProductVariantItem::class, 'product_variant_item_id');
    }
}
