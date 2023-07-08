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
            <td>{{ $v->idVenta }}</td>
            <td>{{ $v->perfil->persona->nombres." ".$v->perfil->persona->apellido_paterno." ".$v->perfil->persona->apellido_materno }}</td>
            <td>{{ $v->preciounitario }}</td>
            <td>{{ $v->fecha_creacion }}</td>
            <td></td>
            <td>
                @if ($v->estadoproducto == 1)
                    <span class="badge badge-success">Iniciado</span>
                @elseif($v->estadoproducto == 2)
                    <span class="badge badge-success">En proceso</span>
                @elseif($v->estadoproducto == 3)
                    <span class="badge badge-success">Finalizado</span>
                @elseif($v->estadoproducto == 4)
                    <span class="badge badge-success">Finalizado sin entrega</span>
                @endif
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
