<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'biography', 'image'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'full_name', 'profile_image',
    ];

    public $timestamps = true;
    protected $table = 'authors';

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    protected function getFullNameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getProfileImageAttribute()
    {
        $default = config('image.path_user_profile_image') . "photoUser.jpg";
        return empty($this->image) ? $default : config('image.path_authors_image') . $this->image;
    }

}
