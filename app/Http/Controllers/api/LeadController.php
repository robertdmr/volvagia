<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    public function show(Lead $lead){
        return response()->json(['message' => 'ok', 'lead' => $lead]);
    }

    public function store(Request $request)
    {

        // return auth()->user();
        if(Auth::user()->role == "user"){
            $request->merge(['user_id' => Auth::user()->id]);
        }

        $validate = $request->validate([
            'ajetreo' => 'required',
            'as' => 'required',
            'fecha' => 'required',
        ]);

        if (!$validate){
            return "error";
        }

        $lead = Lead::create($request->all());

        return response()->json(['message' => 'ok', 'lead' => $lead]);
    }

    public function update(Lead $lead, Request $request)
    {
        return $request->all();
        $lead->update($request->all());
        return response()->json(['message' => 'ok', 'lead' => $lead]);
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();
        return response()->json(['message' => 'ok']);
    }

    public function updateColumn(Lead $lead, Request $request)
    {
        $column = $request->columna;
        $lead->update([$column => $request->valor]);
        return response()->json(['message' => 'ok', 'lead' => $lead]);
    }
}
