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
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('location_id')->constrained('locations')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('movement_type', ['PURCHASE_RECEIPT', 'SALE_DISPATCH', 'TRANSFER_IN', 'TRANSFER_OUT', 'ADJUSTMENT', 'RETURN']);
            $table->enum('reference_type', ['goods_receipt', 'dispatch', 'transfer', 'adjustment', 'return']);
            $table->string('reference_number');
            $table->decimal('quantity', 14,3)->default(0);
            $table->decimal('available_on_hand', 14,3)->default(0);
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            
            $table->timestamps();
        });



        DB::unprepared(
            "CREATE TRIGGER prevent_stock_movement_update
            BEFORE UPDATE ON stock_movements
            FOR EACH ROW
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Stock movements cannot be updated. Please create a new stock movement instead.'"
        );

        DB::unprepared("CREATE TRIGGER prevent_stock_movement_delete
            BEFORE DELETE ON stock_movements
            FOR EACH ROW
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Deletions are strictly prohibited on this table.'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
