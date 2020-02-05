<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    protected $table ="studio";
    protected $primarykey="id_studio";
    protected $fillable =[
        'id_studio',
        'nama_studio',
    ];
    public $timestamps =false;
}
