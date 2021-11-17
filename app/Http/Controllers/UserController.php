<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    //
    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'username' => ['required'],
            'password' => ['required']
        ]);

        if($validator->fails()){
            return json_encode($validator->errors()->all());
        }

        $validated = $validator->validated();

        if(Auth::attempt($validated))
        {
             $user = User::query();
              return $user->where('username','=',request(['username']))->first();

        }

        return json_encode(['error' => 'wrong credentials']);


    }
}
