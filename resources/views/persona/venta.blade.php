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
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <h3>LISTADO DE PEDIDOS</h3>
                <!--begin::Search-->
                {{-- <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Buscar Usuario" />
                </div> --}}
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                {{-- <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
                    <i class="ki-duotone ki-plus fs-2"></i>Nuevo Usuario</button>
                    <!--end::Add user-->
                </div> --}}
                <!--end::Toolbar-->
                <!--begin::Group actions-->
                <div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
                    <div class="fw-bold me-5">
                    <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected</div>
                    <button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">Delete Selected</button>
                </div>
                <!--end::Group actions-->
                <!--begin::Modal - Adjust Balance-->
                <div class="modal fade" id="kt_modal_export_users" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold">Export Users</h2>
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
                                <!--begin::Form-->
                                <form id="kt_modal_export_users_form" class="form" action="#">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-10">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mb-2">Select Roles:</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select name="role" data-control="select2" data-placeholder="Select a role" data-hide-search="true" class="form-select form-select-solid fw-bold">
                                            <option></option>
                                            <option value="Administrator">Administrator</option>
                                            <option value="Analyst">Analyst</option>
                                            <option value="Developer">Developer</option>
                                            <option value="Support">Support</option>
                                            <option value="Trial">Trial</option>
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-10">
                                        <!--begin::Label-->
                                        <label class="required fs-6 fw-semibold form-label mb-2">Select Export Format:</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select name="format" data-control="select2" data-placeholder="Select a format" data-hide-search="true" class="form-select form-select-solid fw-bold">
                                            <option></option>
                                            <option value="excel">Excel</option>
                                            <option value="pdf">PDF</option>
                                            <option value="cvs">CVS</option>
                                            <option value="zip">ZIP</option>
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="text-center">
                                        <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
                                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>
                                    <!--end::Actions-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Modal body-->
                        </div>
                        <!--end::Modal content-->
                    </div>
                    <!--end::Modal dialog-->
                </div>
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <table class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th>Nro Pedido</th>
                        <th>Cliente</th>
                        <th>Precio</th>
                        <th>Doc Pedido</th>
                        <th>Fecha de Pedido</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $ventas as $v)
                        <tr>
                            <td>{{ $v->pedido }}</td>
                            <td>
                                @php
                                    $persona = App\Models\Persona::find($v->usuario_creacion);
                                    echo $persona->nombres." ".$persona->ap_paterno." ".$persona->ap_materno;
                                @endphp
                            </td>
                            <td>{{ $v->total_precio }}</td>
                            <td>
                                <a class="btn btn-danger btn-icon btn-sm" target="_blank" href="https://comercio-latino.com/services_landing/pdfrecibo.php?pedido={{ $v->pedido }}
                                                                                                    &nombre=LFORES
                                                                                                    &telefono=77752452
                                                                                                    &email=jjjoelcito123@gmail.com
                                                                                                    &pronombre=LFORES
                                                                                                    &pronit=8401524016
                                                                                                    &prodireccion=LA%20PAZ
                                                                                                    &protelefono=77752452
                                                                                                    &procorreo=jjjoelcito123@gmail.com
                                                                                                    &clinombre=alfredjose360%20%20
                                                                                                    &clinit=
                                                                                                    &clidireccion=
                                                                                                    &clitelefono=
                                                                                                    &clicorreo=alfredjose360@gmail.com
                                                                                                    &logoimagen=17-07-20-Elementor-Page-Builder-construye-tu-web-de-forma-fa%CC%81cil-y-eficaz-1-1200x630.jpg
                                                                                                    &fecha=31/07/2023%2021:09:45">
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

        $( document ).ready(function() {
            // ajaxListado();
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


