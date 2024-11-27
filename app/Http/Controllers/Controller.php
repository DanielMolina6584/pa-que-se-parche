<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class Controller
{
    protected $response = ['data' => [], 'error' => 1, 'mensaje' => []];

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Enviar la respuesta final.
     *
     * @return array
     */
    public function sendResponse()
    {
        return response()->json($this->response);
    }

    /**
     * Establecer datos en la respuesta.
     *
     * @param array $data
     * @return void
     */
    public function setDataResponse(array $data)
    {
        $this->response['data'] = $data;
    }

    /**
     * Agregar un mensaje de error a la respuesta.
     *
     * @param string $mensaje
     * @return void
     */
    public function agregarError(string $mensaje)
    {
        $this->response['mensaje'][] = $mensaje;
        $this->response['error'] = 1; // Aseguramos que el error siga activo
    }

    /**
     * Configurar la respuesta como sin errores.
     *
     * @return void
     */
    public function respSinError()
    {
        $this->response['error'] = 0;
    }

    /**
     * Verificar si existen errores en la respuesta.
     *
     * @return bool
     */
    public function existeErrores()
    {
        return !empty($this->response['mensaje']);
    }
}
