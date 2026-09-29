<?php

namespace stockRatio\Catalog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\stockRatio\Catalog\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'sku',
        'name',
        'category_id',
        'units_of_measures_id',
        'description',
        'cost_price',
        'selling_price',
        'reorder_level'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function unitOfMeasure()
    {
        return $this->belongsTo(UnitsOfMeasure::class, 'units_of_measures_id');
    }
}
