<?php

namespace App\Http\Controllers;

use App\Models\User;
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
            'name' => ['required','min:5'],
            'username' => ['required','min:5',Rule::unique('users','username')],
            'email' => ['required','email',Rule::unique('users','email')],
            'password' => ['required','min:7','confirmed']

        ]);

         if($validator->fails()) {
             return response($validator->errors()->all(),406);
         }

         $validated = $validator->validated();

         $user = User::create($validated);

         $token = $user->createToken('vueairlinetoken')->plainTextToken;

         $response = [
             'user' => $user,
             'token' => $token
         ];

         return response($response,201);

    }


}
