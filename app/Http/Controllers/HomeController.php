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
        $search = request('search');
        $leads = Lead::leftJoin('projects', 'projects.id', '=', 'leads.project_id')
                ->select('leads.*','projects.nombre as proyecto')
                ->when(request('search'), function($query) use ($search) {
                $query->where('leads.nombre', 'like', '%' . request('search') . '%')
                ->orWhere('ajetreo', 'like', '%' . request('search') . '%')
                ->orWhere('fecha', 'like', '%' . request('search') . '%')
                ->orWhere('projects.nombre', 'like', '%' . request('search') . '%')
                ->orWhere('telefono', 'like', '%' . request('search') . '%')
                ->orWhere('referente', 'like', '%' . request('search') . '%')
                ->orWhere('comentario', 'like', '%' . request('search') . '%');
            })
            ->when(auth()->user()->role != "admin", function($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->get();
            // return $leads;

        $projects = Projects::all();
        $situaciones = \App\Models\Situacion::all();
        $ajetreos = \App\Models\Ajetreo::all();
        $asesores = \App\Models\Asesores::all();
        $users = User::all();
        return view('home', compact('leads', 'projects','users', 'situaciones', 'ajetreos', 'asesores'));
    }

    public function utils()
    {
        return view('utils');
    }
}
