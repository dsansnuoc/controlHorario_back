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
        Schema::connection('mysql_empresa1')->create('fichaje', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('userId');
            $table->string('tipo_fichaje');
            $table->string('tipo_pausa')->nullable();
            $table->dateTime('hora_fichaje');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mysql_empresa1')->dropIfExists('fichaje');
    }
};