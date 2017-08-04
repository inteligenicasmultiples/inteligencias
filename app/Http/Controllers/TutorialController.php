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
        ]);

        $intelligence = Intelligence::where('slug', $intelligenceSlug)->firstOrFail();
        $tutorialId = session('tutorialId');
        $tutorial = Tutorial::findOrFail($tutorialId);
        $tutorial->title = $request->title;
        $tutorial->visible = 1;
        $tutorial->save();

        Flash::success('Tutorial creado exitosamente.');

        return redirect()->route('intelligence.show', $intelligenceSlug);
    }

    public function storeVideo(Request $request, $intelligenceSlug)
    {
        $intelligence = Intelligence::where('slug', $intelligenceSlug)->firstOrFail();

        if ($request->hasFile('files')) {
            $tutorial = new Tutorial;
            $tutorial->user_id = Auth::user()->id;
            $tutorial->intelligence_id = $intelligence->id;
            $tutorial->visible = 0;
            $tutorial->save();

            $files = $request->file('files');
            foreach ($files as $file) {
                $fileName = 'tutorial_' . $tutorial->id . '.mp4';
                $file->move('uploads', $fileName);
            }

            session(['tutorialId' => $tutorial->id]);
        }
    }
}
