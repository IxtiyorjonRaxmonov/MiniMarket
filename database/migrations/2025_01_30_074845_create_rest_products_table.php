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

        Schema::create('rest_products', function (Blueprint $table) {
            $table->id();
            $table->integer('supplier_product_id');
            $table->foreign('supplier_product_id')
            ->references('id')
            ->on('suppliers_products')
            ->onDelete('restrict');
            $table->float('stock_quantity');
            $table->timestamps();
        });
        

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rest_products');
    }
};
