<table class="table align-middle table-row-dashed fs-6 gy-5" id="tabla_categoria">
    <thead>
        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
            <th>Nª</th>
            <th>Logo</th>
            <th>Nombre de la Tienda</th>
            <th>Nit</th>
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
        <tr>
            <td>{{ $c->idTienda }}</td>
            <td>
                <img src="{{ $c->logo }}" alt="">
            </td>
            <td>{{ $c->nombre }}</td>
            <td>{{ $c->nit }}</td>
            <td>{{ $c->celular }}</td>
            <td>{{ $c->correo }}</td>
            <td>
                @php
                    $persona_id     = $c->usuario_creacion;
                    $perfil         = App\Models\Perfil::where('idPersona',$persona_id)->first();
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
                        {{--  {{ ($suscripcion->tipo_fecha == 1)? 'MENSUAL' : 'ANUAL' }} /
                        @if ($perfil->plandepago === 1)
                            BASICA
                        @elseif($perfil->plandepago === 2)
                            ESTANDAR
                        @elseif($perfil->plandepago === 3)
                            SUPERIOR
                        @endif  --}}
                    </span>
                @else
                    <span >MENSUAL / BASICA</span>
                    @php
                        $tipo = 1;
                        $plan = 1;
                    @endphp
                @endif
                {{--  @if ($perfil)
                    <select name="planPago_{{ $c->idTienda }}" id="planPago_{{ $c->idTienda }}" class="form-control" onchange="cambiaPlanPago({{ $c->idTienda }})">
                        <option {{ $perfil->plandepago === 1? 'selected' : '' }} value="1">Basica</option>
                        <option {{ $perfil->plandepago === 2? 'selected' : '' }} value="2">Estandar</option>
                        <option {{ $perfil->plandepago === 3? 'selected' : '' }} value="3">Superior</option>
                    </select>
                @endif  --}}
                {{--  {{ (($perfil->plandepago === 1)? 'BASICA' : '') }}  --}}
                {{--  <button type="button" onclick="modalCAmbiaSuscripcion()" class="btn btn-success btn-icon btn-sm w-100"><i class="fa fa-dollar"></i></button>  --}}
            </td>
            <td>
                {{-- @if ($c->estado === 1)
                    <span class="badge badge-light-success fw-dold">Activo</span>
                @else
                    <span class="badge badge-light-danger fw-dold">Inactivo</span>
                @endif --}}

                <select name="estadoTienda_" id="estadoTienda_{{$c->idTienda}}" class="form-control" onchange="cambiaEstadoTienda({{ $c->idTienda }})">
                    <option {{$c->estado === 1? 'selected' : ''}} value="1">Activo</option>
                    <option {{$c->estado === 2? 'selected' : ''}} value="2">Suspendido</option>
                </select>
                <small class="text-success" id="msg_nesaje_{{$c->idTienda}}" style="display: none">Guardado...</small>
            </td>
             <td>
                <button class="btn btn-success btn-icon btn-sm" onclick="editaSuscripcion('{{ $c->idTienda }}', '{{ $c->nombre }}','{{ $tipo }}','{{ $plan }}')"><i class="fa fa-edit"></i></button></button>
                <button class="btn btn-warning btn-icon btn-sm" onclick="edita('{{ $c->idTienda }}', '{{ $c->nombre }}', '{{ $c->nit }}', '{{ $c->celular }}', '{{ $c->correo }}', '{{ $c->descripcion }}', '{{ $c->estado }}')"><i class="fa fa-edit"></i></button></button>
                <button class="btn btn-danger btn-icon btn-sm" onclick="elimina('{{ $c->idTienda }}')"><i class="fa fa-trash"></i></button></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    $('#tabla_categoria').DataTable({
        {{--  responsive: true,
        language: {
            url: '{{ asset('datatableEs.json') }}',
        },
        order: [[ 0, "desc" ]]  --}}
    });
</script>
