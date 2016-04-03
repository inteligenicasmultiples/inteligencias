<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function tutorial()
    {
        return $this->belongsTo('App\Tutorial');
    }
}
