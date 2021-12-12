<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'product_price',
        'active',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class,'product_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class,'order_id');
    }
    
}
