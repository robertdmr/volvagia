<?php

use App\Http\Controllers\api\LeadController;
use App\Http\Controllers\api\ProjectsController;
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
