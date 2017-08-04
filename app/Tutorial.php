<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;

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
    public function getVideoPath()
    {
        return '/uploads/tutorial_' . $this->id . '.mp4';
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function myLikes()
    {
        return $this->hasMany('App\Like')
            ->where('user_id', Auth::user()->id);
    }

}
