@extends('layouts.app')
@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('metadatos')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')

    <!--end::Modal - New Card-->
    <!--begin::Modal - Add task-->
    <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_user_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold">Formulario de usuario</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">

                    <form id="formularioRol">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Nombre</label>
                                    <input type="text" id="nombre" name="nombre" class="form-control form-control-solid mb-3 mb-lg-0">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Ap Paterno</label>
                                    <input type="text" id="descripcion" name="descripcion" class="form-control form-control-solid mb-3 mb-lg-0" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Ap Materno</label>
                                    <input type="text" id="descripcion" name="descripcion" class="form-control form-control-solid mb-3 mb-lg-0" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Cedula</label>
                                    <input type="text" id="nombre" name="nombre" class="form-control form-control-solid mb-3 mb-lg-0">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Cedula</label>
                                    <input type="text" id="descripcion" name="descripcion" class="form-control form-control-solid mb-3 mb-lg-0" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Imagne</label>
                                    <input type="file" id="descripcion" name="descripcion" class="form-control form-control-solid mb-3 mb-lg-0" >
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-success w-100">Guardar</button>
                        </div>
                    </div>
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Add task-->


    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6 bg-light-primary">
            <div class="card-title">
                <h2>Listado de Pedidos</h2>
            </div>
            <div class="card-toolbar">

            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4 table-responsive">
            <table class="table align-middle table-hover" id="tabla_pedidos">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th>Nro Pedido</th>
                        <th>Razon Social del Vendedor</th>
                        <th>Precio</th>
                        <th>Doc Pedido</th>
                        <th>Fecha de Pedido</th>
                        <th>Estado</th>
                        <th>Calificacion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $ventas as $v)
                        <tr style="border-top: 1px solid rgb(78, 77, 77);">
                            <td>{{ $v->pedido }}</td>
                            <td>
                                @php
                                    $venta      = App\Models\Venta::where('pedido', $v->pedido)->first();
                                    $producto   = App\Models\Producto::find($venta->idProducto);
                                    $tienda     = App\Models\Tienda::find($producto->idTienda);
                                    echo $tienda->nombre;
                                    // dd($tienda);
                                @endphp
                            </td>
                            <td>{{ number_format($v->total_precio, 2) }}</td>
                            <td>
                                <a class="btn btn-danger btn-icon btn-sm" target="_blank" href="https://comercio-latino.com/services_landing_esp/pdfrecibo.php?pedido={{ $v->pedido }}
                                                                                                    &nombre={{ urlencode($datosPdf['nombreCL']) }}
                                                                                                    &telefono={{ urlencode($datosPdf['telefonoCL']) }}
                                                                                                    &email={{ urlencode($datosPdf['correoCL']) }}
                                                                                                    &pronombre={{ urlencode($tienda->nombre) }}
                                                                                                    &pronit={{ urlencode($tienda->nit) }}
                                                                                                    &prodireccion={{ urlencode($tienda->ubicacion) }}
                                                                                                    &protelefono={{ urlencode($tienda->celular) }}
                                                                                                    &procorreo={{ urlencode($tienda->correo) }}
                                                                                                    &clinombre={{ urlencode($datosPdf['nombreComprador']) }}
                                                                                                    &clinit={{ urlencode($datosPdf['nitComprador']) }}
                                                                                                    &clidireccion={{ urlencode($datosPdf['direccionComprador']) }}
                                                                                                    &clitelefono={{ urlencode($datosPdf['telefonoComprador']) }}
                                                                                                    &clicorreo={{ urlencode($datosPdf['correoComprador']) }}
                                                                                                    &logoimagen={{ urlencode($tienda->logo) }}
                                                                                                    &fecha={{ urlencode($venta->fecha_creacion) }}">
                                                                                                <i class="fa fa-file-pdf"></i></a>
                            </td>
                            <td>{{ $v->fecha_creacion }}</td>
                            <td>
                                @if ($v->estadoproducto === 1)
                                    <small class="badge badge-info">Iniciado</small>
                                @elseif($v->estadoproducto === 2)
                                    <small class="badge badge-primary">En Proceso</small>
                                @elseif($v->estadoproducto === 3)
                                    <small class="badge badge-success">Finalizado</small>
                                @elseif($v->estadoproducto === 4)
                                    <small class="badge badge-danger">Finalizado sin entregar</small>
                                @elseif($v->estadoproducto === 5)
                                    <small class="badge badge-success">Calificado</small>
                                @endif
                            </td>
                            <td>
                                @if ($v->estadoproducto === 3)
                                    <div class="row">
                                        <div class="col-md-8">
                                            <input type="range" id="descuento_{{$v->pedido}}" min="0" max="100" value="0">
                                            <div id="valorActual_{{$v->pedido}}">Valor: <span>0</span>%</div>
                                        </div>
                                        <div class="col-md-4">
                                            <button class="btn btn-icon btn-sm btn-success mt-1" onclick="calificarPedido({{$v->pedido}})"><i class="fa fa-save"></i></button>
                                        </div>
                                    </div>
                                @elseif($v->estadoproducto === 5)
                                    <center>
                                        <small class="badge badge-success">Calificado</small>
                                    </center>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop()

