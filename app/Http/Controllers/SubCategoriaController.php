<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\SubCategoria;
use Illuminate\Http\Request;

class SubCategoriaController extends Controller
{
    public function listado(Request $request){

        $logeo = app(LoginController::class);
        $logeo->verificaLogueo();

        $categorias = Categoria::all();

        return view('subcategoria.listado')->with(compact('categorias'));
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
        $categorias = SubCategoria::all();
        return view("subcategoria.ajaxListado")->with(compact('categorias'))->render();
    }

    public function guarda(Request $request){
        if($request->ajax()){
            $categoria_id = $request->input('subcategoria_id');
            if($categoria_id === "0"){
                $categoria = new SubCategoria();
            }
            else{
                $categoria = SubCategoria::where('idSubcategoria',$categoria_id)->first();
            }
            $categoria->nombre      = $request->input('nombre');
            $categoria->descripcion = $request->input('descripcion');
            $categoria->idCategoria = $request->input('idCategoria');
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
            SubCategoria::destroy($categoria);
            $data['estado'] = 'success';
        }else{
            $data['estado'] = 'error';
        }

        return $data;
    }

}
