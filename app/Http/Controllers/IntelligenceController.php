<?php

namespace App\Http\Controllers;

use App\Intelligence;
use App\Tutorial;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IntelligenceController extends Controller
{
    public function index()
    {
        $intelligences = Intelligence::all();

        return view('intelligence.index', compact('intelligences'));
    }

    public function show($intelligenceSlug)
    {
        $intelligence = Intelligence::where('slug', $intelligenceSlug)->firstOrFail();
        $tutorials = Tutorial::where('intelligence_id', $intelligence->id)->orderBy('id','DESC')->paginate(10);

        return view('intelligence.show', compact('intelligence', 'tutorials'));
    }
}
