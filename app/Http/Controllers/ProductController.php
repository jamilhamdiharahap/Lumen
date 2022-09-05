<?php

namespace App\Http\Controllers;

use App\services\ProductServices;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public ProductServices $service;

    public function __construct()
    {
        $this->service = new ProductServices();
    }

    public function postProduct(Request $req)
    {
        $validated = $this->validate($req,[
            'name' => 'required|max:255',
            'desc' => 'required|max:255',
        ]);

        if(!$validated){
            return response(['message' => 'request tidak valid'], 400);
        }

        $product = $this->service->postProduct($req->all());
        if ($product) {
            return response($product, 201);
        }
        return response(['message' => 'created fail'], 400);
    }

    public function getProduct()
    {
        $products = $this->service->getProduct();
        if ($products) {
            return response([
                'message' => 'success get product',
                'data' => $products
            ], 200);
        }
        return response(['message' => 'created fail'], 400);
    }
}
