<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class evidencia extends Model
{
    protected $table = 'evidencias';

    const CREATED_AT = 'data_criacao';
    const UPDATED_AT = 'data_alteracao';
}
