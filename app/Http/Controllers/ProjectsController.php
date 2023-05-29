<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index(){
        $projects = Projects::all();
        return view('proyectos', compact('projects'));
    }
}
