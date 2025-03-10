<?php

namespace App\View\Components;

use App\Models\PageContent;
use App\Models\SiteInfo;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FooterSection extends Component
{
    public $siteInfo;
    public $FooterLink;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->siteInfo = SiteInfo::latest()->first();
        $this->FooterLink = PageContent::latest()->where('location', 'Footer')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.footer-section');
    }
}
