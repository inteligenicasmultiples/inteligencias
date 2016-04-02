<?php

namespace App\Http\Controllers;

use App\Intelligence;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TutorialController extends Controller
{
    public function create($intelligenceId)
    {
        $intelligence = Intelligence::findOrFail($intelligenceId);

        return view('intelligence.tutorial.create', compact('intelligence'));
    }

    public function store(Request $request, $intelligenceId)
    {
        $intelligence = Intelligence::findOrFail($intelligenceId);

        return $request->all();

    }
}
