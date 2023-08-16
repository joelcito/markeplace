<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Persona;
use App\Models\Informacion;
use App\Models\Venta;
use App\Models\Tienda;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonaController extends Controller
{
    public function perfil(Request $request){
        $logeo = app(LoginController::class);
        $logeo->verificaLogueo();
        $persona_id = session('perfil')->idPersona;
        $persona = Persona::find($persona_id);
        return view('persona.perfil')->with(compact('persona'));
    }

    public function pedido(Request $request){
        // $ventas = Venta::all();
        $perfil_id = session('perfil')->idPerfil;

        // $ventas = Venta::
        $ventas = Venta::select('pedido', 'usuario_creacion',DB::raw('SUM(preciounitario*cantidad) as total_precio'),'fecha_creacion', 'estadoproducto')
                        // ->where('idPerfil', $perfil_id)
                        ->where('idPerfil', $perfil_id)
                        ->groupBy('pedido', 'usuario_creacion','fecha_creacion', 'estadoproducto')
                        ->get();
                        // ->toSql();
        // dd($ventas, $perfil_id);

        // PARA EL PDF
        // ************** PARA COMERCIO LATINO ********************
        $nombre = Informacion::where('codigo','nombre')->first();
        $datosPdf['nombreCL'] = $nombre->descripcion;
        $telefono = Informacion::where('codigo','telefono')->first();
        $datosPdf['telefonoCL'] = $telefono->descripcion;
        $correo = Informacion::where('codigo','correo')->first();
        $datosPdf['correoCL'] = $correo->descripcion;

        // ************** PARA EL CLIENTE ********************
        $persona_id = session('perfil')->idPersona;
        $persona    = Persona::find($persona_id);
        $datosPdf['nombreComprador']        = $persona->nombres." ".$persona->apellido_paterno." ".$persona->apellido_materno;
        $datosPdf['nitComprador']           = $persona->nit;
        $datosPdf['direccionComprador']     = $persona->direccion;
        $datosPdf['telefonoComprador']      = $persona->celular;
        $datosPdf['correoComprador']        = $persona->correo;

        // dd($nombre->descripcion);

        return view('persona.venta')->with(compact('ventas', 'datosPdf'));
    }

    public function guarda(Request $request){

        $persona_id = $request->input('persona_id');

        $persona = Persona::find($persona_id);

        $persona->nombres           = $request->input('nombres');
        $persona->apellido_paterno  = $request->input('ap_paterno');
        $persona->apellido_materno  = $request->input('ap_materno');
        $persona->ci                = $request->input('cedula');
        $persona->nit               = $request->input('nit');
        $persona->razon_social      = $request->input('razon_social');
        $persona->celular           = $request->input('celular');
        $persona->correo            = $request->input('correo');
        $persona->direccion         = $request->input('direccion');
        $persona->fecha_nacimiento  = $request->input('fecha_nacimiento');

        if($request->hasFile('foto')){
            $archivo = $request->file('foto');
            $nombreOriginal = $archivo->getClientOriginalName();
            $extension = $archivo->getClientOriginalExtension();
            // Generar un nombre de archivo único
            $nombreArchivo = uniqid() . '_' . time() . '.' . $extension;
            $archivo->move(public_path('compradorPerfil'), $nombreArchivo);
            $persona->foto = $nombreArchivo;
        }
        $persona->save();
        $perfil                 = Perfil::find($persona->idPersona);
        $perfil->usuario        = $request->input('correo');
        if($request->filled('password'))
            $perfil->contrasena     = $request->input('password');

        $perfil->save();

        return redirect("persona/perfil");
    }

    public function califica(Request $request){
        if($request->ajax()){
            $pedido         = $request->input('pedido');
            $calificacion   = (int) $request->input('valor')/100;
            $ventas         = Venta::where('pedido', $pedido)->get();
            
            foreach ($ventas as $key => $v) {
                $producto                   = Producto::find($v->idProducto);
                $calAnt                     = $producto->calificacion;
                $producto->calificacion     = ($calAnt+$calificacion)/2;
                $producto->save();
                $tineda_id                  = $producto->idTienda;
            }

            $tienda                 = Tienda::find($tineda_id);
            $calAntTineda           = $tienda->calificacion;
            $tienda->calificacion   = ($calAntTineda+$calificacion)/2;
            $tienda->save();

            Venta::where('pedido', $pedido)
                 ->update(['estadoproducto' => 5]);
            
            $data['estado'] = 'success' ;
        }else{
            $data['estado'] = 'error' ;
        }
        return $data;
    }
}
