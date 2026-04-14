<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class avaliacao_current_indicador extends Component
{
    public $avaliacao;
    public $dimensao;
    public $indicador;

    public function __construct($avaliacao, $dimensao, $indicador)
    {
        $this->avaliacao = $avaliacao;
        $this->dimensao = $dimensao;
        $this->indicador = $indicador;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.avaliacao.current-indicador');
    }
}
