<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Studio;

class StudioController extends Controller
{
    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), 
        [
            'nama_studio'=> 'required',
        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $studio = Studio::create([
            'nama_studio'=> $req->nama_studio,
        ]);
        if($studio){
            return Response()->json(['status'=>1,'message'=>'STUDIO BERHASIL DITAMBAH']);
        }
        else{
            return Response()->json(['status'=>0,'message'=>'STUDIO GAGAL DITAMBAH']);
        }
    }

    public function update($id, Request $req)
    {
        $validator=Validator::make($req->all(),
        [
            'nama_studio' => 'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $studio=Studio::where('id_studio',$id)->update([
            'nama_studio' => $req->nama_studio,
        ]);
        if($studio){
            return Response()->json(['status'=>1,'message'=>'STUDIO BERHASIL DIUBAH']);
        }
        else{
            return Response()->json(['status'=>0,'message'=>'STUDIO GAGAL DIUBAH']);
        }
    }

    public function delete($id)
    {
        $studio=Studio::where('id_studio',$id)->delete();
        if($studio){
            return Response()->json(['status'=>1,'message'=>'STUDIO BERHASIL DIHAPUS']);
        }
        else{
            return Response()->json(['status'=>0,'message'=>'STUDIO GAGAL DIHAPUS']);
        }
    }
    public function tampil()
    {
        $studio=Studio::all();
        if($studio){
            return Response()->json(['Data'=>$studio,'status'=>1]);
        }
        else{
            return Response()->json(['status'=>0]);
        }
    }
}
