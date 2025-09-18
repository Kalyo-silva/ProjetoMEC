<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class instrumento extends Model
{
    protected $table = 'instrumento';

    const CREATED_AT = 'data_criacao';
    const UPDATED_AT = 'data_alteracao';
}