@section('js')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script type="text/javascript">

        $.ajaxSetup({
            // definimos cabecera donde estarra el token y poder hacer nuestras operaciones de put,post...
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })



        $(document).ready(function() {
            $('input[type="range"]').each(function() {
                var $this = $(this);
                var id = $this.attr('id');
                var d = id.split("_");
                // var $valorActual = $('#valorActual_' + id.slice(-1) + ' span');
                var $valorActual = $('#valorActual_' + d[1] + ' span');

                $this.on('input', function() {
                    var valor = $this.val();
                    $valorActual.text(valor);
                });
            });

            $('#tabla_pedidos').DataTable({
                responsive:true
            });
        });

        function calificarPedido(pedido){
            Swal.fire({
            title: 'Esta seguro de realizar la calificacion?',
            text: "No podra revertir eso!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Estoy seguro!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{ url('persona/califica') }}",
                        data:{
                            pedido:pedido,
                            valor :$('#descuento_'+pedido).val()
                        },
                        type: 'POST',
                        dataType: 'json',
                        success: function(data) {
                            if(data.estado === 'success'){
                                Swal.fire({
                                    title:'Exito!',
                                    text :'Se califico con exito',
                                    icon: 'success',
                                    timer: 3000
                                })
                                location.reload();
                            }
                        }
                    });

                    // Swal.fire(
                    // 'Deleted!',
                    // 'Your file has been deleted.',
                    // 'success'
                    // )
                }
            })
        }

        function calificaionOmn(pedido){
            console.log(pedido)
        }

       function guardarVenta(){
            if($("#formularioRol")[0].checkValidity()){
                datos = $("#formularioRol").serializeArray()
                $.ajax({
                    url: "{{ url('rol/guarda') }}",
                    data:datos,
                    type: 'POST',
                    dataType: 'json',
                    success: function(data) {
                        if(data.estado === 'success')
                            $('#table_roles').html(data.listado);
                    }
                });
            }else{
    			$("#formularioRol")[0].reportValidity()
            }
        }

        function ajaxListado(){
            $.ajax({
                url: "{{ url('rol/ajaxListado') }}",
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    if(data.estado === 'success')
                        $('#table_roles').html(data.listado);
                }
            });
        }

        function eliminar(rol){
            $.ajax({
                url: "{{ url('rol/eliminar') }}",
                type: 'POST',
                data:{id:rol},
                dataType: 'json',
                success: function(data) {
                    if(data.estado === 'success')
                        $('#table_roles').html(data.listado);
                }
            });
        }
    </script>
@endsection


