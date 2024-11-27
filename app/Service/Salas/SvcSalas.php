<?php

namespace App\Service\Salas;

use App\Models\Juegos\Salas\SalasModel;
use Illuminate\Support\Facades\Log;

class SvcSalas
{
    public function listar($campos = [])
    {
        try {
            $listadoSalas = SalasModel::select('*');

            if (!empty($campos)) {
                foreach ($campos as $campo => $valor) {
                    $listadoSalas->where($campo, $valor);
                }
            }
            return $listadoSalas->get()?->toArray() ?? [];
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' - ' . $e->getLine() . ' - ' . $e->getMessage());
            return [];
        }
    }

    public function crear($dataCrear)
    {
        try {
            return SalasModel::create([
                'nombre' => $dataCrear['nombre'],
                'ubicacion' => $dataCrear['ubicacion'],
                'estado' => SalasModel::ESTADO_ACTIVO,
            ]);
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' - ' . $e->getLine() . ' - ' . $e->getMessage());
            return false;
        }
    }
}
