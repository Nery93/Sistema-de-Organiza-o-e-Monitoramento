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

        Schema::create('un', function (Blueprint $table) {
            $table->id();
            $table->string('unit')->unique();
            $table->string('business_unit');
            $table->string('business_type');
            $table->timestamps();
        });

        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nome_categoria');
            $table->timestamps();
        });

        Schema::create('subcategorias', function (Blueprint $table) {
            $table->id();
            $table->string('sub_categoria');
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('produtos', function (Blueprint $table) {

            $table->string('sku')->unique();
            $table->string('ean',);
            $table->integer('un');
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade'); 
            $table->foreignId('subcategoria_id')->constrained('subcategorias')->onDelete('cascade'); 
            $table->string('descrição');
            $table->integer('contagem');
            $table->integer('stock');
            $table->integer('diferença_stock');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('un');
        Schema::dropIfExists('categorias');
        Schema::dropIfExists('subcategorias');
        Schema::dropIfExists('produtos');
    }
};
