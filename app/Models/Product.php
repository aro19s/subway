<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['product_name', 'price'];
    protected $table = 'products';

    public function bills()
    {
        return $this->hasMany(Bill::class, 'product_id');
    }


    public function ingredients()
    {
        return $this->belongsToMany(
            Ingredient::class,
            'product_ingredient',
            'product_id',
            'ingredient_id'
        )
            ->withTimestamps();
    }
}
