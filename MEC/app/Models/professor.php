<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class professor extends Model
{
    protected $table = 'professor';

    const CREATED_AT = 'data_criacao';
    const UPDATED_AT = 'data_alteracao';
}
