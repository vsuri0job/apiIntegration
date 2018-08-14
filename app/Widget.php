<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    protected $table = 'widget';
    protected $fillable = [
        'company_id','customer_id', 'url',
    ];

}
