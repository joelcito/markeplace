<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Http;


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
                $dato = $ext->rol;
                $f = json_decode($dato, true);

                if(is_array($f))
                    $rol = $f[0];
                else
                    $rol = $f;

                $request->session()->put('rol', $rol);

                if($rol === 1){
                        // return redirect('/');
                    return redirect('informacion/perfil');
                }else if($rol === 2){
                    // return redirect('persona/pedido');
                    return redirect('persona/perfil');
                }else if($rol === 3){
                    // return redirect('vendedor/inicio');
                    return redirect('tienda/perfil');
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

                $dato = $ext->rol;
                $f = json_decode($dato, true);

                if(is_array($f))
                    $rol = $f[0];
                else
                    $rol = $f;

                $request->session()->put('rol', $rol);
                if($rol === 1){
                    // return redirect('/');
                    return redirect('informacion/perfil');
                }else if($rol === 2){
                    // return redirect('persona/pedido');
                    return redirect('persona/perfil');
                }else if($rol === 3){
                    // return redirect('vendedor/inicio');
                    return redirect('tienda/perfil');
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
            // $url = "http://markeplace.test/login";
            // header("Location: $url");
            exit;
        }
    }

    public function cambiaRol(Request $request){
        if($request->ajax()) {
            $rolNuevo = $request->input('rol'); // Aquí debes establecer el nuevo valor de $rol
            $request->session()->put('rol',(int) $rolNuevo);

            // dd(session()->all());

            $data['estado'] = 'success';
        }else{
            $data['estado'] = 'error';
        }

        return $data;
    }

    public function migraPaisDepàrtameto(Request $request){
        $response = Http::withHeaders([
            "Accept"    => "application/json",
            "api-token" => "TS8-1Mk-C64LFdFQ57vUZFQqNYiL2Mtui9YGieNc9EcugfCezaedA2It_dlLHl0I0K0",
            "user-email"=> "jjjoelcito123@gmail.com"
        ])->get('https://www.universal-tutorial.com/api/getaccesstoken');

        $this->token = $response->json('auth_token');

        $paises = Http::withHeaders([
            "Authorization" => "Bearer ".$this->token,
            "Accept" => "application/json"
        ])->get('https://www.universal-tutorial.com/api/countries/')->json();

        foreach($paises as $p){
            echo $p['country_name']."<br>";
        }
        dd($paises);
    }
}
