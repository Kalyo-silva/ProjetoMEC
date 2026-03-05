<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class filemanager_files extends Component
{   
    public $listaArquivos;
    /**
     * Create a new component instance.
     */
    public function __construct($listaArquivos)
    {
        $this->listaArquivos = $listaArquivos;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.filemanager.files');
    }
}
