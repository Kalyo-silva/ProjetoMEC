<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class filemanager_filesection extends Component
{
    public $arquivos;
    public $titulo;
    public $tipo;
    public $total;
    /**
     * Create a new component instance.
     */
    public function __construct($arquivos, $titulo, $tipo, $total)
    {
        $this->arquivos = $arquivos;
        $this->titulo = $titulo;
        $this->tipo = $tipo;
        $this->total = $total;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.filemanager.file-section');
    }
}
