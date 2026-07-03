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
    Schema::create('productos', function (Blueprint $table) {
        $table->id();
        $table->string('codigo_sku')->unique();
        $table->string('nombre');
        $table->string('tipo'); // Porcelanato, Cerámico, Pegamento, Fragua
        $table->string('formato')->nullable(); // Ej: 60x120, 20x120
        $table->string('acabado')->nullable(); // Ej: Pulido, Mate, Satinado
        $table->decimal('precio_venta', 10, 2);
        $table->string('unidad_medida')->default('m2'); // m2 o Unidad
        $table->decimal('metros_por_caja', 8, 2)->nullable(); // Ej: 1.44 m² por caja
        $table->integer('stock_cajas')->default(0);
        $table->decimal('stock_total_m2', 10, 2)->default(0); // Calculado automáticamente
        $table->timestamps();
    });
}
};
