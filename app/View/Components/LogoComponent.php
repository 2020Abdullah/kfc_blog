<?php

namespace App\View\Components;

use App\Models\SiteInfo;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LogoComponent extends Component
{
    public $site_logo;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->site_logo = SiteInfo::latest()->pluck('site_logo')->first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.logo-component');
    }
}
