<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class evidencia extends Model
{
    protected $table = 'evidencia';

    protected $fillable = [
        'titulo',
        'ano',
        'tipo',
        'file_path',
        'link',
        'texto'
    ];

    const CREATED_AT = 'data_criacao';
    const UPDATED_AT = 'data_alteracao';
}
