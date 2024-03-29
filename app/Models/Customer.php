<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['first_name', 'last_name', 'phone_number', 'password']; 

    use HasFactory;

    public function orders(){        
        return $this->hasMany(Order::class);
    }

}
