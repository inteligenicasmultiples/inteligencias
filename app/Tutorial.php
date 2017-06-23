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

    public function getYoutubeId()
    {
        parse_str(parse_url( $this->url, PHP_URL_QUERY ), $vars);

        return $vars['v'];
    }
}
