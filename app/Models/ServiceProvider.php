<?php

namespace App\Models;

use App\Models\Delivery;
use App\Models\ServiceRating;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceProvider extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function deliveries(){
        return $this->hasMany(Delivery::class,'serviceProviderId');
    }
    public function s_ratings(){
        return $this->hasMany(ServiceRating::class,'serviceProviderId');
    }
    public function serviceNotes(){
        return $this->hasMany(Service::class,'serviceProviderId');
    }

}
