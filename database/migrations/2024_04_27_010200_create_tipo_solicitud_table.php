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
        Schema::connection('mysql_empresa1')->create('tipo_solicitud', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('description', 50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mysql_empresa1')->dropIfExists('tipo_solicitud');
    }
};
