<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'product_id', 'unit_price', 'total_amount', 'quantity', 'instructor_id', 'rent_price', 'return_date' ];
    protected $table = 'orderitems';
    public $timestamps = false;
    
    use HasFactory;

    public function order(){
        return $this->belongsTo(Order::class); 
    }

    public function product(){
        return $this->belongsTo(Product::class); 
    }
    
    public function instructor(){
        return $this->belongsTo(Instructor::class); 
    }
}
