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
        Schema::create('proveedor', function (Blueprint $table) {
            $table->id('id_proveedor');
            $table->timestamps();
            $table->string('nombre',100);
            $table->string('apellido_paterno',50);
            $table->string('apellido_materno',50);
            $table->string('telefono',15);
            $table->string('email',100)->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedor');
    }
};
