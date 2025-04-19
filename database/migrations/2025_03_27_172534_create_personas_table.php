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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('razon_social', 80);
            $table->string('direccion', 80);
            $table->string('tipo_persona', 20);
            //telefono
            $table->string('telefono', 20);
            //correo
            $table->string('correo', 80);
            $table->tinyInteger('estado')->default(1);
            $table->foreignId('documento_id')->constrained('documentos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
