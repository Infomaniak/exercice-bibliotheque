<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * Get the books for the user.
     */
    public function books()
    {
        return $this->hasMany('App\Book');
    }
}
