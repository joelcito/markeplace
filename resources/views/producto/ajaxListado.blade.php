<style>
    .limited-text {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2; /* Cambia este valor para establecer el número de líneas visibles */
        overflow: hidden;
        line-height: 1.5; /* Ajusta este valor según tus necesidades */
    }
</style>
{{--  <table class="table align-middle table-row-dashed fs-6 gy-5" id="tabla_producto">  --}}
<table class="table table-hover align-middle table-row-dashed fs-6 gy-5" id="tabla_producto">
    <thead>
        {{--  <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">  --}}
        <tr class="text-white bg-primary text-uppercase text-center">
            <th class="text-center">Codigo</th>
            <th class="text-center" width="80px">Imagen</th>
            <th class="text-center">Sub Categoria</th>
            <th class="text-center">Titulo</th>
            <th class="text-center">Descripcion</th>
            <th class="text-center">Precio Unitario</th>
            <th class="text-center">Stock</th>
            <th class="text-center">Estado</th>
            <th class="text-center">Calificacion</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($productos as $p)
        <tr style="border-top: 1px solid rgb(78, 77, 77)">
            <td>{{ $p->idProducto }}</td>
            <td>
                @php
                    $p->imagenes;
                    $imgs = explode(",", $p->imagenes);
                @endphp
                @if (count($imgs)>0)
                    <img src="https://comercio-latino.com/{{ $imgs[0] }}" alt="" width="100%">
                @endif
            </td>
            <td>
                @php
                    $subcategoria = App\Models\SubCategoria::find($p->idSubcategoria);
                    echo $subcategoria->nombre;

                    // $descuento = $p->preciounitario * $p->descuento;
                    $descuento = 100 * $p->descuento;
                @endphp
            </td>
            <td>{{ $p->nombre }}</td>
            <td class="limited-cell limited-text">
                {{ $p->descripcion }}
            </td>
            <td>{{ $p->preciounitario }}</td>
            <td>{{ $p->cantidad }}</td>
            <td>
                <div id="contEstadoProd_{{ $p->idProducto }}">
                    @if ($p->estadoproducto === 1)
                        <span class="badge badge-light-success fw-dold" onclick="cambiaEstado(0,'{{ $p->idProducto }}')">Activo</span>
                    @else
                        <span class="badge badge-light-danger fw-dold" onclick="cambiaEstado(1,'{{ $p->idProducto }}')">Inactivo</span>
                    @endif
                </div>
            </td>
            <td>{{ $p->calificacion }}</td>
            <td>
                <button class="btn btn-warning btn-icon btn-sm" onclick="edita('{{ $p->idProducto }}','{{ $subcategoria->idCategoria }}', '{{ $p->idSubcategoria }}','{{ $p->nombre }}','{{ json_encode($p->descripcion) }}','{{ $p->preciounitario }}','{{ $p->cantidad }}','{{ $p->estado }}','{{ $p->calificacion }}','{{ $p->ubicacion }}', '{{ $descuento }}')"><i class="fa fa-edit"></i></button></button>

                <button class="btn btn-danger btn-icon btn-sm" onclick="eliminar('{{ $p->idProducto }}')"><i class="fa fa-trash"></i></button></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
    $('#tabla_producto').DataTable({
        "order": [[ 0, "desc" ]]
    });
</script>
