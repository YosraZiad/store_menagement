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
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');

            $table->string('short_name')->nullable();
            $table->string('field');
            $table->string('status')->nullable()->default(1);

            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->engine('InnoDB');
        });

        Schema::create('providers_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->text('address')->nullable();
            $table->string('logo')->nullable();
            $table->unsignedBigInteger('provider');
            $table->string('website')->nullable(); // Assuming you meant to have this field twice?
            $table->string('cr_number')->nullable();
            $table->string('vat_number')->nullable();
            $table->decimal('rate', 10, 2)->nullable(); // Assuming rate is a decimal
            $table->decimal('minimum_order', 10, 2)->nullable(); // Assuming minimum_order is a decimal
            $table->text('payment_terms')->nullable();
            $table->text('shipping_methods')->nullable();
            $table->text('shipping_costs')->nullable();
            $table->text('about')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            
            $table->timestamps();
            $table->engine('InnoDB');

            $table->foreign('provider')->references('id')->on('providers')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};
