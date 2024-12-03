<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        \DB::unprepared("ALTER TABLE `usuarios_clientes` ADD `contrasena` TEXT NOT NULL AFTER `email`, ADD `celular` BIGINT NOT NULL AFTER `contrasena`, ADD `rol_id` INT NOT NULL AFTER `celular`, ADD `token` TEXT NOT NULL AFTER `rol_id`, ADD `expiracion` DATETIME NULL AFTER `token`, ADD `estado` INT NOT NULL AFTER `expiracion`;");
        \DB::unprepared("INSERT INTO `roles` (`id`, `nombre`) VALUES ('1', 'cliente'), ('2', 'admin');");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
