<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    //
    public function create(){

        return 'Hello World';
    }

    public function store(){

         $validator = Validator::make(request()->all() ,[
            'name' => ['required'],
            'username' => ['required',Rule::unique('users','username')],
            'email' => ['required','email',Rule::unique('users','email')],
            'password' => ['required','min:7']

        ]);

         if($validator->fails()) {
             return json_encode($validator->errors()->all());
         }

         $validated = $validator->validated();

         return User::create($validated);

    }
}
