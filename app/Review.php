<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Review extends Authenticatable
{
    
	protected $table = 'reviews';
    protected $fillable = [
        'customer_id', 'review', 
    ];
   
   
}
