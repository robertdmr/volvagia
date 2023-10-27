<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Asesores;

class AsesoresController extends Controller
{
    public function index()
    {
        $asesores = Asesores::orderBy('nombre', 'asc')->get();
        return response()->json($asesores);
    }

    public function show(Asesores $asesor)
    {
        return response()->json($asesor);
    }

    public function update(Request $request, Asesores $asesor)
    {
        $asesor->update($request->all());
        return response()->json($asesor);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'nombre' => 'required|unique:asesores,nombre',
        ]);
        if (!$validate) {
            return "Error al validar datos";
        }
        $asesores = Asesores::create($request->all());
        return response()->json($asesores);
    }

    public function destroy(Asesores $asesor)
    {
        $asesor->delete();
        return response()->json($asesor);
    }
}
