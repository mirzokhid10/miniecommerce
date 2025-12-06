<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SliderTranslation extends Model
{
    protected $fillable = [
        'slider_id',
        'locale',
        'title',
        'type',
        'starting_price'
    ];

    public function slider()
    {
        return $this->belongsTo(Slider::class);
    }
}
