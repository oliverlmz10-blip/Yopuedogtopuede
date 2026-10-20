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
      Schema::create('grupos', function (Blueprint $table) {
    $table->id();
    $table->foreignId('promotor_id')->constrained('promotores');
    $table->foreignId('municipio_id')->constrained('municipios');
    $table->string('identificador_grupo');
    $table->integer('grupo_inicial');
    $table->integer('grupo_final');
    $table->string('lugar_fecha_evento');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupos');
    }
};
