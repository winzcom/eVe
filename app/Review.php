<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    protected $table = "reviews";

    protected $fillable = [
        'reviewers_name',
        'rating',
        'review',
        'review_for'
    ];

    public function user(){
        return $this->belongsTo('App\User','review_for');
    }
}
