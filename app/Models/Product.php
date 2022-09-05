<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $table = "products";
    public $incrementing = false;
    protected $primaryKey = 'uuid';

    protected $fillable = [
        'uuid',
        'name',
        'desc',
        'kategori_id'
    ];

    protected $hidden = [
        'updated_at',
        'created_at'
    ];

    public function kategori(){
        return $this->belongsTo(Kategori::class,'kategori_id');
    }
}
