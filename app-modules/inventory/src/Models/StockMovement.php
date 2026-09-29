<?php

namespace stockRatio\Inventory\Models;

use Illuminate\Database\Eloquent\Model;
use RuntimeException;

class StockMovement extends Model
{
    

    protected static function booted():void{
        static::updating(function($movement){
            throw new RuntimeException('Immutability Error: Records cannot be updated. Create an opposing movement to correct this entry.');
        });

        static::deleting(function ($movement){
            throw new RuntimeException('Immutability Error: Records cannot be deleted. Create an opposing movement to correct this entry.');
        });
    }
}
