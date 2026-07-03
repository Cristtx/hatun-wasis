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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('codigo_sku')->nullable(); // Nuevo: Para identificar el producto
            $table->string('tipo')->default('Porcelanato'); // Nuevo: Porcelanato, Pegamento, etc.
            $table->string('formato')->nullable(); // Nuevo: 60x120, etc.
            $table->string('acabado')->nullable(); // Nuevo: Mate, Pulido
            $table->text('descripcion')->nullable();

            // Cantidad la mantendremos, pero asegúrate de que maneje el stock
            $table->integer('cantidad')->default(0);
            $table->double('precio');
            $table->boolean('disponible')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
