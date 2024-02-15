<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['order_date', 'order_number', 'customer_id', 'total_amount', 'id_cell'];
    protected $table = 'orders';
    public $timestamps = false;
    
    use HasFactory;

    public function customer(){
        return $this->belongsTo(Customer::class); 
    }
    
    public function orderitems(){
        return $this->hasMany(OrderItem::class);
    }
}
