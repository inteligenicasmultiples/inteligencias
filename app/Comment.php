<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function tutorial()
    {
        return $this->belongsTo('App\Tutorial');
    }

    public function getYoutubeId()
    {
        parse_str(parse_url( $this->url, PHP_URL_QUERY ), $vars);

        return $vars['v'];
    }
}
