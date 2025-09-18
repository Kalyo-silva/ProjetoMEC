<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class avaliacao_indicador extends Model
{
    protected $table = 'avaliacao_indicador';

    const CREATED_AT = 'data_criacao';
    const UPDATED_AT = 'data_alteracao';
}
