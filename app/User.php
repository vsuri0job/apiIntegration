<?php



namespace App;



use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Laravel\Cashier\Billable;







class User extends Authenticatable

{

    use Notifiable;

    use Billable;



    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'name', 'email', 'password', 'active', 'role','company_name','company_slug', 'transaction_id', 'end_date', 
        'stripe_customer_id', 'stripe_subscription_id', 'is_subscribed', 'google_token', 'google_access_token', 'google_refresh_token'

    ];



    /**

     * The attributes that should be hidden for arrays.

     *

     * @var array

     */

    protected $hidden = [

        'password', 'remember_token',

    ];



    public function review()

    {

        return $this->hasMany('App\Review');

    }

  

}

