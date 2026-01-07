<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class confirmRemove extends Component
{
    public $id;    
    public $nome;
    public $route;
    /**
     * Create a new component instance.
     */
    public function __construct($id, $nome, $route)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.confirm-remove');
    }
}
