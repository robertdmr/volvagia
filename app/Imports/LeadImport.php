<?php

namespace App\Imports;

use App\Models\Ajetreo;
use App\Models\Asesores;
use App\Models\Lead;
use App\Models\Projects;
use App\Models\Situacion;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class LeadImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $situacion = Situacion::where('nombre', $row['c'])->first();
        if(!$situacion){
            $situacion = Situacion::create([
                'nombre' => $row['c']
            ]);
        }

        $ajetreo = Ajetreo::where('nombre', $row['ajetreo'])->first();
        if(!$ajetreo){
            $ajetreo = Ajetreo::create([
                'nombre' => $row['ajetreo']
            ]);
        }

        $asesor = Asesores::where('nombre', $row['as'])->first();
        if(!$asesor){
            $asesor = Asesores::create([
                'nombre' => $row['as']
            ]);
        }

        $proyecto = Projects::where('nombre', $row['proyecto'])->first();
        if(!$proyecto){
            $proyecto = Projects::create([
                'nombre' => $row['proyecto']
            ]);
        }

        return new Lead([
            'c'         => $situacion->id,
            'ajetreo'   => $ajetreo->id,
            'as'        => $asesor->id,
            'fecha'     => $row['fecha'],
            'referente' => $row['referente'],
            'project_id'=> $proyecto->id,
            'nombre'    => $row['nombre'],
            'telefono'  => $row['telefono'],
            'X'         => $row['x'],
            'comentario'=> $row['comentario'],
            'e'         => $row['e'],
            'f'         => $row['f'],
            'mes'       => $row['mes'],
            'blanco'    => $row['blanco'],
            'user_id'   => 1
        ]);
    }
}
