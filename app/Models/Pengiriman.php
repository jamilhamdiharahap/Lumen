<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model{
    public $incrementing = false;
    protected $table = 'pengirimans';
    protected $primaryKey = 'uuid';
    protected $fillable = ['uuid','nama_pengirim','nama_penerima','kg','shipping_costs','desc','user','product','city'];

    protected $hidden = [
        'updated_at',
        'created_at'
    ];

    public function user(){

        return $this->belongsTo(User::class,'user');
    }

    public function product(){

        return $this->belongsTo(Product::class,'product');
    }
    public function city(){

        return $this->belongsTo(City::class,'city');
    }

}
