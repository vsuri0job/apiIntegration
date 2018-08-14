<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Payment extends Model

{

    protected $table = 'charges';

    protected $fillable = [

        'user_id', 'event_id', 'amount', 'currency', 'network_status', 'seller_message', 'url_refund', 'card_id', 'card_brand', 'country', 'exp_month', 'exp_year', 'fingerprint', 'funding', 'last4', 'email', 'end_date',

    ];

      public function username()

    {

        //return $this->belongsTo('App\User','customer_id','id');
        return $this->belongsTo('App\User','user_id','id');

    }



   



}
