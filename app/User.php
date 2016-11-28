<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "companies";
    protected $fillable = [
        'name','email','password','password_confirm','first_name','last_name',
        'category',
        'description',
        'phone_no'
    ];

    protected $guard = [];


    protected static  $formInputs = [
        'name','email','password','password_confirm','first_name','last_name',
        'phone_no',
        'house_no',
        'street_name',
        'state',
        'category',
        'description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function getFormInputs(){
        return self::$formInputs;
    }

    public function categories(){
       return $this->belongsToMany('App\Category','company_category','company_id','category_id');
    }

    public function addresses(){
        $this->hasMany('App\Address');
    }

    public function getRouteKeyName(){
        return 'name_slug';
    }
}
