<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\SubCategoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    public function listado(Request $request){
        $logeo = app(LoginController::class);
        $logeo->verificaLogueo();
        return view('categoria.listado');
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
        $logeo = app(LoginController::class);
        $logeo->verificaLogueo();

        $categorias = Categoria::all();
        return view("categoria.ajaxListado")->with(compact('categorias'))->render();
    }

    public function guarda(Request $request){
        if($request->ajax()){
            $categoria_id = $request->input('categoria_id');
            if($categoria_id === "0"){
                $categoria = new Categoria();
            }
            else{
                $categoria = Categoria::where('idCategoria',$categoria_id)->first();
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
            Categoria::destroy($categoria);
            $data['estado'] = 'success';
        }else{
            $data['estado'] = 'error';
        }

        return $data;
    }

    public function buscaSubCategorias(Request $request){
        if($request->ajax()){
            $categoria = $request->input('id');
            $subCategorias = SubCategoria::where('idCategoria',$categoria)->get();
            $data['subCategorias'] = $subCategorias;
            $data['estado'] = 'success';
        }else{
            $data['estado'] = 'error';
        }

        return $data;
    }

}
