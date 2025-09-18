<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class avaliacao extends Model
{
    protected $table = 'avaliacao';

    const CREATED_AT = 'data_criacao';
    const UPDATED_AT = 'data_alteracao';
}
