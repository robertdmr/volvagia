<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        // return $request->all();

        $validate = $request->validate([
            'ajetreo' => 'required',
            'as' => 'required',
            'fecha' => 'required',
            'proyecto_id' => 'required',
        ]);

        if (!$validate){
            return "error";
        }

        $lead = Lead::create($request->all());

        return response()->json(['message' => 'ok', 'lead' => $lead]);
    }

    public function update(Lead $lead, Request $request)
    {
        $validate = $request->validate([
            'ajetreo' => 'required',
            'as' => 'required',
            'fecha' => 'required',
            'proyecto_id' => 'required',
        ]);

        if (!$validate){
            return $validate;
        }

        $lead->update($request->all());
        return response()->json(['message' => 'ok', 'lead' => $lead]);
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();
        return response()->json(['message' => 'ok']);
    }
}
