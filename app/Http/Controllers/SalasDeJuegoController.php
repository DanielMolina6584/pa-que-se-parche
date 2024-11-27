<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Service\Salas\SalasDeJuegoSvc;

class SalasDeJuegoController extends Controller
{
    protected $svcSalasDeJuego;

    public function __construct(SalasDeJuegoSvc $svcSalasDeJuego)
    {
        $this->svcSalasDeJuego = $svcSalasDeJuego;
    }

    public function listarSalasDeJuego()
    {
        $listadoSalas = $this->svcSalasDeJuego->listar();
        $this->setDataResponse($listadoSalas);
        $this->respSinError();
        return $this->sendResponse();
    }
}
