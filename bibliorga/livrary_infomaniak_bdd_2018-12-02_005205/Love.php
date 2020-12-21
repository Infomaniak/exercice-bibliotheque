<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Love extends Model 
{

    protected $table = 'loves';
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