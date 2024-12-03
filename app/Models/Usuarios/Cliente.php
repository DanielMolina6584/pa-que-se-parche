<?php

namespace App\Models\Usuarios;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'usuarios_clientes';
    protected $primaryKey = 'id';
    public $timestamps = false;

    const ESTADO_ACTIVO = 1;
    const ESTADO_INACTIVO = 0;

    protected $fillable  = [
        'id',
        'nombre',
        'email',
        'contrasena',
        'celular',
        'rol_id',
        'token',
        'expiracion',
        'estado'
    ];
}
