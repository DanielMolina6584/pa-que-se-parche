<?php

namespace App\Http\Controllers;

use App\Service\Consolas\SvcConsolas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConsolasController extends Controller
{
    protected $svcConsolas;

    public function __construct(SvcConsolas $svcConsolas, Request $request)
    {
        parent::__construct($request);
        $this->svcConsolas = $svcConsolas;
    }

    public function listar()
    {
        $listadoConsolas = $this->svcConsolas->listar();
        $this->setDataResponse($listadoConsolas);
        $this->respSinError();
        return $this->sendResponse();
    }

    public function crear()
    {
        $validador = Validator::make($this->request->all(), [
            'nombre' => 'required',
            'marca' => 'required',
        ]);

        if ($validador->fails()) {
            foreach ($validador->errors()->all() as $error) {
                $this->agregarError($error);
            }
            return $this->sendResponse();
        }
        $dataRequest = $this->request->all();

        $this->svcConsolas->crear($dataRequest);
        $this->respSinError();
        return $this->sendResponse();
    }
}
