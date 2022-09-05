<?php
namespace App\services;

use App\Models\City;
use Exception;
use Dotenv\Util\Str;
use App\Models\Kategori;
use App\Models\Negara;
use Faker\Provider\Uuid;

class WilayahServices{

    public function getCountry(){
        try{
            $country = Negara::with('city')->get();
            if($country){
                return $country;
            }

            return false;
        }catch(Exception $error){
            return $error->getMessage();
        }
    }
    public function getCity(){
        try{
            $country = City::with('country')->get();
            if($country){
                return $country;
            }

            return false;
        }catch(Exception $error){
            return $error->getMessage();
        }
    }

    public function getCityById($id){
        try{
            $data = Negara::with([
                'city' => function ($query) {
                    $query->select('country_id', 'name', 'bujur', 'lintang');
                }
            ])->find($id);

            if($data){
                return $data;
            }

            return false;
        }catch(Exception $error){
            return $error->getMessage();
        }
    }



    public function postCountry(array $req){
        try{
            $uuid = Uuid::uuid();
            $country = Negara::create([
                'uuid' => $uuid,
                'name' => $req['name']
            ]);
                if($country){
                    return $country;
                }
            return false;
        }catch(Exception $error){
            return $error->getMessage();
        }
    }

    public function postCity(array $req){
        try{
            $uuid = Uuid::uuid();
            $city = City::create([
                'uuid' => $uuid,
                'name' => $req['name'],
                'bujur' => $req['bujur'],
                'lintang' => $req['lintang'],
                'country_id' => $req['country_id']
            ]);
                if($city){
                    return $city;
                }
            return false;
        }catch(Exception $error){
            return $error->getMessage();
        }
    }
}
