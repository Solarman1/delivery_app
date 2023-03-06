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
        Schema::create('lunch_types_product_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lunch_type_id');
            $table->unsignedBigInteger('product_type_id');
            $table->timestamps();

            $table->foreign('lunch_type_id')
                ->references('id')
                ->on('lunch_types');

            $table->foreign('product_type_id')
                ->references('id')
                ->on('lunch_products_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lunch_types_product_types');
    }
};
