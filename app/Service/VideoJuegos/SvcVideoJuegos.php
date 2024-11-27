<?php

namespace App\Service\VideoJuegos;

use App\Models\Juegos\VideoJuegos\VideoJuegosModel;
use Illuminate\Support\Facades\Log;

class SvcVideoJuegos
{
    public function listar($campos = [])
    {
        try {
            $listadoSalas = VideoJuegosModel::select('*');

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
            return VideoJuegosModel::create([
                'titulo' => $dataCrear['titulo'],
                'consola_id' => $dataCrear['id_consola'],
                'genero' => $dataCrear['genero'],
                'descripcion' => $dataCrear['descripcion'],
                'imagen' => $dataCrear['imagen'],
                'estado' => VideoJuegosModel::ESTADO_ACTIVO,
            ]);
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' - ' . $e->getLine() . ' - ' . $e->getMessage());
            return false;
        }
    }
}
