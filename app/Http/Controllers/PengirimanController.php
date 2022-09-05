<?php

namespace App\Http\Controllers;

use App\services\PengirimanServices;
use Illuminate\Http\Request;

class PengirimanController extends Controller
{

    public PengirimanServices $service;

    public function __construct()
    {
        $this->service = new PengirimanServices();
    }


    public function getPengiriman()
    {
        $data = $this->service->getPengiriman();
        if ($data) {
            return response(
                [
                    'message' => 'success get delivery',
                    'data' => $data
                ],
                200
            );
        }
        return response(['message' => 'data is null'], 400);
    }

    public function pengiriman(Request $req)
    {
        $validated = $this->validate($req,[
            'nama_penerima' => 'required|max:255',
            'nama_pengirim' => 'required|max:255',
            'desc' => 'required|max:255',
            'kg' => 'required|integer'
        ]);

        if(!$validated){
            return response(['message' => 'request tidak valid'], 400);
        }

        $pengirim = $this->service->postPengiriman($req->all(), $req->bearerToken());
        if ($pengirim) {
            $detail = $this->service->detailPengiriman($pengirim);
            return response([
                'message' => 'successful delivery',
                'data' => $detail,
            ], 201);
        }
        return response(['message' => 'created fail'], 400);
    }
}
