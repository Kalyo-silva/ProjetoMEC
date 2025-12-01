<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class criterio extends Model
{
    protected $table = 'criterio';

    protected $fillable = [
        'id_indicador',
        'sequencia',
        'descricao',
    ];

    const CREATED_AT = 'data_criacao';
    const UPDATED_AT = 'data_alteracao';
    
    public function indicador()
    {
        return $this->belongsTo(indicador::class, 'id_indicador');
    }

}
