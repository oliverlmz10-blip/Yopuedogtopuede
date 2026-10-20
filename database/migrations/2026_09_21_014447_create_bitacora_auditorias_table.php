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
      Schema::create('bitacora_auditorias', function (Blueprint $table) {
    $table->id();
    $table->string('ticket_id');
    $table->string('usuario_responsable');
    $table->string('tabla_afectada');
    $table->unsignedBigInteger('registro_id');
    $table->string('accion');
    $table->text('datos_anteriores')->nullable();
    $table->text('datos_nuevos')->nullable();
    $table->timestamp('created_at')->useCurrent();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bitacora_auditorias');
    }
};
