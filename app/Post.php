<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 * @mixin \Eloquent
 * @package App
 */
class Post extends Model
{
    protected $fillable = [
        'subject',
        'body',
    ];

    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }
}
