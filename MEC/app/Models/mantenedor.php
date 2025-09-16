<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mantenedor extends Model
{    
    protected $table = 'mantenedores';

    const CREATED_AT = 'data_criacao';
    const UPDATED_AT = 'data_alteracao';
}
