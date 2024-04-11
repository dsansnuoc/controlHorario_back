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
        Schema::create('organizacion', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 100);
            $table->string('nif', 20);
            $table->string('email', 100);
            $table->string('conection',50);

            $table->string('smtpPort',50);
            $table->string('smtpUser',50);
            $table->string('smtpPassword',50);
            $table->string('smtpServer',50);

            $table->boolean('activate');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizacion');
    }
};