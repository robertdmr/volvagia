<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Asesores;

class AsesoresController extends Controller
{
    public function index()
    {
        $asesores = Asesores::all();
        return response()->json($asesores);
    }
}
