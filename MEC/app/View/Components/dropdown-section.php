<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class dropdownSection extends Component
{
    public $id;
    public $title; 
    public $mode;

    public function __construct($id, $title, $mode)
    {
        $this->id = $id;
        $this->title = $title;
        $this->mode = $mode;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dropdown-section');
    }
}
