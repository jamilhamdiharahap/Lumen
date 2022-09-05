<?php

namespace App\services;

use Exception;
use App\Models\User;
use Firebase\JWT\JWT;
use Faker\Provider\Uuid;
use Illuminate\Support\Facades\Hash;

class UserServices
{

    public function register(array $req)
    {
        try {
            if ($req['name'] !== "" || $req['email'] !== "" || $req['password'] !== "") {
                if ($req['password'] !== $req['comfirmPassword']) {
                    return false;
                }
                $uuid = Uuid::uuid();
                $register = User::create([
                    'uuid' => $uuid,
                    'name' => $req['name'],
                    'email' => $req['email'],
                    'password' => Hash::make($req['password']),
                ]);
                return $register;
            }
        } catch (Exception $error) {
            return $error->getMessage();
        }
    }

    public function generateToken($user){
        $payload = [
            'data' => $user,
            'iat' => time(),
            'exp' => time() * 60 * 60
        ];
        return JWT::encode($payload, env('JWT_SECRET'),'HS256');
    }

    public function login(array $req)
    {
        try {
            $user = User::where('email', $req['email'])->first();
            if ($user) {
                $check = Hash::check($req['password'], $user->password);
                if (!$check) {
                    return false;
                }
                return $user;
            } else {
                return false;
            }
        } catch (Exception $error) {
            return $error->getMessage();
        }
    }
}
