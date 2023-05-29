<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SituacionController extends Controller
{
    public function index()
    {
        $situacion = \App\Models\Situacion::all();
        return response()->json($situacion);
    }
}
