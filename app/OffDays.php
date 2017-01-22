<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;

class OffDays extends Model
{
    //
     protected $table = 'offdays';
     protected $dates = [
         'offday'
     ];

     public function user(){
        return $this->belongsTo('App\User');
    }
}
