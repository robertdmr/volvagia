<?php

use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(
    [
        'middleware' => ['auth'],
    ],
    function () {
        // HOME
        Route::get('/home', [HomeController::class, 'index'])->name('home');

        // USUARIOS
        Route::get('/users', [UserController::class, 'index'])->name('users.index');

        // PROYECTOS
        Route::get('/projects', [ProjectsController::class, 'index'])->name('projects.index');

        // Utiles
        Route::get('/utils', [HomeController::class, 'utils'])->name('utils');


    }
);
