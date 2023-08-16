<table class="table align-middle table-row-dashed fs-6 gy-5" id="tabla_categoria">
    <thead>
        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
            <th>Nro Pedido</th>
            <th>Cliente</th>
            <th>Importe</th>
            <th>Fecha de Solicitud</th>
            <th>Form Pedido</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ventas as $v)
            <tr>
                <td>
                    {{ $v->pedido }}
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
                    {{ $nombreComprador }}
                </td>
                <td>
                    {{ number_format($v->total, 2) }}
                </td>
                <td>
                    {{ $venta->fecha_creacion }}
                </td>
                <td>
                    <a class="btn btn-danger btn-icon btn-sm" target="_blank" href="https://comercio-latino.com/services_landing/pdfrecibo.php?pedido={{ $v->pedido }}
                        &nombre={{ $datosPdf['nombreCL'] }}
                        &telefono={{ $datosPdf['telefonoCL'] }}
                        &email={{ $datosPdf['correoCL'] }}
                        &pronombre={{ $tienda->nombre }}
                        &pronit={{ $tienda->nit }}
                        &prodireccion={{ $tienda->ubicacion }}
                        &protelefono={{ $tienda->celular }}
                        &procorreo={{ $tienda->correo }}
                        &clinombre={{ $nombreComprador }}
                        &clinit={{ $nitComprador }}
                        &clidireccion={{ $direccionComprador }}
                        &clitelefono={{ $telefonoComprador }}
                        &clicorreo={{ $correoComprador }}
                        &logoimagen=17-07-20-Elementor-Page-Builder-construye-tu-web-de-forma-fa%CC%81cil-y-eficaz-1-1200x630.jpg
                        &fecha={{ $venta->fecha_creacion }}">
                    <i class="fa fa-file-pdf"></i></a>
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
        {{-- @foreach ($ventas as $v)
        <tr>
            <td>{{ $v->pedido }}</td>
            <td>
                @php
                    $perfil = App\Models\Perfil::find($v->idPerfil);
                    $persona = App\Models\Persona::find($perfil->idPersona);
                @endphp
                {{ $persona->nombres." ".$persona->apellido_paterno." ".$persona->apellido_materno }}
            </td>
            <td>{{ $v->preciounitario }}</td>
            <td>{{ $v->fecha_creacion }}</td>
            <td></td>
            <td>
                <select name="estado_pedido_{{ $v->idVenta }}" id="estado_pedido_{{ $v->idVenta }}" class="form-control" onchange="cambiaEstado(this, '{{ $v->idVenta }}')">
                    <option value="1" {{ ($v->estadoproducto == 1)? 'selected' : '' }} >Iniciado</option>
                    <option value="2" {{ ($v->estadoproducto == 2)? 'selected' : '' }} >En proceso</option>
                    <option value="3" {{ ($v->estadoproducto == 3)? 'selected' : '' }} >Finalizado</option>
                    <option value="4" {{ ($v->estadoproducto == 4)? 'selected' : '' }} >Finalizado sin entrega</option>
                </select>
                <small class="text-success" style="display: none" id="msg_{{ $v->idVenta }}">Guardado...</small>
            </td>
        </tr>
        @endforeach --}}
    </tbody>
</table>

<script>
    $('#tabla_categoria').DataTable({
        // responsive: true,
        // language: {
        //     url: '{{ asset('datatableEs.json') }}',
        // },
        // order: [[ 0, "desc" ]]
    });
</script>
