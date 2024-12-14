<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Service\Consolas\SvcConsolas;
use App\Service\Usuarios\SvcCliente;
use App\Service\Usuarios\SvcRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsuariosController extends Controller
{
    protected $svcCliente;
    protected $svcRoles;

    public function __construct(SvcCliente $svcCliente, SvcRoles $svcRoles, Request $request)
    {
        parent::__construct($request);
        $this->svcCliente = $svcCliente;
        $this->svcRoles = $svcRoles;
    }

    public function listar()
    {
        $listadoData['usuarios'] = $this->svcCliente->listar(array: true);
        $listadoData['roles'] = $this->svcRoles->listar();
        $this->setDataResponse($listadoData);
        $this->respSinError();
        return $this->sendResponse();
    }

    public function crear($id = '')
    {
        $validador = Validator::make($this->request->all(), [
            'nombre' => 'required',
            'email' => 'required',
            'celular' => 'required|numeric',
            'rol' => 'required',
        ]);

        if ($validador->fails()) {
            foreach ($validador->errors()->all() as $error) {
                $this->agregarError($error);
            }
            return $this->sendResponse();
        }
        $dataRequest = $this->request->all();

        $dataGestionar = [
            'nombre' => $dataRequest['nombre'],
            'email' => $dataRequest['email'],
            'celular' => $dataRequest['celular'],
            'rol_id' => $dataRequest['rol'],
        ];

        if (!empty($id)) {
            if (!empty($dataRequest['contrasena'])) {
                $dataGestionar['contrasena'] = $dataRequest['contrasena'];
            }
            $this->svcCliente->actualizarCliente($dataGestionar, $id);
            $this->respSinError();
            return $this->sendResponse();
        }

        $verificarCliente = $this->svcCliente->listar(['email' => $dataRequest['email']]);

        if (!empty($verificarCliente)) {
            $this->agregarError("El email ya existe");
            return $this->sendResponse();
        }

        $dataGestionar['contrasena'] = $dataRequest['contrasena'];
        $this->svcCliente->crear($dataGestionar);
        $this->respSinError();
        return $this->sendResponse();
    }

    public function eliminar($id)
    {
        if (!empty($id)) {
            $this->svcCliente->eliminarCliente($id);
            $this->respSinError();
        }
        return $this->sendResponse();
    }
}
