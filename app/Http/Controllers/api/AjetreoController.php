<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ajetreo;

class AjetreoController extends Controller
{
    public function index()
    {
        $ajetreo = Ajetreo::all();
        return response()->json($ajetreo);
    }

    public function show(Ajetreo $ajetreo)
    {
        return response()->json($ajetreo);
    }

    public function update(Request $request, Ajetreo $ajetreo)
    {
        $ajetreo->update($request->all());
        return response()->json($ajetreo);
    }

    public function store(Request $request)
    {
        $ajetreo = Ajetreo::create($request->all());
        return response()->json($ajetreo);
    }

    public function destroy(Ajetreo $ajetreo)
    {
        $ajetreo->delete();
        return response()->json($ajetreo);
    }
}
