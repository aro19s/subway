<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;
    protected $fillable = ['ingredient_name'];
    protected $table = 'ingredients';

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'product_ingredient',
            'ingredient_id',
            'product_id'
        )
            ->withTimestamps();
    }
}
