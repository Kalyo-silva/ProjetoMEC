<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class confirmRemoveInstituicao extends Component
{
    public $id;    
    public $nome;
    /**
     * Create a new component instance.
     */
    public function __construct($id, $nome)
    {
        $this->id = $id;
        $this->nome = $nome;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.confirm-remove-instituicao');
    }
}
