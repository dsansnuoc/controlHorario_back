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
        Schema::connection('mysql_empresa1')->create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('userId');
            $table->string('tipo_solicitud');
            $table->dateTime('fecha_solicitud');

            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');

            $table->boolean('aceptada')->default(false);
            $table->dateTime('fecha_aceptada')->nullable();

            $table->boolean('rechazada')->default(false);
            $table->dateTime('fecha_rechazada')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mysql_empresa1')->dropIfExists('solicitudes');
    }
};
