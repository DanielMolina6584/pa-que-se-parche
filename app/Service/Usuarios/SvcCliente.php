<?php

namespace App\Service\Usuarios;

use App\Models\Usuarios\Cliente;
use App\Models\Usuarios\Roles;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SvcCliente
{
    public function listar($campos = [], $array = false)
    {
        try {
            $listadoClientes = Cliente::select('*');

            if (!empty($campos)) {
                foreach ($campos as $campo => $valor) {
                    $listadoClientes->where($campo, $valor);
                }
            }
            if ($array) {
                return $listadoClientes->get()?->toArray() ?? [];
            } else {
                return $listadoClientes->first()?->toArray() ?? [];
            }
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' - ' . $e->getLine() . ' - ' . $e->getMessage());
            return [];
        }
    }

    public function crear($dataCrear)
    {
        try {
            $contrasenaHash = Hash::make($dataCrear['contrasena']);
            $generarToken = $this->generarTokenYExpiracion();

            $clienteCreate = Cliente::create([
                'nombre' => $dataCrear['nombre'],
                'email' => $dataCrear['email'],
                'contrasena' => $contrasenaHash,
                'celular' => $dataCrear['celular'],
                'rol_id' => $dataCrear['rol_id'] ?? 1,
                'token' => $generarToken['token'],
                'expiracion' => $generarToken['expiracion'],
                'estado' => Cliente::ESTADO_ACTIVO,
            ]);

            return [
                'id' => $clienteCreate->id,
                'token' => $generarToken['token'],
            ];
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' - ' . $e->getLine() . ' - ' . $e->getMessage());
            return 0;
        }
    }

    public function generarTokenYExpiracion()
    {
        $token = Str::random(20);
        $expiracion = Carbon::now()->addMinutes(30);

        return [
            'token' => $token,
            'expiracion' => $expiracion->toDateTimeString(),
        ];
    }

    public function rolByNombre($nombreRol)
    {
        try {
            return Roles::select('*')->where('nombre', $nombreRol)->first()?->toArray() ?? [];
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' - ' . $e->getLine() . ' - ' . $e->getMessage());
            return [];
        }
    }

    public function rolById($idRol)
    {
        try {
            return Roles::select('*')->where('id', $idRol)->first()?->toArray() ?? [];
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' - ' . $e->getLine() . ' - ' . $e->getMessage());
            return [];
        }
    }

    public function actualizarCliente($dataActualizar, $atributoActualizar)
    {
        try {
            if (is_numeric($atributoActualizar)) {
                return Cliente::where('id', $atributoActualizar)->update($dataActualizar);
            } else {
                return Cliente::where('email', $atributoActualizar)->update($dataActualizar);
            }
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' - ' . $e->getLine() . ' - ' . $e->getMessage());
            return [];
        }
    }
}
