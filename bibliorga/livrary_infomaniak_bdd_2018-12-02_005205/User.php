<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model 
{

    protected $table = 'users';
    public $timestamps = true;

    public function borrowings()
    {
        return $this->hasMany('Borrowing');
    }

    public function opinions()
    {
        return $this->hasOne('Opinion');
    }

    public function favorites()
    {
        return $this->hasMany('Favorite');
    }

    public function loves()
    {
        return $this->hasMany('Love');
    }

}