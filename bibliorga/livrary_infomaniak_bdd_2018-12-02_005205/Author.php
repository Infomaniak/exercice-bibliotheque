<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model 
{

    protected $table = 'authors';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image', 'firstname', 'lastname', 'biography',
    ];

    public function books()
    {
        return $this->hasMany('Book');
    }

}
