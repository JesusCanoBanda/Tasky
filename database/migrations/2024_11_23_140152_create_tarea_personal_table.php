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
        Schema::create('tarea_personal', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamp('fecha_inicio')->useCurrent();
            $table->timestamp('fecha_final')->nullable();
            $table->string('descripcion');
            $table->string('estado');
            $table->integer('porcentaje');
            $table->string('nombre_campo')->nullable();

            $table->unsignedBigInteger('id_espacio');
            $table->foreign('id_espacio')
                ->references('id')->on('espacio_personal')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarea_personal');
    }
};
