<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opinion extends Model 
{

    protected $table = 'opinions';
    public $timestamps = true;

    public function book()
    {
        return $this->belongsTo('Book');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

}