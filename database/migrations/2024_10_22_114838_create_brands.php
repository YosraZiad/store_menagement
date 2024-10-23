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
        Schema::create('brands', function (Blueprint $table) {
          $table->id();
        $table->string('name')->nullable(); 
        $table->string('description')->nullable();
        $table->string('brand_logo')->nullable(); 
        $table->string('country_origin')->nullable();
        $table->string('website')->nullable();
        $table->unsignedBigInteger('company_id')->nullable();
        $table->timestamps();
        $table->unsignedBigInteger('created_by')->nullable();
        $table->unsignedBigInteger('updated_by')->nullable();

        $table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
