<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Tienda;
use App\Models\Producto;
use App\Models\SubCategoria;
use App\Models\Suscripcion;
use Illuminate\Http\Request;

class ProductoController extends Controller
{

    public function listado(Request $request){

        $logeo = app(LoginController::class);
        $logeo->verificaLogueo();

        // $categorias = Categoria::all();
        $subcategorias = SubCategoria::all();
        $categorias = Categoria::all();

        return view('producto.listado')->with(compact('categorias', 'subcategorias'));
    }

    public function ajaxListado(Request $request){
        $data = array();
        if($request->ajax()){
            $data['estado'] = 'success';
            $data['listado'] = $this->listadoArray();
        }else{
            $data['estado'] = 'error';
        }

        return json_encode($data);
    }

    protected function listadoArray(){

        $perfil = session('perfil');
        $tienda  = Tienda::where('usuario_creacion', $perfil->idPersona)->first();

        $productos = Producto::where('idTienda', $tienda->idTienda)
                            ->where('estado',1)
                            ->orderBy('idproducto', 'desc')
                            ->get();
        return view("producto.ajaxListado")->with(compact('productos'))->render();
    }

    public function guarda(Request $request){
        if($request->ajax()){

            $perfil = session('perfil');
            $persona_id = $perfil->idPersona;
            $perfil_id  = $perfil->idPerfil;

            $suscripcion    = Suscripcion::where('idPerfil', $perfil_id)
                                            ->latest('fecha_creacion')
                                            ->first();

            $cantidadPublicados = $this->cantidadProductosSegunPlan($persona_id);

            if($suscripcion){
                if($suscripcion->plan == 1 && $cantidadPublicados >= 5){
                   $data['estado']  = 'error';
                   $data['msg']     = 'ERROR DE SUSCRIPCION';
                   return $data;
                }
            }else if($cantidadPublicados >= 5){
                $data['estado']  = 'error';
                $data['msg']     = 'ERROR DE SUSCRIPCION';
                return $data;
            }


            $prodducto_id = $request->input('producto_id');
            if($prodducto_id === "0"){
                $producto = new Producto();
            }else{
                $producto = Producto::find($prodducto_id);
            }

            $tienda  = Tienda::where('usuario_creacion', $perfil->idPersona)->first();

            $producto->idSubcategoria   = $request->input('categoria_id');
            $producto->idTienda         = $tienda->idTienda;
            $producto->nombre           = $request->input('nombre');
            $producto->descripcion      = $request->input('descripcion');
            $producto->preciounitario   = $request->input('precio_unitario');
            $producto->cantidad         = $request->input('cantidad');
            $producto->estadoproducto   = 1;
            $producto->estado           = 1;
            $producto->usuario_creacion = $perfil->idPersona;
            $producto->moneda           = $request->input('moneda');
            // $producto->descuento        = ((100*$request->input('descuento'))/$request->input('precio_unitario'))/100;
            $producto->descuento        = $request->input('descuento')/100;
            $producto->calificacion     = 0; //momentaneo
            $producto->ubicacion        = "La Paz, Bolivia";

            if($request->file('archivo')){
                $archivos = $request->file('archivo');
                // $nombre = url("imgProducto");
                $nombre = "sistema/public/imgProducto";
                $todo = "";
                foreach ($archivos as $key => $arch) {
                    $archivo                            = $arch;
                    $direccion                          = 'imgProducto/';
                    $nombreArchivo                      = ($key+1).date('YmdHis').".".$archivo->getClientOriginalExtension();
                    $archivo->move($direccion,$nombreArchivo);
                    $pre = $nombre."/".$nombreArchivo;
                    $todo = $todo.$pre;
                    if($key < (count($archivos)-1))
                        $todo = $todo.",";

                }
                $producto->imagenes = $todo;
            }

            if($request->file('file')){
                $archivos                   = $request->file('file');
                $archivo                    = $archivos;
                $direccion                  = 'imgProducto/';
                $nombreArchivo              = "a_".date('YmdHis').".".$archivo->getClientOriginalExtension();
                $archivo->move($direccion,$nombreArchivo);
                $producto->archivos         = $nombreArchivo;
            }

            $producto->save();
            $data['estado'] = 'success';
        }else{
            $data['estado'] = 'error';
        }
        return $data;
    }

    public function cambiaEstado(Request $request){
        if($request->ajax()){
            $valor = $request->input('valor');
            $producto_id = $request->input('producto');

            $producto = Producto::find($producto_id);
            $producto->estadoproducto = $valor;
            $producto->save();

            $data['estado'] = 'success';
        }else{
            $data['estado'] = 'error';
        }
        return $data;
    }

    public function eliminar(Request $request){
        if($request->ajax()){
            $producto = Producto::find($request->input('id'));
            $producto->estado = 0;
            $producto->save();
            $data['estado'] = 'success';
        }else{
            $data['estado'] = 'error';
        }

        return $data;
    }

    public function verificaPlan(Request $request){
        if($request->ajax()){
            $perfil_id      = session('perfil')->idPerfil;
            $persona_id     = session('perfil')->idPersona;
            $suscripcion    = Suscripcion::where('idPerfil', $perfil_id)->latest('fecha_creacion')->first();

            $cantidaProducto = $this->cantidadProductosSegunPlan($persona_id);

            if($suscripcion){
                if($suscripcion->plan === 2){
                    $data['plan'] = "Estandar [".$cantidaProducto." / ∞]";
                    $data['planChe'] = 'Estandar';
                }elseif($suscripcion->plan === 3){
                    $data['plan'] = "Superior [".$cantidaProducto." / ∞]";
                    $data['planChe'] = 'Superior';
                }else{
                    $data['plan'] = "Basico [".$cantidaProducto." / 5]";
                    $data['planChe'] = 'Basico';
                }
            }else{
                $data['plan'] = "Basico [".$cantidaProducto." / 5]";
                $data['planChe'] = 'Basico';
            }
            $data['cantidad'] = $cantidaProducto;
            $data['estado'] = 'success';
        }else{
            $data['estado'] = 'error';
        }

        return $data;
    }

    protected function cantidadProductosSegunPlan($persona_id){
        $tienda         = Tienda::where('usuario_creacion', $persona_id)
                            ->where('estado',1)
                            ->first();

         return $cantidaProducto = Producto::where('idTienda', $tienda->idTienda)
                                            ->where('estado',1)
                                            ->count();
    }

}
