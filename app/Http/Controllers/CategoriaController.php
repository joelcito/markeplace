<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\SubCategoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    public function listado(Request $request){
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        //
    }
}
