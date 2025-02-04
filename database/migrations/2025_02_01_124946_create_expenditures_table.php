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
        Schema::create('expenditures', function (Blueprint $table) {
            $table->id();
            $table->integer('supplier_product_id');
            $table->foreign('supplier_product_id')
            ->references('id')
            ->on('suppliers_products')
            ->onDelete('restrict');
            $table->float('total_price_UZS');
            $table->float('total_price_USD');
            $table->float('quantity_sold');
            $table->integer('currency_id');
            $table->foreign('currency_id')
            ->references('id')
            ->on('currencies')
            ->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenditures');
    }
};
