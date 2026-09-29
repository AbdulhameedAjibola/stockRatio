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
        Schema::create('stock_levels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('location_id')->constrained('locations')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('quantity_on_hand', 14,3)->default(0);
            $table->decimal('quantity_reserved', 14,3)->default(0);
            $table->decimal('average_cost', 14,3)->default(0);
            $table->timestamps();
        });


        DB::statement(
            'ALTER TABLE stock_levels 
            ADD CONSTRAINT chk_stock_quantities
            CHECK(
            quantity_on_hand >= 0 AND
            quantity_reserved >= 0 AND
            quantity_on_hand >= quantity_reserved
            )'
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_levels');
    }
};
