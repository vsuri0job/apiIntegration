<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Settings extends Authenticatable
{
    
    protected $fillable = [
        'set_type','set_value',
    ];

    
  
}
