<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\SubCategoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{

    public function listado(Request $request){

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
        // $productos = Producto::all();
        $productos = Producto::orderBy('idproducto', 'desc')->get();
        return view("producto.ajaxListado")->with(compact('productos'))->render();
    }

    public function guarda(Request $request){
        if($request->ajax()){
            $prodducto_id = $request->input('producto_id');
            if($prodducto_id === "0"){
                $producto = new Producto();
            }else{
                $producto = Producto::find($prodducto_id);
            }

            $producto->idSubcategoria   = $request->input('categoria_id');
            $producto->idTienda         = 1;
            $producto->nombre           = $request->input('nombre');
            $producto->descripcion      = $request->input('descripcion');
            $producto->preciounitario   = $request->input('precio_unitario');
            $producto->cantidad         = $request->input('cantidad');
            $producto->estadoproducto   = 1;
            $producto->estado           = 1;
            $producto->estado           = 1;

            $producto->moneda           = 0; //momentaneo
            $producto->promocion        = 0; //momentaneo
            $producto->descuento        = 0; //momentaneo
            $producto->calificacion     = 0; //momentaneo

            $producto->ubicacion        = "La Paz, Bolivia";

            if($request->file('archivo')){
                $archivos = $request->file('archivo');
                $nombre = url("imgProducto");
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

}
