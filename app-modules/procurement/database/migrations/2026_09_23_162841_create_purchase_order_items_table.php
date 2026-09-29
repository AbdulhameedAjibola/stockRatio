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
        Schema::create('purchase_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_order_id')->constrained('purchase_orders')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->unique(['purchase_order_id', 'product_id']);
            $table->decimal('quantity_ordered', 14, 3)->default(0);
            $table->decimal('quantity_received', 14, 3)->default(0);
            $table->decimal('unit_cost', 14, 3)->default(0);
            $table->decimal('total_cost', 14, 3)->default(0);
            $table->timestamps();
        });



        DB::statement("ALTER TABLE purchase_order_items
                        ADD CONSTRAINT chk_purchase_order_item_quantities
                        CHECK (quantity_ordered > 0 AND quantity_received >= 0 
                        AND quantity_ordered >= quantity_received);
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order_items');
    }
};
