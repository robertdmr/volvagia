<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index(){
        if(Auth::user()->role != "admin"){
            return redirect()->route('home');
        }
        $users = User::all();
        return view('users', compact('users'));
    }


}
