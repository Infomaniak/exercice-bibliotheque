<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model 
{

    protected $table = 'categories';
    public $timestamps = true;

    public function books()
    {
        return $this->hasMany('Book');
    }

}