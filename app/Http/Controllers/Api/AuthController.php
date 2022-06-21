<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
Use Illuminate\Support\Str;
class AuthController extends BaseController
{

    public function signin(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $authUser = Auth::user();
            $success['token'] =  $authUser->createToken('MyAuthApp')->plainTextToken;
            $success['name'] =  $authUser->name;

            return $this->sendResponse($success, 'User signed in');
        }
        else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendError('Error validation', $validator->errors());
        }
        $uid = hexdec(uniqid());
        $matriculaFull = $uid;

        $matricula=Str::limit($matriculaFull,30);
        $matriculaNova=substr_replace($matricula, '', 0,-10);
        $matriculaFinal=substr_replace($matriculaNova,'',6);
        $nome_arquivo="default.jpg";

        $user = User::create(
             [  'tipo'   =>'paciente',
                'matricula' => $matriculaFinal,
                'foto' =>$nome_arquivo,
                'email'    => $request->email,
                'name' => $request->name,
                'password' =>Hash::make($request->password)
                ]
            );
        $success['token'] =  $user->createToken('MyAuthApp')->plainTextToken;
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'User created successfully.');
    }
    public function destroy(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return   $this->sendResponse(true, 'User  signed out');
    }

}
