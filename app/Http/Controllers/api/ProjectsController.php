<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Projects;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index(){
        $projects = Projects::all();
        return response()->json(['message' => 'ok', 'projects' => $projects]);
    }

    public function store(Request $request){
        $validate = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);

        if (!$validate){
            return $validate;
        }

        $project = Projects::create($request->only('nombre', 'descripcion'));
        return response()->json(['message' => 'ok', 'project' => $project]);

    }
}
