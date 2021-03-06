<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    protected $table = "reviews";

    protected $fillable = [
        'reviewers_name',
        'reviewers_email',
        'rating',
        'review',
        'review_for',
        'reply'
    ];

    public function user(){
        return $this->belongsTo('App\User','review_for');
    }
}
