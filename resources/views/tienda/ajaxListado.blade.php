<table class="table align-middle table-row-dashed fs-6 gy-5" id="tabla_categoria">
    <thead>
        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
            <th>Nª</th>
            <th width="80px">Logo</th>
            <th>Nombre de la Tienda</th>
            {{--  <th>Nit</th>  --}}
            <th>Telefono/Celular</th>
            <th>Correo</th>
            <th>Fecha de suscripcion Inicio</th>
            <th>Fecha de suscripcion Fin</th>
            <th>Tipo de suscripcion</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categorias as $c)
        @php
            $persona_id     = $c->usuario_creacion;
            $perfil         = App\Models\Perfil::where('idPersona',$persona_id)->first();
        @endphp
        @if($perfil)
            <tr>
                <td>{{ $c->idTienda }}</td>
                <td>
                    <img src="{{ asset('imgLogoTienda/'.$c->logo) }}" alt="" width="100%">
                </td>
                <td>{{ $c->nombre }}</td>
                {{--  <td>{{ $c->nit }}</td>  --}}
                <td>{{ $c->celular }}</td>
                <td>{{ $c->correo }}</td>
                <td>
                    @php
                        $suscripcion    = App\Models\Suscripcion::where('idPerfil', $perfil->idPerfil)->latest('fecha_creacion')->first();
                    @endphp
                    @if ($suscripcion)
                        <span>{{ $suscripcion->fecha_inicio }}</span>
                    @endif

                </td>
                <td>
                    @if ($suscripcion)
                        <span>{{ $suscripcion->fecha_final }}</span>
                    @endif
                </td>
                <td>
                    @if ($suscripcion)
                        <span >
                            @php
                                echo ($suscripcion->tipo_fecha == 1)? 'MENSUAL' : 'ANUAL';
                                $tipo = ($suscripcion->tipo_fecha == 1)? 1 : 2;
                                if($perfil->plandepago === 1){
                                    echo " / BASICA";
                                    $plan = 1;
                                }elseif($perfil->plandepago === 2){
                                    echo " / ESTANDAR";
                                    $plan = 2;
                                }elseif($perfil->plandepago === 3){
                                    echo " / SUPERIOR";
                                    $plan = 3;
                                }
                            @endphp
                        </span>
                    @else
                        <span >MENSUAL / BASICA</span>
                        @php
                            $tipo = 1;
                            $plan = 1;
                        @endphp
                    @endif
                </td>
                <td>
                    <select name="estadoTienda_" id="estadoTienda_{{$c->idTienda}}" class="form-control" onchange="cambiaEstadoTienda({{ $c->idTienda }})">
                        <option {{$c->estado === 1? 'selected' : ''}} value="1">Activo</option>
                        <option {{$c->estado === 2? 'selected' : ''}} value="2">Suspendido</option>
                    </select>
                    <small class="text-success" id="msg_nesaje_{{$c->idTienda}}" style="display: none">Guardado...</small>
                </td>
                <td>
                    <button class="btn btn-success btn-icon btn-sm" onclick="editaSuscripcion('{{ $c->idTienda }}', '{{ $c->nombre }}','{{ $tipo }}','{{ $plan }}')"><i class="fa fa-dollar"></i></button></button>
                    <button class="btn btn-warning btn-icon btn-sm" onclick="edita('{{ $c->idTienda }}', '{{ $c->nombre }}', '{{ $c->nit }}', '{{ $c->celular }}', '{{ $c->correo }}', '{{ $c->descripcion }}', '{{ $c->estado }}')"><i class="fa fa-edit"></i></button></button>
                    <button class="btn btn-danger btn-icon btn-sm" onclick="elimina('{{ $c->idTienda }}')"><i class="fa fa-trash"></i></button></button>
                </td>
            </tr>
        @endif
        @endforeach
    </tbody>
</table>

<script>
    $('#tabla_categoria').DataTable({
        responsive: true
    });
</script>
