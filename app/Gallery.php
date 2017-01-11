<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    //
    protected $table = "galleries";

    protected $fillable = ['user_id','image_name','caption'];

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
}
