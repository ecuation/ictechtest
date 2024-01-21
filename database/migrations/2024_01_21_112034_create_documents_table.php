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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyText('priority');
            $table->date('approved_at')->nullable();
            $table->string('file');
            $table->timestamps();
        });

        /*
         *
         * ○ Nombre del documento
○ Descripción
○ Relevancia (Alta, media y baja)
○ Fecha de aprobación del documento
○ Fecha de subida a la aplicación
○ Documento PDF*/
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
