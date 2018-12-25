<?php

namespace App\Models;

use App\Enums\RoleEnum;
use App\Notifications\RegisteredConfirm;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'image', 'birthday', 'email', 'password', 'attachment', 'role', 'is_verified', 'sex'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'full_name', 'profile_image', 'attachment_image',
    ];

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new RegisteredConfirm());
    }

    public function isAdmin()
    {
        return $this->role == RoleEnum::ADMIN;
    }

    public function isLibrarian()
    {
        return $this->role == RoleEnum::lIBRARIAN;
    }

    public function isUser()
    {
        return $this->role == RoleEnum::USER;
    }

    protected function getFullNameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getProfileImageAttribute()
    {
        $default = config('image.path_user_profile_image') . "photoUser.jpg";
        return empty($this->image) ? $default : config('image.path_user_profile_image') . $this->image;
    }

    public function getAttachmentImageAttribute()
    {
        $default = config('image.path_user_attachment_image') . "default.png";
        return empty($this->attachment) ? $default : config('image.path_user_attachment_image') . $this->attachment;
    }

    // RELATIONS
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    public function opinions()
    {
        return $this->hasOne(Opinion::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function loves()
    {
        return $this->hasMany(Love::class);
    }
}
