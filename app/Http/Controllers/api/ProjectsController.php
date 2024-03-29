<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Projects;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index(){
        $projects = Projects::orderBy('nombre', 'asc')->get();
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

    public function update(Request $request, Projects $project){
        $validate = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);

        if (!$validate){
            return $validate;
        }

        $project->update($request->only('nombre', 'descripcion'));
        return response()->json(['message' => 'ok', 'project' => $project]);
    }

    public function destroy(Projects $project){
        $project->delete();
        return response()->json(['message' => 'ok']);
    }
}
