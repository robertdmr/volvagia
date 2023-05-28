<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\User;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $leads = Lead::where('user_id', auth()->user()->id)->with('project')->get();
        // return $leads;
        if(auth()->user()->isAdmin()){
            $leads = Lead::all();
        }
        $projects = Projects::all();
        $users = User::all();
        return view('home', compact('leads', 'projects','users'));
    }
}
