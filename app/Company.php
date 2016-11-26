<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Model
{
    //

    protected $fillable = [
        'name', 'email', 'password',
    ];
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
