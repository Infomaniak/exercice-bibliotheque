<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    public $timestamps = true;
    protected $table = 'books';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'publication', 'ref', 'description', 'image', 'quantity', 'category_id', 'author_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'quantity' => 'integer',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'cover_url',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    public function opinions()
    {
        return $this->hasMany(Opinion::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function loves()
    {
        return $this->hasMany(Love::class);
    }

    public function getCoverUrlAttribute()
    {
        $default = config('image.path_book_image') . "default.png";
        return empty($this->image) ? $default : config('image.path_book_image') . $this->image;
    }

}
