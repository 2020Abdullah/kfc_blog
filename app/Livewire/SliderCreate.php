<?php

namespace App\Livewire;

use App\Models\Slider;
use App\Models\SliderSlices;
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

    protected $listeners = ['refreshSlices' => 'render'];

    public function NextStep()
    {
        if ($this->step == 1) {
            $this->validate([
                'name' => 'required|string',
                'code' => 'required',
                'items_number' => 'required|integer|min:1',
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
        // upload image if image Found

        if($this->image !== null){
            $imageName = time() . '.' . $this->image->getClientOriginalExtension();
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

        $this->dispatch('refreshSlices');

    }

    public function removeSlice($index)
    {
        unset($this->slices[$index]); // حذف العنصر
        $this->slices = array_values($this->slices); // إعادة ترتيب المصفوفة

        // فرض إعادة تحديث Livewire
        $this->dispatch('refreshSlices');
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
        $this->dispatch('setItemsNumber', $this->items_number);
        return view('livewire.slider-create');
    }
}
