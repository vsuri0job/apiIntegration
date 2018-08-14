<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Socialmedia extends Model
{
    protected $table = 'socialmedia';

    
     protected $fillable = [
        'name', 
    ];
  
     public function ratings($user_id)
   {
   		return $this->hasMany('App\Rating', 'review_type', 'id')->where('customer_id', $user_id);
   }


    
  
}
