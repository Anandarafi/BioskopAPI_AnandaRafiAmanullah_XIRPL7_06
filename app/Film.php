<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $table ="film";
    protected $primarykey="id_film";
    protected $fillable =[
        'id_film',
        'nama_film',
        'genre',
        'deskripsi',
    ];
    public $timestamps =false;
}
