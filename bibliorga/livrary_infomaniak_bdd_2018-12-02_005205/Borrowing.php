<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model 
{

    protected $table = 'borrowings';
    public $timestamps = true;

    public function books()
    {
        return $this->belongsTo('Book');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

}