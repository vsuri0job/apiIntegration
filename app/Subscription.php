<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'subscriptions';
    protected $fillable = [
        'name', 'user_id', 'name', 'stripe_id', 'stripe_plan', 'quantity', 
    ];
      
   

}