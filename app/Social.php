<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Social extends Model
{
    protected $table = 'social';
    protected $fillable = [
        'social_id','user_id', 'pagename' , 'socialurl', 'social_page_review_url' , 'url' , 'api' ,'secret', 'page_id', 'access_token', 
	];
    public function socialname()
    {
        return $this->belongsTo('App\Socialmedia','social_id','id');
    }
}
