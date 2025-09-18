<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class dimensao extends Model
{
    protected $table = 'dimensao';

    const CREATED_AT = 'data_criacao';
    const UPDATED_AT = 'data_alteracao';
}
