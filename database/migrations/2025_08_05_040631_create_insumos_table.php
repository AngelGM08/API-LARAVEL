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
        Schema::create('insumos', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_produccion');
            $table->unsignedBigInteger('id_compra');
            $table->decimal('cantidad_usada', 10, 2);
            $table->timestamps();

            // Claves foráneas
            $table->foreign('id_produccion')->references('id_produccion')->on('produccion')->onDelete('cascade');
            $table->foreign('id_compra')->references('id_compra')->on('compras')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insumos');
    }
};
