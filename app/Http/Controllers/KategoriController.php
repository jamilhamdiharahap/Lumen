<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Negara;
use App\services\KategoriServices;
use Faker\Provider\Uuid;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Request as HttpRequest;
use Laravel\Lumen\Http\Request as LumenHttpRequest;
use Mockery\Generator\Parameter;
use PhpParser\Builder\Param;
use PHPUnit\Framework\MockObject\Rule\Parameters;
use Symfony\Contracts\Service\Attribute\Required;

use function PHPUnit\Framework\isNull;

class KategoriController extends Controller
{
    public KategoriServices $service;

    public function __construct()
    {
        $this->service = new KategoriServices();
    }

    public function getKategori()
    {

        $data = $this->service->getKategori();
        if ($data) {
            return response(
                [
                    'message' => 'success get category',
                    'data' => $data,
                ],
                404
            );
        }
        return response(['message' => 'data is null'], 400);
    }

    public function postKategori(HttpRequest $req)
    {
        $validated = $this->validate($req,[
            'name' => 'required|max:255|unique:kategoris,name',
        ]);

        if(!$validated){
            return response(['message' => 'request tidak valid'], 400);
        }

        $kategori = $this->service->postKategori($req->all());
        if ($kategori) {
            return response([
                'message' => 'successfully category create',
                'data' => $kategori
            ], 201);
        }
        return response(['message' => 'created fail'], 400);
    }




    public function testing(HttpRequest $req)
    {
        $uuid = Uuid::uuid();
        $kategori = City::create([
            'uuid' => $uuid,
            'name' => $req->name,
            'bujur' => $req->bujur,
            'lintang' => $req->lintang,
            'country_id' => $req->country_id
        ]);
        return response($kategori, 201);
    }


    public function getTesting($id)
    {
        $data = Negara::with([
            'city' => function ($query) {
                $query->select('country_id', 'name', 'bujur', 'lintang');
            }
        ])->find($id);

        return response(['message' => 'success', 'data' => $data], 200);
    }
}
