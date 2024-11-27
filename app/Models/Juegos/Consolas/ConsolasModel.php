<?php

namespace App\Models\Juegos\Consolas;

use Illuminate\Database\Eloquent\Model;

class ConsolasModel extends Model
{
    protected $table = 'consolas';
    protected $primaryKey = 'id';
    public $timestamps = false;

    const ESTADO_ACTIVO = 1;
    const ESTADO_INACTIVO = 0;

    protected $fillable  = [
        'id',
        'nombre',
        'marca',
        'estado',
        'sala_id'
    ];
}
