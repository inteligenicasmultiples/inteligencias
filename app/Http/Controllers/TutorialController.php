<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests;
use App\Intelligence;
use App\Tutorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class TutorialController extends Controller
{
    public function show($intelligenceSlug, $tutorialId)
    {
        $intelligence = Intelligence::where('slug', $intelligenceSlug)->firstOrFail();
        $tutorial = Tutorial::where('intelligence_id', $intelligence->id)->findOrFail($tutorialId);
        $comments = Comment::where('tutorial_id', $tutorial->id)->paginate(15);

        return view('intelligence.tutorial.show', compact('intelligence', 'tutorial','comments'));
    }


    public function create($intelligenceSlug)
    {
        $intelligence = Intelligence::where('slug', $intelligenceSlug)->firstOrFail();

        return view('intelligence.tutorial.create', compact('intelligence'));
    }

    public function store(Request $request, $intelligenceSlug)
    {
        $this->validate($request, [
            'title' => 'required',
            'url' => 'required',
        ]);

        $intelligence = Intelligence::where('slug', $intelligenceSlug)->firstOrFail();

        $tutorial = new Tutorial;
        $tutorial->user_id = Auth::user()->id;
        $tutorial->intelligence_id = $intelligence->id;
        $tutorial->title = $request->title;
        $tutorial->url = $request->url;
        $tutorial->save();

        //return $request->all();

        Flash::success('Tutorial creado exitosamente.');

        return redirect()->route('intelligence.show', $intelligenceSlug);
    }
}
