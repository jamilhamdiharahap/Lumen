<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model{
    public $incrementing = false;
    protected $table = 'kategoris';
    protected $primaryKey = 'uuid';
    protected $fillable = ['name','uuid','biaya'];


    protected $hidden = [
        'updated_at',
        'created_at'
    ];
}
