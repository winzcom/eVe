<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //

    public function categories(){
        $this->belongsToMany('App\Category');
    }

    public function addresses(){
        $this->hasMany('App\Address');
    }
}
