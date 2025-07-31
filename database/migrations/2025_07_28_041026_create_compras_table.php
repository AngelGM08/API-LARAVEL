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
        Schema::create('compras', function (Blueprint $table) {
            $table->id('id_compra');
            $table->timestamps();
            $table->bigInteger('id_proveedor')->nullable();
            $table->bigInteger('id_producto')->nullable();
            $table->decimal('cantidad', 10, 2)->nullable();
            $table->string('unidad', 50)->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->foreign('id_proveedor')->references('id_proveedor')->on('proveedor');
            $table->foreign('id_producto')->references('id_producto')->on('producto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
