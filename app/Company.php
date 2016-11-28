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
    
}
