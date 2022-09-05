<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Negara extends Model{
    public $incrementing = false;
    protected $table = 'countries';
    protected $primaryKey = 'uuid';
    protected $fillable = ['name','uuid'];

    protected $hidden = [
        'updated_at',
        'created_at'
    ];

    public function city(){

        return $this->hasMany(City::class,'country_id');
    }

}
