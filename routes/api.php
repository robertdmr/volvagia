<?php

use App\Http\Controllers\api\AjetreoController;
use App\Http\Controllers\api\AsesoresController;
use App\Http\Controllers\api\LeadController;
use App\Http\Controllers\api\ProjectsController;
use App\Http\Controllers\api\SituacionController;
use App\Http\Controllers\api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// USUARIOS
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{user}', [UserController::class, 'update']);
Route::delete('/users/{user}', [UserController::class, 'destroy']);

// lEADS
Route::post('/leads', [LeadController::class, 'store']);
Route::put('/leads/{lead}', [LeadController::class, 'update']);
Route::get('/leads/{lead}', [LeadController::class, 'show']);
Route::delete('/leads/{lead}', [LeadController::class, 'destroy']);
Route::post('/lead/{lead}', [LeadController::class, 'updateColumn']);

// PROYECTOS

Route::post('/projects', [ProjectsController::class, 'store']);
Route::put('/projects/{project}', [ProjectsController::class, 'update']);
Route::get('/projects', [ProjectsController::class, 'index']);
Route::delete('/projects/{project}', [ProjectsController::class, 'destroy']);

// Utiles
// situacion
Route::get('/situacion', [SituacionController::class, 'index']);
Route::post('/situacion', [SituacionController::class, 'store']);
Route::put('/situacion', [SituacionController::class, 'update']);
Route::delete('/situacion', [SituacionController::class, 'destroy']);

// Ajetreo
Route::get('/ajetreo', [AjetreoController::class, 'index']);
Route::post('/ajetreo', [AjetreoController::class, 'store']);
Route::put('/ajetreo', [AjetreoController::class, 'update']);
Route::delete('/ajetreo', [AjetreoController::class, 'destroy']);

// Asesores
Route::get('/asesores', [AsesoresController::class, 'index']);
Route::post('/asesores', [AsesoresController::class, 'store']);
Route::put('/asesores', [AsesoresController::class, 'update']);
Route::delete('/asesores', [AsesoresController::class, 'destroy']);
