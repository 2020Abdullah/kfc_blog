<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderSlices extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'youtube_link',
        'refLink',
        'slider_id'
    ];

    public function slider()
    {
        return $this->belongsTo(Slider::class, 'slider_id');
    }
}
