<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class instituicao extends Model
{
    protected $table = 'instituicao';

    const CREATED_AT = 'data_criacao';
    const UPDATED_AT = 'data_alteracao';
}
