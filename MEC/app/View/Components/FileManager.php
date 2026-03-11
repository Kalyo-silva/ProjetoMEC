<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FileManager extends Component
{
    public $listaTexto;
    public $listaLinks;

    /**
     * Create a new component instance.
     */
    public function __construct($listaTexto, $listaLinks)
    {
        $this->listaTexto = $listaTexto;
        $this->listaLinks = $listaLinks;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.file-manager');
    }
}
