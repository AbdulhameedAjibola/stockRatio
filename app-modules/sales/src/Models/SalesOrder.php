<?php

namespace stockRatio\Sales\Models;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    

    protected static function booted(){
        
        static::deleting(function ($salesOrder){
            $salesOrder->update([
                'status' => 'CANCELLED',
                'cancelled_at' => now(),
            ]);

        });
    }
}
