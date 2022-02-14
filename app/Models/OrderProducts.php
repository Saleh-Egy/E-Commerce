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
    protected $guarded = [];


    public function products()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function orders()
    {
        return $this->belongsTo(Order::class,'order_id');
    }
    
}
