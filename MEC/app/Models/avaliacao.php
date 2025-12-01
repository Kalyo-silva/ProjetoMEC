<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class avaliacao extends Model
{
    protected $table = 'avaliacao';

    protected $fillable = [
        'id_curso',
        'ano',
        'descricao',
        'data_inicio',
        'data_fim',
        'id_usuario',
    ];

    const CREATED_AT = 'data_criacao';
    const UPDATED_AT = 'data_alteracao';

    public function curso()
    {
        return $this->belongsTo(curso::class, 'id_curso');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

}
