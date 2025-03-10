<?php

namespace App\View\Components;

use Alkoumi\LaravelHijriDate\Hijri;
use Alkoumi\LaravelHijriDate\LaravelHijriDateServiceProvider;
use App\Models\Category;
use App\Models\PageContent;
use App\Models\SiteInfo;
use App\Models\Slider;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HeaderSection extends Component
{

    public $hijriDate;
    public $categories;
    public $headerLinks;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $today = Carbon::now(); // التاريخ الميلادي الحالي

        $this->hijriDate = Hijri::Date('l d F Y هـ', $today);

        $this->categories = Category::with(['blogs' => function ($query) {
            $query->whereNotNull('id');
        }])->get();


        $this->headerLinks = PageContent::where('location', 'headerTop')->get();


    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header-section');
    }
}
