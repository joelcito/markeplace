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
    <div class="modal fade" id="modaTienda" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_user_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold">FORMULARIO DE TIENDA</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
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

                    <form id="formularioTeinda">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Nombre</label>
                                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                                    <input type="hidden" id="tienda_id" name="tienda_id">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Nit</label>
                                    <input type="text" id="nit" name="nit" class="form-control" required >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Celular</label>
                                    <input type="text" id="celular" name="celular" class="form-control" required >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Correo</label>
                                    <input type="text" id="correo" name="correo" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Descripcion</label>
                                    <input type="text" id="descripcion" name="descripcion" class="form-control" required >
                                </div>
                            </div>
                            {{--  <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Estdo</label>
                                    <select name="estado" id="estado" class="form-control" required>
                                        <option value="1">Activo</option>
                                        <option value="0">Inactivo</option>
                                    </select>
                                </div>
                            </div>  --}}
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-success w-100" onclick="guardar()">Guardar</button>
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

    <!--end::Modal - New Card-->
    <!--begin::Modal - Add task-->
    <div class="modal fade" id="modaCambioSsucripcion" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_user_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold">CAMBIO DE SUSCRIPCION A LA TIENDA <span class="text-primary" id="nombreTenda"></span></h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-15">
                    <form id="formularioTeinda">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Tipo</label>
                                    <select name="suscripcion_tipo" id="suscripcion_tipo" class="form-control">
                                        <option value="1">Mensual</option>
                                        <option value="2">Anual</option>
                                    </select>
                                    <input type="hidden" id="tienda_id_suscripcion" name="tienda_id">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Plan</label>
                                    <select name="suscripcion_plan" id="suscripcion_plan" class="form-control">
                                        <option value="1">Basica</option>
                                        <option value="2">Estandar</option>
                                        <option value="3">Superior</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-success w-100" onclick="guardarSuscricion()">Guardar</button>
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
            <!--begin::Card title-->
            <div class="card-title">
                <h2>Listado de Tiendas</h2>
            </div>
            <div class="card-toolbar">
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4 table-responsive">
            <div id="table_tiendas">

            </div>
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
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

        $( document ).ready(function() {
            ajaxListado();
        });

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
                            $('#table_tiendas').html(data.listado);
                    }
                });
            }else{
    			$("#formularioRol")[0].reportValidity()
            }
        }

        function ajaxListado(){
            $.ajax({
                url: "{{ url('tienda/ajaxListado') }}",
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    if(data.estado === 'success')
                        $('#table_tiendas').html(data.listado);
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
                        $('#table_tiendas').html(data.listado);
                }
            });
        }

        function edita(idTienda , nombre , nit , celular , correo , descripcion,estado){
            $('#nombre').val(nombre)
            $('#tienda_id').val(idTienda)
            $('#nit').val(nit)
            $('#celular').val(celular)
            $('#correo').val(correo)
            $('#descripcion').val(descripcion)
            $('#estado').val(estado)
            $('#modaTienda').modal('show')
        }

        function guardar(){
            if($("#formularioTeinda")[0].checkValidity()){
                datos = $("#formularioTeinda").serializeArray()
                $.ajax({
                    url: "{{ url('tienda/guardaAdmin') }}",
                    data:datos,
                    type: 'POST',
                    dataType: 'json',
                    success: function(data) {
                        if(data.estado === 'success'){
                            ajaxListado();
                            $('#modaTienda').modal('hide')
                            Swal.fire({
                                title: 'Editado',
                                text: 'Se guardo con exito!',
                                icon: 'success',
                                timer: 1500
                            })
                        }
                    }
                });
            }else{
    			$("#formularioTeinda")[0].reportValidity()
            }
        }

        function cambiaEstadoTienda(tienda){
            $.ajax({
                url: "{{ url('tienda/cambiaEstadoTienda') }}",
                data:{
                    id:tienda,
                    estado:$('#estadoTienda_'+tienda).val()
                },
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    if(data.estado === 'success'){
                        $('#msg_nesaje_'+tienda).show('toggle')
                    }
                }
            });
        }

        function elimina(tienda){
            $.ajax({
                url: "{{ url('tienda/elimina') }}",
                data:{
                    id:tienda
                },
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    if(data.estado === 'success'){
                        ajaxListado();
                    }
                }
            });
        }

        function cambiaPlanPago(tienda){
            $.ajax({
                url: "{{ url('tienda/cambiaSuscripcion') }}",
                data:{
                    id:tienda,
                    valor : $('#planPago_'+tienda).val()
                },
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    if(data.estado === 'success'){
                        ajaxListado();
                    }
                }
            });
        }

        function editaSuscripcion(tienda, nombre, tipo, plan){
            $('#nombreTenda').text(nombre)
            $('#tienda_id_suscripcion').val(tienda)
            $('#suscripcion_tipo').val(tipo)
            $('#suscripcion_plan').val(plan)

            $('#modaCambioSsucripcion').modal('show')

        }

        function guardarSuscricion(){
            Swal.fire({
                title: 'Esta seguro de cambiar de plan y suscripcion?',
                text: "No podra revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Cmabiar!'
              }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{ url('tienda/cambiaSuscripcionAdmin') }}",
                        data:{
                            tienda  :   $('#tienda_id_suscripcion').val(),
                            tipo    :   $('#suscripcion_tipo').val(),
                            plan   :    $('#suscripcion_plan').val()
                        },
                        type: 'POST',
                        dataType: 'json',
                        success: function(data) {
                            if(data.estado === 'success'){
                                ajaxListado();
                            }
                        }
                    });

                  {{--  Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                  )  --}}
                }
              })
        }
    </script>
@endsection


