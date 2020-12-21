<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Love extends Model
{

    public $timestamps = true;
    protected $table = 'loves';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'book_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

}
