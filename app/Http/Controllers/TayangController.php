<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Film_tayang;

class TayangController extends Controller
{
    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), 
        [
            'id_film' => 'required',
            'id_studio'=> 'required',
            'waktu_tayang'=> 'required',
        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $Film_tayang = Film_tayang::create([
            'id_film' => $req->id_film,
            'id_studio'=> $req->id_studio,
            'waktu_tayang'=> $req->waktu_tayang,
        ]);
        if($Film_tayang){
            return Response()->json(['status'=>1,'message'=>'JADWAL TAYANG BERHASIL DITAMBAH']);
        }
        else{
            return Response()->json(['status'=>0,'message'=>'JADWAL TAYANG GAGAL DITAMBAH']);
        }
    }

    public function update($id, Request $req)
    {
        $validator=Validator::make($req->all(),
        [
            'id_film' => 'required',
            'id_studio' => 'required',
            'waktu_tayang'=> 'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $Film_tayang=Film_tayang::where('id_tayang',$id)->update([
            'id_film' => $req->id_film,
            'id_studio' => $req->id_studio,
            'waktu_tayang'=> $req->waktu_tayang,
        ]);
        if($Film_tayang){
            return Response()->json(['status'=>1,'message'=>'JADWAL TAYANG BERHASIL DIUBAH']);
        }
        else{
            return Response()->json(['status'=>0,'message'=>'JADWAL TAYANG GAGAL DIUBAH']);
        }
    }

    public function delete($id)
    {
        $Film_tayang=Film_tayang::where('id_tayang',$id)->delete();
        if($Film_tayang){
            return Response()->json(['status'=>1,'message'=>'JADWAL TAYANG BERHASIL DIHAPUS']);
        }
        else{
            return Response()->json(['status'=>0,'message'=>'JADWAL TAYANG GAGAL DIHAPUS']);
        }
    }
    public function tampil($id)
    {
        $film_tayang = Film_tayang::join('film','film.id_film','film_tayang.id_film')->join('studio','studio.id_studio','film_tayang.id_studio')->where('waktu_tayang',$id)->get();
        $arr_data=array();
        foreach ($film_tayang as $film_tayang){
            $arr_data[]=array(
                'nama_film'=> $film_tayang->nama_film,
                'genre'=> $film_tayang->genre,
                'deskripsi'=> $film_tayang->deskripsi,
                'waktu_tayang'=> $film_tayang->waktu_tayang,
                'nama_studio'=> $film_tayang->nama_studio,
            );
        }
        return Response()->json([$arr_data]);
    }
}
