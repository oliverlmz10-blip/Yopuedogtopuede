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
      Schema::create('beneficiarios', function (Blueprint $table) {
    $table->id();
    $table->foreignId('grupo_id')->constrained('grupos');
    $table->string('folio');
    $table->string('curp');
    $table->string('nombre');
    $table->string('primer_apellido');
    $table->string('segundo_apellido')->nullable();
    $table->string('estatus');
    $table->date('anio_padron')->nullable();
    $table->date('fecha_termino')->nullable();
    $table->date('fecha_asignacion')->nullable();
    $table->integer('tot_asistencias')->default(0);
    $table->integer('porc_avance')->default(0);
    $table->string('respuesta_aprendizajes_cambio')->nullable();
    $table->string('observaciones')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beneficiarios');
    }
};
