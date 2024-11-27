<?php

namespace App\Http\Controllers;

use App\Service\VideoJuegos\SvcVideoJuegos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VideoJuegosController extends Controller
{
    protected $svcVideoJuegos;

    public function __construct(SvcVideoJuegos $svcVideoJuegos, Request $request)
    {
        parent::__construct($request);
        $this->svcVideoJuegos = $svcVideoJuegos;
    }

    public function listar()
    {
        $listadoVideojuegos = $this->svcVideoJuegos->listar();
        $this->setDataResponse($listadoVideojuegos);
        $this->respSinError();
        return $this->sendResponse();
    }

    public function crear()
    {
        $validador = Validator::make($this->request->all(), [
            'titulo' => 'required',
            'genero' => 'required',
            'descripcion' => 'required',
            'imagen' => 'required',
        ]);

        if ($validador->fails()) {
            foreach ($validador->errors()->all() as $error) {
                $this->agregarError($error);
            }
            return $this->sendResponse();
        }
        $dataRequest = $this->request->all();

        $this->svcVideoJuegos->crear($dataRequest);
        $this->respSinError();
        return $this->sendResponse();
    }
}
