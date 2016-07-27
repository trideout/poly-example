<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment
 * @package App
 */
class Comment extends Model
{
    protected $fillable = [
        'post_id',
        'body',
    ];

    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }
}
