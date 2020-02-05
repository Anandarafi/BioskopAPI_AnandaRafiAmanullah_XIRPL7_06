<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\FIlm;

class FilmController extends Controller
{
    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), 
        [
            'nama_film' => 'required',
            'genre'=> 'required',
            'deskripsi'=> 'required',
        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $Film = Film::create([
            'nama_film' => $req->nama_film,
            'genre'=> $req->genre,
            'deskripsi'=> $req->deskripsi,
        ]);
        if($Film){
            return Response()->json(['status'=>1,'message'=>'FILM BERHASIL DITAMBAH']);
        }
        else{
            return Response()->json(['status'=>0,'message'=>'FILM GAGAL DITAMBAH']);
        }
    }

    public function update($id, Request $req)
    {
        $validator=Validator::make($req->all(),
        [
            'nama_film' => 'required',
            'genre' => 'required',
            'deskripsi'=> 'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $Film=Film::where('id_film',$id)->update([
            'nama_film' => $req->nama_film,
            'genre' => $req->genre,
            'deskripsi'=> $req->deskripsi,
        ]);
        if($Film){
            return Response()->json(['status'=>1,'message'=>'FILM BERHASIL DIUBAH']);
        }
        else{
            return Response()->json(['status'=>0,'message'=>'FILM GAGAL DIUBAH']);
        }
    }

    public function delete($id)
    {
        $Film=Film::where('id_film',$id)->delete();
        if($Film){
            return Response()->json(['status'=>1,'message'=>'FILM BERHASIL DIHAPUS']);
        }
        else{
            return Response()->json(['status'=>0,'message'=>'FILM GAGAL DIHAPUS']);
        }
    }
    public function tampil()
    {
        $Film=Film::all();
        if($Film){
            return Response()->json(['Data'=>$Film,'status'=>1]);
        }
        else{
            return Response()->json(['status'=>0]);
        }
    }
}
