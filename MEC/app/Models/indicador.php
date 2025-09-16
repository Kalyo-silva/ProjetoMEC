<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class indicador extends Model
{
    protected $table = 'indicadores';

    const CREATED_AT = 'data_criacao';
    const UPDATED_AT = 'data_alteracao';
}
