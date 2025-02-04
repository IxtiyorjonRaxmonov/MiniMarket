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

        Schema::create('suppliers_products', function (Blueprint $table) {
            $table->id();
            $table->integer('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('restrict');            
            $table->integer('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('restrict');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers_products');
    }
};
