<?php
namespace App\services;

use Exception;
use Dotenv\Util\Str;
use App\Models\Kategori;
use Faker\Provider\Uuid;

class KategoriServices{

    public function getKategori(){
        try{
            $kategiriProduct = Kategori::all();
            if($kategiriProduct){
                return $kategiriProduct;
            }

            return false;
        }catch(Exception $error){
            return $error->getMessage();
        }
    }

    public function postKategori(array $req){
        try{
            $uuid = Uuid::uuid();
            $kategori = Kategori::create([
                'uuid' => $uuid,
                'name' => $req['name'],
                'biaya' => $req['biaya']
            ]);
                if($kategori){
                    return $kategori;
                }
            return false;
        }catch(Exception $error){
            return $error->getMessage();
        }
    }
}
