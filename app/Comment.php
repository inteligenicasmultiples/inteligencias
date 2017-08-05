<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Comment extends Model
{
    public function tutorial()
    {
        return $this->belongsTo('App\Tutorial');
    }

    public function getYoutubeId()
    {
        parse_str(parse_url($this->url, PHP_URL_QUERY), $vars);

        return $vars['v'];
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

    public function getVideoPath()
    {
        return '/uploads/comments/comment_' . $this->id . '.webm';
    }
}
