<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    public function intelligence()
    {
        return $this->belongsTo('App\Intelligence');
    }
}
