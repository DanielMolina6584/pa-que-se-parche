<?php

namespace App\Service\Consolas;

use App\Models\Juegos\Consolas\ConsolasModel;
use Illuminate\Support\Facades\Log;

class SvcConsolas
{
    public function listar($campos = [])
    {
        try {
            $listadoSalas = ConsolasModel::select('*');

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
            return ConsolasModel::create([
                'nombre' => $dataCrear['nombre'],
                'marca' => $dataCrear['marca'],
                'sala_id' => $dataCrear['id_sala'],
                'estado' => ConsolasModel::ESTADO_ACTIVO,
            ]);
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' - ' . $e->getLine() . ' - ' . $e->getMessage());
            return false;
        }
    }
}
