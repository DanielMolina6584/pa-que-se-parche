<?php

namespace App\Models\Juegos\Salas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalasModel extends Model
{
    protected $table = 'salas_de_juego';
    protected $primaryKey = 'id';
    public $timestamps = false;

    const ESTADO_ACTIVO = 1;
    const ESTADO_INACTIVO = 0;

    protected $fillable  = [
        'id',
        'nombre',
        'ubicacion',
        'estado'
    ];
}
