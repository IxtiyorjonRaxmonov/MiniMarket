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
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->integer('supplier_product_id');
            $table->foreign('supplier_product_id')->references('id')->on('suppliers_products')->onDelete('restrict');
            $table->integer('currency_id');
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('restrict');
            $table->float('per_purchase_UZS');
            $table->float('per_purchase_USD');
            $table->integer('measurement_id');
            $table->foreign('measurement_id')->references('id')->on('measurements')->onDelete('restrict');
            $table->float('quantity');
            $table->integer('remaining_quantity')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};
