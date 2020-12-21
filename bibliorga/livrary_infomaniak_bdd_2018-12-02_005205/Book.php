<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model 
{

    protected $table = 'books';
    public $timestamps = true;

    public function category()
    {
        return $this->belongsTo('Category');
    }

    public function author()
    {
        return $this->belongsTo('Author');
    }

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