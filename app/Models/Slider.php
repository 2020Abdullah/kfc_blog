<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'items_number',
        'is_active'
    ];

    public function slices()
    {
        return $this->hasMany(SliderSlices::class, 'slider_id');
    }
}
