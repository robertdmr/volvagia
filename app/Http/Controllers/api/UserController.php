<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|min:5|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|max:20'
        ]);

        if (!$validate){
            return "error";
        }

        $pass = Hash::make($request->password);
        $request->merge(['password' => $pass]);
        $user = User::create($request->all());

        return response()->json(['message' => 'ok', 'user' => $user]);
    }

    public function update(User $user, Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable'
        ]);

        if (!$validate){
            return $validate;
        }

        if($request->password != null){
            $pass = Hash::make($request->password);
            $request->merge(['password' => $pass]);
        }else{
            $request->request->remove('password');
        }

        $user->update($request->all());
        return response()->json(['message' => 'ok', 'user' => $user]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'ok']);
    }
}
