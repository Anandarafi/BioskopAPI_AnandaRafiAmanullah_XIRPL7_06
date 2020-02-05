<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    protected $table ="tiket";
    protected $primarykey="id_tiket";
    protected $fillable =[
        'id_tiket',
        'id_tayang',
        'id_petugas',
        'tgl_pembelian',
        'harga',
    ];
    public $timestamps =false;
}
