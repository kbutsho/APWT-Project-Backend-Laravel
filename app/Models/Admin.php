<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    public $timestamps = false;

    // public function sellers(){
    //     return $this->hasMany(Product::class,'sellerId');
    // }
    // public function serviceProviders(){
    //     return $this->hasMany(Product::class,'sellerId');
    // }
}
