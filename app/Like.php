<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Like extends Model
{
    public function likeable()
    {
        return $this->morphTo();
    }
}
