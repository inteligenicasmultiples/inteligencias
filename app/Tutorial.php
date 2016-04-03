<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    public function intelligence()
    {
        return $this->belongsTo('App\Intelligence');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
