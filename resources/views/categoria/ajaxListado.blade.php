<table class="table align-middle table-row-dashed fs-6 gy-5" id="tabla_categoria">
    <thead>
        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
            <th>Codigo</th>
            <th>Categoria</th>
            <th>Descripcion</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categorias as $c)
        <tr>
            <td>{{ $c->idCategoria }}</td>
            <td>{{ $c->nombre }}</td>
            <td>{{ $c->descripcion }}</td>
            <td>
                @if ($c->estado === 1)
                    <span class="badge badge-light-success fw-dold">Activo</span>
                @else
                    <span class="badge badge-light-danger fw-dold"></span>Inactivo</span>
                @endif
            </td>
            <td>
                <button class="btn btn-warning btn-icon btn-sm" onclick="edita('{{ $c->idCategoria }}', '{{ $c->nombre }}', '{{ $c->descripcion }}')"><i class="fa fa-edit"></i></button></button>
                <button class="btn btn-danger btn-icon btn-sm" onclick="elimina('{{ $c->idCategoria }}', '{{ $c->nombre }}')"><i class="fa fa-trash"></i></button></button>
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
