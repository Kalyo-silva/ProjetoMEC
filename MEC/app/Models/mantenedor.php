<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mantenedor extends Model
{    
    protected $table = 'mantenedor';

    protected $fillable = [
        'nome',
        'uf',
        'cidade',
        'bairro',
        'logradouro',
        'cep'
    ];

    const CREATED_AT = 'data_criacao';
    const UPDATED_AT = 'data_alteracao';
}
