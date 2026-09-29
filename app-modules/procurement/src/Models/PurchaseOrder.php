<?php

namespace stockRatio\Procurement\Models;

use Illuminate\Database\Eloquent\Model;
use Override;

class PurchaseOrder extends Model
{
    


    protected static function booted()
    {
        static::deleting(function ($purchaseOrder){

            $purchaseOrder->update([
                'status' => 'CANCELLED',
                'cancelled_at' => now(),
            ]);
            return false; // Prevent the actual deletion of the record
        });
    }
}
