<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\SliderImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function sliderIndex(){
        $sliders = Slider::all();
        return view('dashboard.gellery.index', compact('sliders'));
    }

    public function sliderCreate(){
        return view('dashboard.gellery.create');
    }

    public function sliderShow($id){
        $sliderId = $id;
        return view('dashboard.gellery.sliderShow', compact('sliderId'));
    }

    public function getSliderByCode($code){
        $slider = Slider::with('slices')->where('code', $code)->where('is_active', 1)->first();
        
        if (!$slider) {
            return response()->json(['status' => 'error', 'message' => 'Slider not found'], 404);
        }
    
        return response()->json([
            'status' => 'success',
            'items_number' => $slider->items_number ?? 1,
            'items' => $slider
        ]);
    }

}
