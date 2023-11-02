<?php

namespace App\Imports;

use App\Models\Ajetreo;
use App\Models\Asesores;
use App\Models\Lead;
use App\Models\Projects;
use App\Models\Situacion;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat\DateFormatter;

class LeadImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $ajetreos = [];
    private $asesores = [];
    private $situaciones = [];
    private $proyectos = [];
    private $uploadId = "";

    public function __construct()
    {
        $this->ajetreos = Ajetreo::all('nombre')->pluck('nombre')->toArray();
        $this->asesores = Asesores::all()->pluck('nombre')->toArray();
        $this->situaciones = Situacion::all()->pluck('nombre')->toArray();
        $this->proyectos = Projects::all()->pluck('nombre')->toArray();
        $this->uploadId = Hash::make(date('YmdHis'));

    }
    public function model(array $row)
    {
        $error = 0;
        $errorMsg = [];

        //buscar el valor en $ajetreos el valor y si no existe guardar un error
        if(!in_array($row['ajetreo'], $this->ajetreos)){
            $error = 1;
            //agregar el error al array de mensajes arrayMsg
            array_push($errorMsg, 'El ajetreo '.$row['ajetreo'].' no existe');
        }

        //buscar el valor en $asesores el valor y si no existe guardar un error
        if(!in_array($row['as'], $this->asesores)){
            $error = 1;
            //agregar el error al array de mensajes arrayMsg
            array_push($errorMsg, 'El asesor '.$row['as'].' no existe');
        }

        //buscar el valor en $situaciones el valor y si no existe guardar un error
        if(!in_array($row['c'], $this->situaciones)){
            $error = 1;
            //agregar el error al array de mensajes arrayMsg
            array_push($errorMsg, 'La situacion '.$row['c'].' no existe');
        }

        //buscar el valor en $proyectos el valor y si no existe guardar un error
        if(!in_array($row['proyecto'], $this->proyectos)){
            $error = 1;
            //agregar el error al array de mensajes arrayMsg
            array_push($errorMsg, 'El proyecto '.$row['proyecto'].' no existe');
        }else{
            $project = Projects::where('nombre', $row['proyecto'])->first();
            $row['proyecto'] = $project->id;
        }

        $user_id = request()->user()->id;
        // $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha']);
        $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha']);
        $mes = "MES";

        if($error == 0){
            return new Lead([
                'c'         => $row['c'],
                'ajetreo'   => $row['ajetreo'],
                'as'        => $row['as'],
                'fecha'     => $date,
                'referente' => $row['referente'],
                'project_id'=> $row['proyecto'],
                'nombre'    => $row['nombre'],
                'telefono'  => $row['telefono'],
                'X'         => $row['x'],
                'comentario'=> $row['comentario'],
                'e'         => $row['e'],
                'f'         => $row['f'],
                'mes'       => $mes,
                'blanco'    => $this->uploadId,
                'user_id'   => $user_id,
            ]);
        }
    }
}
