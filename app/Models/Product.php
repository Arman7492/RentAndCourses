<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['product_name', 'category_id', 'unit_price'];
    protected $table = 'products';
    public $timestamps = false;
    
    use HasFactory;

    public function category(){
        return $this->belongsTo(Category::class); 
    }
    
    public function orderitems(){
        return $this->hasMany(OrderItem::class);
    }
}
