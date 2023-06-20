<?php

namespace App\Http\Controllers;

use App\Models\Tienda;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    public function listado(Request $request){
        return view('tienda.listado');
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
        $categorias = Tienda::all();
        return view("tienda.ajaxListado")->with(compact('categorias'))->render();
    }

    public function guarda(Request $request){
        if($request->ajax()){
            $categoria_id = $request->input('categoria_id');
            if($categoria_id === "0"){
                $categoria = new Tienda();
            }
            else{
                $categoria = Tienda::where('idCategoria',$categoria_id)->first();
            }
            $categoria->nombre      = $request->input('nombre');
            $categoria->descripcion = $request->input('descripcion');
            $categoria->estado      = 1;
            $categoria->save();
            $data['estado'] = 'success';
        }else{
            $data['estado'] = 'error';
        }

        return $data;
    }

    public function elimina(Request $request){
        if($request->ajax()){
            $categoria = $request->input('id');
            Tienda::destroy($categoria);
            $data['estado'] = 'success';
        }else{
            $data['estado'] = 'error';
        }

        return $data;
    }
}
