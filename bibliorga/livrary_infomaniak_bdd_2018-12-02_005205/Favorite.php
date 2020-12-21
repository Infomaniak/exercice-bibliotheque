<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model 
{

    protected $table = 'favorites';
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function book()
    {
        return $this->belongsTo('Book');
    }

}