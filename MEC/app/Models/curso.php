<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class curso extends Model
{
    protected $table = 'curso';

    protected $fillable = [
        'nome',
        'id_instituicao',
        'id_professor'
    ];

    const CREATED_AT = 'data_criacao';
    const UPDATED_AT = 'data_alteracao';

    public function instituicao()
    {
        return $this->belongsTo(instituicao::class, 'id_instituicao');
    }

    public function professor()
    {
        return $this->belongsTo(professor::class, 'id_professor');
    }
}



