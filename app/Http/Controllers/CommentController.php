<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Intelligence;
use App\Tutorial;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class CommentController extends Controller
{
    public function store(Request $request, $intelligenceSlug, $tutorialId)
    {
        $this->validate($request, [
            'message' => 'required',
        ]);

        $intelligence = Intelligence::where('slug', $intelligenceSlug)->firstOrFail();
        $tutorial = Tutorial::where('intelligence_id', $intelligence->id)->findOrFail($tutorialId);

        $comment = new Comment;
        $comment->user_id = Auth::user()->id;
        $comment->tutorial_id = $tutorial->id;
        $comment->message = $request->message;
        $comment->save();

        Flash::success('Comentario creado exitosamente.');

        return redirect()->back();
    }
}
