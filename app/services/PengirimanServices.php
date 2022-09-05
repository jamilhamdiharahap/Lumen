<?php

namespace App\services;

use Exception;
use App\Models\City;
use App\Models\Kategori;
use Firebase\JWT\JWT;
use App\Models\Product;
use Faker\Provider\Uuid;
use App\Models\Pengiriman;
use Firebase\JWT\Key;

class PengirimanServices
{

    public function getPengiriman()
    {
        try {
            $pengiriman = Pengiriman::all();
            if ($pengiriman) {
                return $pengiriman;
            }
            return false;
        } catch (Exception $error) {
            return $error->getMessage();
        }
    }


    public function postPengiriman(array $req, string $token)
    {
        try {
            $credentials = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
            $Product = Product::find($req['product']);
            $biaya = Kategori::find($Product->kategori_id);
            $id = Uuid::uuid();
            $pengiriman = Pengiriman::create([
                'uuid' => $id,
                'nama_pengirim' => $req['nama_pengirim'],
                'nama_penerima' => $req['nama_penerima'],
                'desc' => $req['desc'],
                'kg' => $req['kg'],
                'shipping_costs' => ($biaya->biaya * $req['kg']) + ($req['kg'] * 35000),
                'user' => $credentials->data->id,
                'product' => $req['product'],
                'city' => $req['city']
            ]);
            if ($pengiriman) {
                return $pengiriman;
            }
            return false;
        } catch (Exception $error) {
            return $error->getMessage();
        }
    }


    public function detailPengiriman($param)
    {
        try {
            $pengiriman = Pengiriman::with('user')->where('uuid', $param->uuid)->get();
            $product = Product::with('kategori')->where('uuid', $param->product)->get();
            $country = City::with('country')->where('uuid', $param->city)->get();

            $data = [
                'pengiriman' => $pengiriman,
                'product' => $product,
                'country' => $country
            ];

            if ($data) {
                return $data;
            }
            return false;
        } catch (Exception $error) {
            return $error->getMessage();
        }
    }
}
