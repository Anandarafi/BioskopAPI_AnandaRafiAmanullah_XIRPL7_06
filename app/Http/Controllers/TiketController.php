<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Tiket;

class TiketController extends Controller
{
    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), 
        [
            'id_tayang' => 'required',
            'id_petugas'=> 'required',
            'tgl_pembelian'=> 'required',
            'harga'=> 'required',
        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $tiket = Tiket::create([
            'id_tayang' => $req->id_tayang,
            'id_petugas'=> $req->id_petugas,
            'tgl_pembelian'=> $req->tgl_pembelian,
            'harga'=> $req->harga,
        ]);
        if($tiket){
            return Response()->json(['status'=>1,'message'=>'PEMBELIAN TIKET BERHASIL']);
        }
        else{
            return Response()->json(['status'=>0,'message'=>'PEMBELIAN TIKET GAGAL']);
        }
    }

    public function update($id, Request $req)
    {
        $validator=Validator::make($req->all(),
        [
            'id_tayang' => 'required',
            'id_petugas' => 'required',
            'tgl_pembelian'=> 'required',
            'harga' => 'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $tiket=Tiket::where('id_tiket',$id)->update([
            'id_tayang' => $req->id_tayang,
            'id_petugas' => $req->id_petugas,
            'tgl_pembelian'=> $req->tgl_pembelian,
            'harga'=> $req->harga,
        ]);
        if($tiket){
            return Response()->json(['status'=>1,'message'=>'TIKET BERHASIL DIUBAH']);
        }
        else{
            return Response()->json(['status'=>0,'message'=>'TIKET GAGAL DIUBAH']);
        }
    }

    public function delete($id)
    {
        $tiket=Tiket::where('id_tiket',$id)->delete();
        if($tiket){
            return Response()->json(['status'=>1,'message'=>'TIKET BERHASIL DIHAPUS']);
        }
        else{
            return Response()->json(['status'=>0,'message'=>'TIKET GAGAL DIHAPUS']);
        }
    }
    public function tampil($id,$id1)
    {
        $tiket= Tiket::join('film_tayang','film_tayang.id_tayang','tiket.id_tayang')->join('studio','studio.id_studio','film_tayang.id_studio')->join('petugas','petugas.id_petugas','tiket.id_petugas')->join('film','film.id_film','film_tayang.id_film')->where('waktu_tayang',$id)->where('studio.id_studio',$id1)->get();
        $arr_data=array();
        foreach ($tiket as $tiket){
            $arr_data[]=array(
                'id_tiket'=> $tiket->id_tiket,
                'tgl_pembelian'=> $tiket->tgl_pembelian,
                'waktu_tayang'=> $tiket->waktu_tayang,
                'nama_film'=> $tiket->nama_film,
                'genre'=> $tiket->genre,
                'deskripsi'=> $tiket->deskripsi,
                'nama_studio'=> $tiket->nama_studio,
                'nama_petugas'=> $tiket->nama_petugas,
                'harga'=> $tiket->harga,
            );
        }
        return Response()->json([$arr_data]);
    }
    }

