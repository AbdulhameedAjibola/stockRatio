<?php

namespace stockRatio\Catalog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\stockRatio\Catalog\Database\Factories\CategoryFactory> */
    use HasFactory;


    protected $fillable = [
        'parent_id',
        'name',
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }
}
