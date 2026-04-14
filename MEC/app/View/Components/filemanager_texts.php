<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class filemanager_texts extends Component
{
    public $listaTexto;
    public $totalTextos;
    /**
     * Create a new component instance.
     */
    public function __construct($listaTexto, $totalTextos)
    {
        $this->listaTexto = $listaTexto;
        $this->totalTextos = $totalTextos;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.filemanager.texts');
    }
}
