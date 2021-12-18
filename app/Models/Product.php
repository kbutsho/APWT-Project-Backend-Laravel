<?php

namespace App\Models;

use App\Models\Order;
use App\Models\ProductRating;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    // public $timestamps = false;
    
    // HasMany
    public function orders(){
        return $this->hasMany(Order::class,'productId');
    }
    //eloquent
    // public function orders(){
    //     return Order::where('productId', $this->id)->get();
    // }
    // Eloquent
    // public function productRatings(){
    //     return ProductRating::where('productId', $this->id)->get();
    // }
    // hasMany
    public function productRatings(){
        return $this->hasMany(productRating::class,'productId');
    }
   
   
    
}
