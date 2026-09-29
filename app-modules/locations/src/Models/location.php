<?php

namespace stockRatio\Locations\Models;

use Illuminate\Database\Eloquent\Model;

class location extends Model
{
    protected $fillable = [
        'name',
        'code',
        'address',

    ];
}
