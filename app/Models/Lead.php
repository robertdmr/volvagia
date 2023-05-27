<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'c',
        'ajetreo',
        'as',
        'fecha',
        'referente',
        'proyecto_id',
        'nombre',
        'telefono',
        'X',
        'comentario',
        'e',
        'f',
        'mes',
        'blanco',
        'user_id'
    ];
}
