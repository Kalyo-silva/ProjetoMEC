<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class filemanager_links extends Component
{
    public $listaLinks;
    public $totalLinks;
    /**
     * Create a new component instance.
     */
    public function __construct($listaLinks, $totalLinks)
    {
        $this->listaLinks = $listaLinks;
        $this->totalLinks = $totalLinks;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.filemanager.links');
    }
}
