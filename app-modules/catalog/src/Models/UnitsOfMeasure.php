<?php

namespace stockRatio\Catalog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitsOfMeasure extends Model
{
    /** @use HasFactory<\stockRatio\Catalog\Database\Factories\UnitsOfMeasureFactory> */
    use HasFactory;


    protected $fillable = [
        'name',
        'abbreviation',
        'allows_decimal',
    ];


    public function products()
    {
        return $this->hasMany(Product::class, 'units_of_measures_id');
    }
}
