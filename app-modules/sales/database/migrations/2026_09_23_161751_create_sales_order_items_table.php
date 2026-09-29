<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sales_order_id')->constrained('sales_orders')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->unique(['sales_order_id', 'product_id']);
            $table->decimal('quantity', 14, 3)->default(0);
            $table->decimal('quantity_dispatched', 14, 3)->default(0);
            $table->decimal('unit_cost', 14, 3)->default(0);
            $table->decimal('discount', 14, 3)->default(0);
            $table->decimal('total_cost', 14, 3)->default(0);
            $table->timestamps();
        });




        DB::statement("ALTER TABLE sales_order_items
                        ADD CONSTRAINT chk_sales_order_item_quantities
                        CHECK(quantity >= quantity_dispatched);
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_order_items');
    }
};
