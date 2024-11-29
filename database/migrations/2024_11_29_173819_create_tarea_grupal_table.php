<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarea_grupal', function (Blueprint $table) {
            $table->id(); // id int pk
            $table->timestamp('fechainicio'); // fechainicio timestamp
            $table->timestamp('fechafinal'); // fechafinal timestamp
            $table->string('descripcion'); // descripcion varchar
            $table->string('estado'); // estado varchar
            $table->unsignedInteger('porcentaje'); // porcentaje integer
            $table->string('categoria'); // categoria varchar
            $table->unsignedBigInteger('id_espacio'); // id_espacio integer
            $table->string('responsable'); // responsable varchar
            $table->timestamps(); // created_at y updated_at

            // Llave foránea
            $table->foreign('id_espacio')->references('id')->on('espacio_grupal')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tarea_grupal');
    }
};
