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
            {{-- <td>
                <button class="btn btn-warning btn-icon btn-sm" onclick="edita('{{ $c->idSubcategoria }}', '{{ $c->nombre }}', '{{ $c->descripcion }}', '{{ $c->idCategoria }}')"><i class="fa fa-edit"></i></button></button>
                <button class="btn btn-danger btn-icon btn-sm" onclick="elimina('{{ $c->idSubcategoria }}', '{{ $c->nombre }}')"><i class="fa fa-trash"></i></button></button>
            </td> --}}
        </tr>
        @endforeach
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
