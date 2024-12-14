<?php

namespace App\Service\Usuarios;

use App\Models\Usuarios\Roles;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SvcRoles
{
    public function listar()
    {
        try {
            $listadoClientes = Roles::select();

            return $listadoClientes->get()?->toArray() ?? [];

        } catch (\Exception $e) {
            Log::error($e->getFile() . ' - ' . $e->getLine() . ' - ' . $e->getMessage());
            return [];
        }
    }
}
