<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                $test=array(
                    'logged'=>false,
                    'token'=>'',
                    'message'=> 'Login Gagal',
                );
                return response()->json($test);
                
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        
        if($token){
            $test=array(
                'logged'=>true,
                'token'=>$token,
                'message'=> 'Login berhasil'
            );
        }
        else{
            $test=array(
                'logged'=>false,
                'token'=>'',
                'message'=> 'Login Gagal'
            );
        }

        return response()->json($test);
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_petugas' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'level' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'nama_petugas' => $request->get('nama_petugas'),
            'username' => $request->get('username'),
            'password' => Hash::make($request->get('password')),
            'level' => $request->get('level'),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),201);
    }

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }
        $auth=true;
        return response()->json(compact('auth','user'));
    
    }

    public function update($id, Request $request)
    {
        $validator=Validator::make($request->all(),
        [
            'nama_petugas' => 'required',
            'username' => 'required',
            'password' => 'required',
            'level' => 'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $user=User::where('id_petugas',$id)->update([
            'nama_petugas' => $request->nama_petugas,
            'username'=> $request->username,
            'password'=> $request->password,
            'level'=> $request->level,
        ]);
        if($user){
            return Response()->json(['status'=>1,'message'=>'Data Petugas berhasil diubah']);
        }
        else{
            return Response()->json(['status'=>0,'message'=>'Data Petugas tidak berhasil diubah']);
        }
    }

    public function delete($id)
    {
        $user=User::where('id_petugas',$id)->delete();
        if($user){
            return Response()->json(['status'=>1,'message'=>'Data Petugas berhasil dihapus']);
        }
        else{
            return Response()->json(['status'=>0,'message'=>'Data Petugas tidak berhasil dihapus']);
        }
    }
    public function tampil()
    {
        $user=User::all();
        if($user){
            return Response()->json(['Data'=>$user,'status'=>1]);
        }
        else{
            return Response()->json(['status'=>0]);
        }
    }
}
