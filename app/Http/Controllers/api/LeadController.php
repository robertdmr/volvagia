<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Imports\LeadImport;
use App\Models\Ajetreo;
use App\Models\Asesores;
use App\Models\Lead;
use App\Models\Projects;
use App\Models\Situacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

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
            'nombre' => 'unique:leads,nombre',
            'telefono' => 'unique:leads,telefono',
            'as' => 'required',
            'fecha' => 'required',
        ]);

        if (!$validate){
            return "error en los datos";
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

    public function import(Request $request){

        // get name of file
        if($request->has('excel')){
            $file = $request->file('excel');
            // iimport excel
            Excel::import(new LeadImport, $file);

            return response()->json(['message' => 'ok'],200);
        }

        return response()->json(['error' => 'Archivo no enviado'],400);

    }

    public function destroyMultiple(){
        if(request()->has('ids')){
            $ids = request()->ids;
            Lead::whereIn('id',explode(',',$ids))->delete();
            return response()->json(['message' => 'ok'],200);
        }
    }

    public function destroyPlanilla(){
        if(request()->has('id')){
            $id = request()->id;
            Lead::where('blanco',$id)->delete();
            return response()->json(['message' => 'ok'],200);
        }
    }
}
