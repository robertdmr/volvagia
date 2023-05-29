<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjetreoController extends Controller
{
    public function index()
    {
        $ajetreo = \App\Models\Ajetreo::all();
        return response()->json($ajetreo);
    }
}
