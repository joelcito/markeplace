<table class="table align-middle table-hover" id="tabla_categoria">
    <thead>
        <tr class="text-uppercase text-center">
            <th class="text-center">Nro Pedido</th>
            <th class="text-center">Cliente</th>
            <th class="text-center">Importe</th>
            <th class="text-center">Fecha de Solicitud</th>
            <th class="text-center">Form Pedido</th>
            <th class="text-center" style="width: 200px">Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ventas as $v)
            <tr style="border-top: 1px solid rgb(78, 77, 77); height: 50px;">
                <td>
                    <center>
                        {{ $v->pedido }}
                    </center>
                </td>
                <td>
                    @php
                        $venta      = App\Models\Venta::where('pedido', $v->pedido)->first();
                        $producto   = App\Models\Producto::find($venta->idProducto);
                        $tienda     = App\Models\Tienda::find($producto->idTienda);
                        $perfil     = App\Models\Perfil::find($venta->idPerfil);
                        $persona    = App\Models\Persona::find($perfil->idPersona);

                        // PARA EL COMPRADOR
                        $nombreComprador        = $persona->nombres." ".$persona->apellido_paterno." ".$persona->apellido_materno;
                        $nitComprador           = $persona->nit;
                        $direccionComprador     = $persona->direccion;
                        $telefonoComprador      = $persona->celular;
                        $correoComprador        = $persona->correo;
                    @endphp
                    <center>
                        {{ $nombreComprador }}
                    </center>
                </td>
                <td>
                    <center>
                        {{ number_format($v->total, 2) }}
                    </center>
                </td>
                <td>
                    <center>
                        {{ $venta->fecha_creacion }}
                    </center>
                </td>
                <td>
                    <center>
                        <a class="btn btn-success btn-icon btn-sm" target="_blank" href="https://comercio-latino.com/services_landing_esp/pdfrecibo.php?pedido={{ $v->pedido }}
                            &nombre={{ urlencode($datosPdf['nombreCL']) }}
                            &telefono={{ urlencode($datosPdf['telefonoCL']) }}
                            &email={{ urlencode($datosPdf['correoCL']) }}
                            &pronombre={{ urlencode($tienda->nombre) }}
                            &pronit={{ urlencode($tienda->nit) }}
                            &prodireccion={{ urlencode($tienda->ubicacion) }}
                            &protelefono={{ urlencode($tienda->celular) }}
                            &procorreo={{ urlencode($tienda->correo) }}
                            &clinombre={{ urlencode($nombreComprador) }}
                            &clinit={{ urlencode($nitComprador) }}
                            &clidireccion={{ urlencode($direccionComprador) }}
                            &clitelefono={{ urlencode($telefonoComprador) }}
                            &clicorreo={{ urlencode($correoComprador) }}
                            &logoimagen={{ urlencode($tienda->logo) }}
                            &fecha={{ urlencode($venta->fecha_creacion) }}">
                        <i class="fa fa-file-pdf"></i></a>
                    </center>
                </td>
                <td>
                <select name="estado_pedido_{{ $v->pedido }}" id="estado_pedido_{{ $v->pedido }}" class="form-control" onchange="cambiaEstado(this, '{{ $v->pedido }}')">
                    <option value="1" {{ ($v->estadoproducto == 1)? 'selected' : '' }} >Iniciado</option>
                    <option value="2" {{ ($v->estadoproducto == 2)? 'selected' : '' }} >En proceso</option>
                    <option value="3" {{ ($v->estadoproducto == 3)? 'selected' : '' }} >Finalizado</option>
                    <option value="4" {{ ($v->estadoproducto == 4)? 'selected' : '' }} >Finalizado sin entrega</option>
                </select>
                <small class="text-success" style="display: none" id="msg_{{ $v->pedido }}">Guardado...</small>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    $('#tabla_categoria').DataTable({
        responsive:true
    });
</script>
