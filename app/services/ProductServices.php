<?php namespace App\services;

use App\Models\Product;
use Exception;
use Faker\Provider\Uuid;

class ProductServices {

    public function postProduct(array $req){
        try{
            $uuid = Uuid::uuid();
            $product = Product::create([
                'uuid' => $uuid,
                'name' => $req['name'],
                'desc' => $req['desc'],
                'kategori_id' => $req['kategori_id']
            ]);

            if($product){
                return $product;
            }
            return false;
        }catch(Exception $error){
            return $error->getMessage();
        }
    }

    public function getProduct(){
        try{
            $product = Product::with('kategori')->get();
            if($product){
                return $product;
            }
            return false;
        }catch(Exception $error){
            return $error->getMessage();
        }
    }
}
