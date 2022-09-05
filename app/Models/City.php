<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model{
    public $incrementing = false;
    protected $table = 'city';
    protected $primaryKey = 'uuid';
    protected $fillable = ['name','uuid','bujur','lintang','country_id'];

    protected $hidden = [
        'updated_at',
        'created_at',
        'country_id'
    ];
    public function country(){

        return $this->belongsTo(Negara::class,'country_id');
    }
}
