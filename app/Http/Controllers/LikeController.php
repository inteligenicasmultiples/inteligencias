<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\User;
use App\Tutorial;
use App\Comment;
use App\Like;


class LikeController extends Controller
{

    public function likePost(Request $request, $intelligenceSlug, $tutorialId)
    {
        $this->validate($request, [
            'type' => 'required',
            'postId' => 'required',
        ]);

        if ($request->get('type') == 'tutorial') {

            $tutorial = Tutorial::findOrFail($request->get('postId'));

            $like = Like::where('user_id', Auth::user()->id)
                ->where('tutorial_id', $tutorial->id)
                ->first();
            if (is_null($like)) {
                $like = new Like;
                $like->user_id = Auth::user()->id;
                $like->tutorial_id = $tutorial->id;
                $like->save();
            }

            $totalLikes = $tutorial->likes->count();
        } else {

            $comment = Comment::findOrFail($request->get('postId'));

            $like = Like::where('user_id', Auth::user()->id)
                ->where('comment_id', $comment->id)
                ->first();

            if (is_null($like)) {
                $like = new Like;
                $like->user_id = Auth::user()->id;
                $like->comment_id = $comment->id;
                $like->save();
            }

            $totalLikes = $comment->likes->count();
        }

        return $totalLikes;
    }

    public function unlikePost(Request $request, $intelligenceSlug, $tutorialId)
    {
        $this->validate($request, [
            'type' => 'required',
            'postId' => 'required',
        ]);

        if ($request->get('type') == 'tutorial') {

            $tutorial = Tutorial::findOrFail($request->get('postId'));

            $like = Like::where('user_id', Auth::user()->id)
                ->where('tutorial_id', $tutorial->id)
                ->delete();

            $totalLikes = $tutorial->likes->count();
        } else {

            $comment = Comment::findOrFail($request->get('postId'));

            $like = Like::where('user_id', Auth::user()->id)
                ->where('comment_id', $comment->id)
                ->delete();

            $totalLikes = $comment->likes->count();
        }

        return $totalLikes;
    }

    public function whoLikePost(Request $request, $intelligenceSlug, $tutorialId)
    {
        $this->validate($request, [
            'type' => 'required',
            'postId' => 'required',
        ]);

        if ($request->get('type') == 'tutorial') {

            $tutorial = Tutorial::with(['likes', 'likes.user'])
                ->findOrFail($request->get('postId'));

            $likes = $tutorial->likes;
        } else {

            $comment = Comment::with(['likes', 'likes.user'])
                ->findOrFail($request->get('postId'));

            $likes = $comment->likes;
        }

        return $likes;
    }
}
