<?php

namespace App\Http\Controllers\Juegos;

use App\Http\Controllers\Controller;
use App\Service\Salas\SvcSalas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SalasDeJuegoController extends Controller
{
    protected $svcSalasDeJuego;

    public function __construct(SvcSalas $svcSalasDeJuego, Request $request)
    {
        parent::__construct($request);
        $this->svcSalasDeJuego = $svcSalasDeJuego;
    }

    public function listar()
    {
        $listadoSalas = $this->svcSalasDeJuego->listar();
        $this->setDataResponse($listadoSalas);
        $this->respSinError();
        return $this->sendResponse();
    }

    public function crear()
    {
        $validador = Validator::make($this->request->all(), [
            'nombre' => 'required',
            'ubicacion' => 'required',
        ]);

        if ($validador->fails()) {
            foreach ($validador->errors()->all() as $error) {
                $this->agregarError($error);
            }
            return $this->sendResponse();
        }
        $dataRequest = $this->request->all();

        $this->svcSalasDeJuego->crear($dataRequest);
        $this->respSinError();
        return $this->sendResponse();
    }
}
