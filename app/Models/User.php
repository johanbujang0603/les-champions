<?php

namespace App\Models;

use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
    use Notifiable;
    use InteractsWithMedia;

    /** @var int */
    public const AVATAR_LARGE_WIDTH = 300;

    /** @var int */
    public const AVATAR_LARGE_HEIGHT = 300;

    /** @var int */
    public const AVATAR_THUMBNAIL_WIDTH = 128;

    /** @var int */
    public const AVATAR_THUMBNAIL_HEIGHT = 128;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function registerMediaCollections() : void
    {
        $this->addMediaCollection('users-avatars')->singleFile();
    }

    public function registerMediaConversions(Media $media = null) : void
    {
        $this->addMediaConversion('large')
            ->width(static::AVATAR_LARGE_WIDTH)
            ->fit(Manipulations::FIT_CROP, static::AVATAR_LARGE_WIDTH, static::AVATAR_LARGE_HEIGHT)
            ->performOnCollections('users-avatars');

        $this->addMediaConversion('thumbnail')
            ->width(static::AVATAR_THUMBNAIL_WIDTH)
            ->fit(Manipulations::FIT_CROP, static::AVATAR_THUMBNAIL_WIDTH, static::AVATAR_THUMBNAIL_HEIGHT)
            ->performOnCollections('users-avatars');
    }

    public function getFullNameAttribute() : string
    {
        return $this->first_name.' '.$this->last_name;
    }
}
