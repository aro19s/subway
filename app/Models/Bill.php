<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $table = 'bills';
    protected $fillable = ['user_id', 'product_id', 'total_price', 'amount'];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
