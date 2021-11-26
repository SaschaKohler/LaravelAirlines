<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function show($username)
    {
        return response(User::query()->where('username', '=', $username)->first(),201);
    }


    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'username' => ['required'],
            'password' => ['required']
        ]);

        if ($validator->fails()) {
            return response($validator->errors()->all(),404);
        }

        $validated = $validator->validated();

        if (Auth::attempt($validated)) {
            $user = User::where('username', '=', request(['username']))->first();
            $token = $user->createToken('vueairlinetoken')->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token
            ];
            return response($response,201);
        }

        return response(['error' => 'wrong credentials'],401);


    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $validator = Validator::make(request()->all(), [
            'name' => ['sometimes','min:5'],
            'username' => ['sometimes','min:5',Rule::unique('users')->ignore($user->id)],
            'email' => [ 'sometimes','email', Rule::unique('users')->ignore($user->id)]
        ]);

        if ($validator->fails()) {
            return response($validator->errors()->all(),406);
        }

        $validated = $validator->validated();

        $user->update($validated);
        return response($user,'201');
    }
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return response(['msg' => 'loggged out, tokens deleted'],201);



    }

}
