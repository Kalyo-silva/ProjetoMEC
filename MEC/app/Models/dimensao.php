<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class dimensao extends Model
{
    protected $table = 'dimensao';

    protected $fillable = [
        'id_instrumento',
        'sequencia',
        'descricao',
    ];

    const CREATED_AT = 'data_criacao';
    const UPDATED_AT = 'data_alteracao';
    
    public function instrumento()
    {
        return $this->belongsTo(instrumento::class, 'id_instrumento');
    }

}
