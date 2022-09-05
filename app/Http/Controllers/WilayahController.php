<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\services\WilayahServices;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public WilayahServices $service;

    public function __construct()
    {
        $this->service = new WilayahServices();
    }

    public function getCountry()
    {

        $data = $this->service->getCountry();
        if ($data) {
            return response(
                [
                    'message' => 'success get country',
                    'data' => $data
                ], 404);
        }
        return response(['message' => 'data is null'], 400);
    }

    public function postCountry(Request $req)
    {
        $validated = $this->validate($req,[
            'name' => 'required|unique:countries,name',
        ]);

        if(!$validated){
            return response(['message' => 'request tidak valid'], 400);
        }
        $result = $this->service->postCountry($req->all());
        if ($result) {
            return response($result, 201);
        }
        return response(['message' => 'created fail'], 400);
    }


    public function getCityById($id)
    {
        $result = $this->service->getCityById($id);
        if($result){
            return response(['message' => 'success', 'data' => $result], 200);
        }

        return response(['message' => 'data is null'], 400);
    }
    public function getCity()
    {
        $result = $this->service->getCity();
        if($result){
            return response(['message' => 'success', 'data' => $result], 200);
        }

        return response(['message' => 'data is null'], 400);
    }

    public function postCity(Request $req)
    {
        $validated = $this->validate($req,[
            'name' => 'required|unique:city,name',
        ]);

        if(!$validated){
            return response(['message' => 'request tidak valid'], 400);
        }
        $result = $this->service->postCity($req->all());
        if ($result) {
            return response($result, 201);
        }
        return response(['message' => 'created fail'], 400);
    }

}

