<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'rating';
    protected $fillable = [
        'customer_id', 'yelp_business_id', 'rating','comment','name','lastname','email','contact','created', 'user_url' ,'user_type','review_type', 'source'
    ];
      public function username()
    {
        return $this->belongsTo('App\User','customer_id','id');
    }

    public function social()
    {
    	return $this->belongsTo('App\Socialmedia','review_type','id');
    }
   

}
