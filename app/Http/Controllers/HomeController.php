<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Intelligence;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $intelligences = Intelligence::all();

        return view('home', compact('intelligences'));
    }
}
