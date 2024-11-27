<?php

namespace App\Models\Juegos\Salas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalasModel extends Model
{
    protected $table = 'salas_de_juego';
    protected $primaryKey = 'id';
    protected $fillable  = [
        'id',
        'nombre',
        'ubicacion',
        'estado'
    ];
}
