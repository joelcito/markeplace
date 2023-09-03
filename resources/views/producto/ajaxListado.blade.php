<table class="table table-hover align-middle" id="tabla_producto">
    <thead>
        {{--  <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">  --}}
        <tr class="text-uppercase text-center">
            <th class="text-center">Numero</th>
            <th class="text-center" width="80px">Imagen</th>
            <th class="text-center">Sub Categoria</th>
            <th class="text-center">Titulo</th>
            <th class="text-center">Descripcion</th>
            <th class="text-center">Precio Unitario</th>
            <th class="text-center">Stock</th>
            <th class="text-center">Estado</th>
            <th class="text-center">Calificacion</th>
            <th style="width: 100px"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($productos as $key => $p)
        <tr style="border-top: 1px solid rgb(78, 77, 77);">
            <td>{{ $key+1 }}</td>
            <td>
                <center>
                    @php
                        $p->imagenes;
                        $imgs = explode(",", $p->imagenes);
                    @endphp
                    @if (count($imgs)>0)
                        @php
                            $dato = explode(".", $imgs[0]);
                            $sw = ($dato[1] == "mp4")? true : false;
                        @endphp
                        @if ($sw)
                            <video src="{{ asset('imgProducto/'.$imgs[0]) }}" width="60%" autoplay loop muted></video>
                        @else
                            <img src="{{ asset('imgProducto/'.$imgs[0]) }}" alt="" width="60%">
                        @endif
                    @endif
                </center>
            </td>
            <td>
                @php
                    $subcategoria = App\Models\SubCategoria::find($p->idSubcategoria);
                    echo $subcategoria->nombre;
                    $descuento = 100 * $p->descuento;
                @endphp
            </td>
            <td>
                <div style="height: 50px; overflow: hidden;">
                    {{ $p->nombre }}
                </div>
            </td>
            <td>
                <div style="height: 50px; overflow: hidden;">
                    {{ $p->descripcion }}
                </div>
            </td>
            <td>
                {{ number_format($p->preciounitario, 2) }}
            </td>
            <td>
                @php
                    $venta = App\Models\Venta::select('idProducto', \DB::raw('sum(cantidad) as vendido'))
                                    ->where('idProducto', $p->idProducto)
                                    ->groupBy('idProducto')
                                    ->first();
                    if($venta){
                        echo $p->cantidad - $venta->vendido;
                    }else{
                        echo $p->cantidad;
                    }
                @endphp
                {{-- {{ $p->cantidad }} --}}
            </td>
            <td>
                <div id="contEstadoProd_{{ $p->idProducto }}">
                    @if ($p->estadoproducto === 1)
                        <span class="badge badge-light-success fw-dold" onclick="cambiaEstado(0,'{{ $p->idProducto }}')">Activo</span>
                    @else
                        <span class="badge badge-light-danger fw-dold" onclick="cambiaEstado(1,'{{ $p->idProducto }}')">Inactivo</span>
                    @endif
                </div>
            </td>
            <td>{{ number_format($p->calificacion, 2) }}</td>
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
        responsive:true
    });
</script>
