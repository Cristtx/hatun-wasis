<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('products')->update([
            'nombre' => 'Tablón',
            'descripcion' => 'Descripción de tablón',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No es posible revertir un update masivo sin backups.
    }
};
