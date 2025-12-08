<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    protected $fillable = [
        'product_id',
        'locale',
        'name',
        'slug',
        'short_description',
        'long_description',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
