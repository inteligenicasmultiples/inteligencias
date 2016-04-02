<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intelligence extends Model
{
    public function tutorials()
    {
        return $this->hasMany('App\Tutorial');
    }
}
