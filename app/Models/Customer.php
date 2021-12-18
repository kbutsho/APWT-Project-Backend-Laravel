<?php

namespace App\Models;

use App\Models\ProductRating;
use App\Models\ServiceRating;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    public $timestamps = false;

    //hasMany
    public function orders(){
        return $this->hasMany(Order::class,'customerId');
    }
    public function p_ratings(){
        return $this->hasMany(ProductRating::class,'customerId');
    }
    public function s_ratings(){
        return $this->hasMany(ServiceRating::class,'customerId');
    }
     // Eloquent
    //  public function p_ratings(){
    //     return ProductRating::where('customerId', $this->id)->get();
    // }

}
