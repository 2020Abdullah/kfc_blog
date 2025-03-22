<?php

namespace App\Livewire;

use App\Models\Slider;
use App\Models\SliderSlices;
use Livewire\Component;
use Livewire\WithFileUploads;

class SliderSetting extends Component
{
    use WithFileUploads;

    public $step = 1;
    public $sliderId;
    public $name, $code, $items_number;
    public $slider;
    public $slices = [];
    public $title, $description, $image, $youtube_link, $refLink;

    public function updated($propertyName)
    {
        if ($propertyName == 'image') {
            $this->dispatch('refreshSlices'); // إرسال حدث بعد رفع الصورة
        }
    }

    public function mount(){
        $this->slider = Slider::with('slices')->where('id', $this->sliderId)->first();
        if ($this->slider) {
            $this->name = $this->slider->name;
            $this->code = $this->slider->code;
            $this->items_number = $this->slider->items_number;
            $this->refLink = $this->slider->refLink;
    
            // تمرير كل الشرائح إلى المصفوفة slices
            $this->slices = $this->slider->slices->toArray();
        }
    }

    public function NextStep()
    {
        if ($this->step == 1) {
            $this->validate([
                'name' => 'required|string',
                'items_number' => 'required|integer|min:1',
            ]);

            $slider = Slider::updateOrCreate(
                ['code' => $this->code],
                [
                    'name' => $this->name,
                    'items_number' => $this->items_number,
                ]
            );

            $this->sliderId = $slider->id;
            $this->items_number = $slider->items_number; // get sync items
        }
        $this->step++;
    }

    public function UpdateSlice()
    { 
        // upload image if image Found

        if($this->image !== null){
            $imageName = time() . '.' . $this->image->getClientOriginalName();
            $this->image->storeAs('sliders', $imageName, 'public_uploads');
            $imagePath = 'sliders/' . $imageName;
        }
        else {
            $imagePath = null;
        }

        // upload youtube link

        if($this->youtube_link !== null){
            $youtubeId = $this->youtube_link ? $this->extractYoutubeId($this->youtube_link) : null;
            $embedYoutubeLink = $youtubeId ? "https://www.youtube.com/embed/{$youtubeId}" : null;
        }
        else {
            $embedYoutubeLink = null;
        }

        // add data to array slices
        $this->slices[] = [
            'youtube_link' => $embedYoutubeLink,
            'image' => $imagePath,
            'title' => $this->title,
            'description' => $this->description,
            'refLink' => $this->refLink,
            'code' => $this->code,
        ];

        $this->reset(['youtube_link', 'image', 'title', 'description', 'refLink']);

    }

    private function extractYoutubeId($url)
    {
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?|watch(?:_popup)?)(?:\.php)?(?:\S*?)(?:[?&]v=|\/))|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $matches);
        return $matches[1] ?? null;
    }

    public function saveSlider()
    {        
        if (!$this->sliderId) {
            session()->flash('error', 'لا يوجد معرض محفوظ!');
            return;
        }

        foreach ($this->slices as $slice) {
            if (!isset($slice['id'])) { 
                SliderSlices::create([
                    'slider_id' => $this->sliderId,
                    'youtube_link' => $slice['youtube_link'] ?? null,
                    'image' => $slice['image'] ?? null,
                    'title' => $slice['title'] ?? '',
                    'refLink' => $slice['refLink'] ?? '',
                    'description' => $slice['description'] ?? '',
                ]);
            }
        }

        session()->flash('success', 'تم حفظ المعرض والشرائح بنجاح!');
        toast('تم حفظ المعرض والشرائح بنجاح!', 'success');
        return redirect()->route('slider.index');
    }

    public function removeSlice($index)
    {
        // التحقق مما إذا كانت الشريحة تحتوي على صورة
        if (!empty($this->slices[$index]['image'])) {
            $imagePath = public_path('sliders/' . $this->slices[$index]['image']); // تحديد المسار الفعلي للصورة
            
            // حذف الصورة من التخزين إذا كانت موجودة
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        if (isset($this->slices[$index]['id'])) {
            SliderSlices::where('id', $this->slices[$index]['id'])->delete();
        }

        unset($this->slices[$index]); // حذف العنصر

        $this->slices = array_values($this->slices); // إعادة ترتيب المصفوفة

    }

    public function PreviousStep()
    {
        $this->step--;
    }
    public function render()
    {
        return view('livewire.slider-setting');
    }
}
