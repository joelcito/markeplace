<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request){
        return view('login.login');
    }

    public function ingresa(Request $request){
        // dd($request->all());
        $usuario = $request->input('usuario');
        $password = $request->input('password');

        $ext = Perfil::where('usuario', $usuario)->first();
        if($ext){
            if($ext->contrasena === $password){
                $request->session()->put('perfil', $ext);
                $request->session()->put('rol', $ext->rol);
                if($ext->rol === 1){
                    return redirect('/');
                }else if($ext->rol === 2){
                    return redirect('persona/pedido');
                }else if($ext->rol === 3){
                    return redirect('vendedor/inicio');
                }
            }else{

            }
        }else{
            dd("nada");
        }
    }
}
