<?php

namespace App\Models\Juegos\VideoJuegos;

use Illuminate\Database\Eloquent\Model;

class VideoJuegosModel extends Model
{
    protected $table = 'videojuegos';
    protected $primaryKey = 'id';
    public $timestamps = false;

    const ESTADO_ACTIVO = 1;
    const ESTADO_INACTIVO = 0;

    protected $fillable  = [
        'id',
        'titulo',
        'genero',
        'estado',
        'consola_id',
        'descripcion',
        'imagen'
    ];
}
