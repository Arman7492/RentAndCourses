<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $fillable = ['first_name', 'last_name', 'rent_price']; 
    use HasFactory;

    public function orderitems(){        
        return $this->hasMany(OrderItem::class);
    }
    
}
