<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class indicador extends Model
{
    protected $table = 'indicador';

    protected $fillable = [
        'id_dimensao',
        'sequencia',
        'descricao',
    ];

    const CREATED_AT = 'data_criacao';
    const UPDATED_AT = 'data_alteracao';

    public function dimensao()
    {
        return $this->belongsTo(dimensao::class, 'id_dimensao');
    }

    public function criterios(){
        return $this->hasMany(criterio::class, 'id_indicador', 'id')->orderBy('sequencia');
    }

}
