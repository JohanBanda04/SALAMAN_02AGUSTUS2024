<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function proseslogin(Request $request){
        //dd($request->nik." - ".$request->password);
        $pass = Hash::make($request->password);
        //dd($pass);

        if(Auth::guard('karyawan')->attempt(['nik'=>$request->nik,'password'=>$request->password])){
            return redirect('/dashboard');
        } else {
            return redirect('/')->with(['warning'=>'Nik / Password Salah!']);
        }
    }

    public function prosesloginsalaman(Request $request){
        //dd($request);




        //dd($request);
        $pass = Hash::make($request->password);
        if(Auth::guard('salaman')->attempt(['kode_user'=>$request->kode_user,'password'=>$request->password,'roles'=>$request->role_user])){
            //echo "berhasil login";
            return redirect()->route('dashboardsalaman');
        } else {
            //echo "gagal login";
            return redirect()->route('loginsalaman')->with(['warning'=>'Kode User / Password Tidak Ditemukan']);
        }

    }

    public function proseslogout(){
        if(Auth::guard('karyawan')->check()){
            Auth::guard('karyawan')->logout();
            return redirect('/');
        }


    }

    public function proseslogoutadmin(){
        if(Auth::guard('user')->check()){
            Auth::guard('user')->logout();
            return redirect('/panel');
        }

    }


    public function prosesloginadmin(Request $request){
        $pass = Hash::make($request->password);
        //dd($pass);
        //dd($request->email." - ".$request->password);
        if(Auth::guard('user')->attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect('/panel/dashboardadmin');
        } else {
            return redirect('/panel')->with(['warning'=>'Username atau Password Salah!']);
        }
    }

    public function proseslogoutsalaman(){
        if(Auth::guard('salaman')->check()){
            Auth::guard('salaman')->logout();
            return redirect()->route('loginsalaman');
        }

    }
}
