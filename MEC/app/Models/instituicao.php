<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class instituicao extends Model
{
    protected $table = 'instituicoes';

    const CREATED_AT = 'data_criacao';
    const UPDATED_AT = 'data_alteracao';
}
