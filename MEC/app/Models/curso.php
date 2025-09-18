<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class curso extends Model
{
    protected $table = 'curso';

    const CREATED_AT = 'data_criacao';
    const UPDATED_AT = 'data_alteracao';
}
