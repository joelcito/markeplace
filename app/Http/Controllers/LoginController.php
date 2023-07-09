<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function login(Request $request){
        return view('login.login');
    }

    public function ingresa(Request $request){
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
                return redirect('login');
            }
        }else{
            dd("nada");
        }
    }

    public function ingresaDennis(Request $request){
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
                return redirect('login');
            }
        }else{
            dd("nada");
        }
    }


    public function cerrar(Request $request){
        $request->session()->forget('perfil');
        $request->session()->forget('rol');

        return redirect("https://comercio-latino.com/");
    }


    public function verificaLogueo(){
        $perfil     = session()->has('perfil');
        $rol        = session()->has('rol');
        if (!($perfil && $rol)) {
            $url = "https://comercio-latino.com";
            header("Location: $url");
            exit;
        }
    }
}
