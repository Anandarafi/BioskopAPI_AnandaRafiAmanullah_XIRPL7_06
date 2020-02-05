<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film_tayang extends Model
{
    protected $table ="film_tayang";
    protected $primarykey="id_tayang";
    protected $fillable =[
        'id_tayang',
        'id_film',
        'id_studio',
        'waktu_tayang',
    ];
    public $timestamps =false;
}
