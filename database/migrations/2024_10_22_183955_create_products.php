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
          $table->string('name', 191)->nullable();
          $table->string('description', 255)->nullable();
          $table->string('barcode', 191)->nullable();
          $table->decimal('price', 6, 0)->nullable();
          $table->unsignedBigInteger('category')->nullable();
          $table->unsignedBigInteger('unit')->nullable();
          $table->timestamps();
          $table->unsignedBigInteger('created_by')->nullable();
          $table->unsignedBigInteger('updated_by')->nullable();
          $table->index('category');
          
          // Additional options
          $table->engine = 'InnoDB';
          $table->collation = 'utf8mb4_unicode_ci';
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
