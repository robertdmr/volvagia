<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Situacion;

class SituacionController extends Controller
{
    public function index()
    {
        $situacion = Situacion::all();
        return response()->json($situacion);
    }

    public function show(Situacion $situacion)
    {
        return response()->json($situacion);
    }

    public function update(Request $request, Situacion $situacion)
    {
        $situacion->update($request->all());
        return response()->json($situacion);
    }

    public function store(Request $request)
    {
        $situacion = Situacion::create($request->all());
        return response()->json($situacion);
    }

    public function destroy(Situacion $situacion)
    {
        $situacion->delete();
        return response()->json($situacion);
    }
}
