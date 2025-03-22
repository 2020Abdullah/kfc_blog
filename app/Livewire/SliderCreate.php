<?php

namespace App\Livewire;

use App\Models\Slider;
use App\Models\SliderSlices;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class SliderCreate extends Component
{
    use WithFileUploads;

    public $step = 1;
    public $name, $code;
    public $items_number = 1;
    public $slices = [];
    public $title, $description, $image, $youtube_link, $refLink;
    public $sliderId;

    public function updated($propertyName)
    {
        if ($propertyName == 'image') {
            $this->dispatch('refreshSlices'); // إرسال حدث بعد رفع الصورة
        }
    }

    public function NextStep()
    {
        if ($this->step == 1) {
            $this->validate([
                'name' => 'required|string',
                'code' => [
                    'required',
                    Rule::unique('sliders', 'code')->ignore($this->code, 'code') // السماح بالتحديث إذا كان الكود الحالي موجودًا
                ],
                'items_number' => 'required|integer|min:1',
            ], [
                'name.required' => 'حقل الاسم مطلوب.',
                'name.string' => 'يجب أن يكون الاسم نصيًا.',
                'code.required' => 'يجب اختيار كود للشريحة.',
                'code.unique' => 'هذا الكود مستخدم بالفعل، يرجى اختيار كود آخر.',
                'items_number.required' => 'عدد العناصر مطلوب.',
                'items_number.integer' => 'عدد العناصر يجب أن يكون رقمًا صحيحًا.',
                'items_number.min' => 'يجب أن يكون عدد العناصر على الأقل 1.',
            ]);

            $slider = Slider::updateOrCreate(
                ['code' => $this->code],
                [
                    'name' => $this->name,
                    'code' => $this->code,
                    'items_number' => $this->items_number,
                ]
            );

            $this->sliderId = $slider->id;
            $this->items_number = $slider->items_number; // get sync items
        }
        $this->step++;
    }

    public function addSlice()
    {   
        $imagePath = null;
        $embedYoutubeLink = null;
        // upload image if image Found

        if(!empty($this->image)){
            $imageName = time() . '.' . $this->image->getClientOriginalName();
            $this->image->storeAs('sliders', $imageName, 'public_uploads');
            $imagePath = 'sliders/' . $imageName;
        }

        // upload youtube link

        if(!empty($this->youtube_link)){
            $youtubeId = $this->youtube_link ? $this->extractYoutubeId($this->youtube_link) : null;
            $embedYoutubeLink = $youtubeId ? "https://www.youtube.com/embed/{$youtubeId}" : null;
        }

       // **منع إدخال صف فارغ تمامًا**
        if (
            !empty($imagePath) || 
            !empty($embedYoutubeLink) || 
            (isset($this->title) && trim($this->title) !== '') || 
            (isset($this->description) && trim($this->description) !== '') || 
            (isset($this->refLink) && trim($this->refLink) !== '')
        ) {
            $this->slices[] = [
                'youtube_link' => $embedYoutubeLink,
                'image' => $imagePath,
                'title' => trim($this->title),
                'description' => trim($this->description),
                'refLink' => trim($this->refLink),
            ];
        } else {
            session()->flash('error', 'يجب إدخال بيانات صحيحة قبل الإضافة.');
            return;
        }

        $this->slices = collect($this->slices)->filter()->values()->toArray();

        $this->reset(['youtube_link', 'image', 'title', 'description', 'refLink']);

        $this->dispatch('refreshSlices'); // إرسال حدث بعد رفع الصورة
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
        unset($this->slices[$index]); // حذف العنصر
        $this->slices = array_values($this->slices); // إعادة ترتيب المصفوفة
    }

    private function extractYoutubeId($url)
    {
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?|watch(?:_popup)?)(?:\.php)?(?:\S*?)(?:[?&]v=|\/))|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $matches);
        return $matches[1] ?? null;
    }

    public function saveSlider()
    {
        foreach ($this->slices as $slice) {
            SliderSlices::create([
                'slider_id' => $this->sliderId,
                'youtube_link' => $slice['youtube_link'],
                'image' => $slice['image'],
                'title' => $slice['title'],
                'refLink' => $slice['refLink'],
                'description' => $slice['description'],
            ]);
        }

        session()->flash('success', 'تم حفظ المعرض والشرائح بنجاح!');
        toast('تم حفظ المعرض والشرائح بنجاح!', 'success');
        return redirect()->route('slider.index');
    }

    public function PreviousStep()
    {
        $this->step--;
    }

    public function render()
    {
        return view('livewire.slider-create');
    }
}
