<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Firebase\JWT\JWT;
use App\services\UserServices;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public UserServices $service;

    public function __construct()
    {
        $this->service = new UserServices();
    }

    public function register(Request $req)
    {
        $validated = $this->validate($req,[
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email',
            'password' => 'required|max:255',
            'comfirmPassword' => 'required'
        ]);

        if(!$validated){
            return response(['message' => 'request tidak valid'], 400);
        }

        $register = $this->service->register($req->all());

        if($register){
            return response([
                'message' => 'register success',
                'data' => $register
            ]);
        }
        return response(['message' => 'inputan tidak valid'], 400);
    }


    public function login(Request $req)
    {
        $validated = $this->validate($req,[
            'email' => 'required',
            'password' => 'required',
        ]);

        if(!$validated){
            return response(['message' => 'request tidak valid'], 400);
        }

        $login = $this->service->login($req->all());
        if($login){
            $user = [
                'id' => $login->uuid,
                'email' => $login->email
            ];
            $checkToken = $this->service->generateToken($user);
            return response([
                'message' => 'success login',
                'data' => $login,
                'token' => $checkToken,
            ],200);
        }
        return response(['message' => 'Login failed'], 400);
    }
}
