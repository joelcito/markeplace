<table class="table align-middle table-row-dashed fs-6 gy-5" id="tabla_categoria">
    <thead>
        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
            <th>Codigo</th>
            <th>Logo</th>
            <th>Nombre</th>
            <th>Nit</th>
            <th>Celular</th>
            <th>Correo</th>
            <th>Descripcion</th>
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
                {{-- {{ $c->logo }} --}}
            </td>
            <td>{{ $c->nombre }}</td>
            <td>{{ $c->nit }}</td>
            <td>{{ $c->celular }}</td>
            <td>{{ $c->correo }}</td>
            <td>{{ $c->descripcion }}</td>
            <td>
                @if ($c->estado === 1)
                    <span class="badge badge-light-success fw-dold">Activo</span>
                @else
                    <span class="badge badge-light-danger fw-dold">Inactivo</span>
                @endif
            </td>
             <td>
                <button class="btn btn-warning btn-icon btn-sm" onclick="edita('{{ $c->idTienda }}', '{{ $c->nombre }}', '{{ $c->nit }}', '{{ $c->celular }}', '{{ $c->correo }}', '{{ $c->descripcion }}', '{{ $c->estado }}')"><i class="fa fa-edit"></i></button></button>
                {{-- <button class="btn btn-danger btn-icon btn-sm" onclick="elimina('{{ $c->idSubcategoria }}', '{{ $c->nombre }}')"><i class="fa fa-trash"></i></button></button> --}}
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
