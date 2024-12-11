<?php

namespace App\Http\Controllers;

use App\Service\Usuarios\SvcCliente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AutenticacionController extends Controller
{
    protected $svcUsuariosCliente;

    public function __construct(SvcCliente $svcUsuariosCliente, Request $request)
    {
        parent::__construct($request);
        $this->svcUsuariosCliente = $svcUsuariosCliente;
    }

    public function registrarCliente()
    {
        $validador = Validator::make($this->request->all(), [
            'nombre' => 'required',
            'email' => 'required',
            'contrasena' => 'required',
            'celular' => 'required',
        ]);

        if ($validador->fails()) {
            foreach ($validador->errors()->all() as $error) {
                $this->agregarError($error);
            }
            return $this->sendResponse();
        }

        $dataUser = $this->request->all();
        $verificarUser = $this->svcUsuariosCliente->listar(['email' => $dataUser['email']]);

        if (!empty($verificarUser)) {
            $this->agregarError('este correo ya se encuentra registrado');
            return $this->sendResponse();
        }

        $idClienteNuevo = $this->svcUsuariosCliente->crear($dataUser);

        if (!empty($idClienteNuevo['id'])) {
            $rol = $this->svcUsuariosCliente->rolById($dataUser['rol_id'] ?? 1);
            $dataResponse = [
                'id' => $idClienteNuevo['id'],
                'rol' => $rol['nombre'],
                'token' => $idClienteNuevo['token'],
            ];

            $this->setDataResponse($dataResponse);
            $this->respSinError();
        }

        return $this->sendResponse();
    }

    public function login()
    {
        $validador = Validator::make($this->request->all(), [
            'email' => 'required',
            'contrasena' => 'required',
        ]);

        if ($validador->fails()) {
            foreach ($validador->errors()->all() as $error) {
                $this->agregarError($error);
            }
            return $this->sendResponse();
        }

        $dataUser = $this->request->all();
        $verificarUser = $this->svcUsuariosCliente->listar(['email' => $dataUser['email']]);

        if (empty($verificarUser)) {
            $this->agregarError('El correo no existe');
            return $this->sendResponse();
        }

        if (Hash::check($dataUser['contrasena'], $verificarUser['contrasena'])) {
            $generarToken = $this->svcUsuariosCliente->generarTokenYExpiracion();
            $dataActualizar = [
                'token' => $generarToken['token'],
                'expiracion' => $generarToken['expiracion'],
            ];

            $this->svcUsuariosCliente->actualizarCliente($dataActualizar, $dataUser['email']);

            $rol = $this->svcUsuariosCliente->rolById($verificarUser['rol_id']);
            $dataResponse = [
                'id' => $verificarUser['id'],
                'rol' => $rol['nombre'],
                'token' => $generarToken['token'],
            ];

            $this->setDataResponse($dataResponse);
            $this->respSinError();
        } else {
            $this->agregarError('Contrasena Incorrecta');
        }

        return $this->sendResponse();
    }

    public function verificarTokenRol()
    {
        $validador = Validator::make($this->request->all(), [
            'token' => 'required',
            'rol' => 'required',
        ]);

        if ($validador->fails()) {
            foreach ($validador->errors()->all() as $error) {
                $this->agregarError($error);
            }
            return $this->sendResponse();
        }

        $dataRequest = $this->request->all();
        $verificarUser = $this->svcUsuariosCliente->listar(['token' => $dataRequest['token']]);

        if (!empty($verificarUser) && $verificarUser['token'] == $dataRequest['token']) {
            if (Carbon::now() < $verificarUser['expiracion']) {
                $rol = $this->svcUsuariosCliente->rolByNombre($dataRequest['rol']);
                if ($verificarUser['rol_id'] == $rol['id']) {
                    $this->respSinError();
                } else {
                    $this->agregarError('Acceso denegado');
                }
            } else {
                $this->agregarError('Su sesion ya expiro');
            }
        } else {
            $this->agregarError('Token incorrecto');
        }

        return $this->sendResponse();
    }
}
