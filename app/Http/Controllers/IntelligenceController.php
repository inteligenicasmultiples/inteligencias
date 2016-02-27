<?php

namespace App\Http\Controllers;

use App\Intelligence;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IntelligenceController extends Controller
{
    public function show($intelligenceId)
    {
        $intelligence = Intelligence::findOrFail($intelligenceId);

        return view('intelligence.show', compact('intelligence'));
    }
}
