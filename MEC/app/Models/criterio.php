<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class criterio extends Model
{
    protected $table = 'criterio';

    const CREATED_AT = 'data_criacao';
    const UPDATED_AT = 'data_alteracao';
}
