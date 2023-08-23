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
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_user_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold">Formulario de usuario</h2>
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

                    <form method="POST" action="{{ url('users/guarda') }}" id="formularioUsuarios">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Nombre</label>
                                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                                    <input type="hidden" id="persona_id" name="persona_id" value="0">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Ap Paterno</label>
                                    <input type="text" id="ap_paterno" name="ap_paterno" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Ap Materno</label>
                                    <input type="text" id="ap_materno" name="pa_maternmo" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Cedula</label>
                                    <input type="text" id="cedula" name="cedula" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Roles</label>
                                    <div class="d-flex align-items-center">
										<label class="form-check form-check-custom form-check-solid me-3">
											<input class="form-check-input h-20px w-20px" type="checkbox" name="roles_a[]" value="1" id="rol_administrador" />
											<span class="form-check-label fw-semibold">Administrador</span>
										</label>
										<label class="form-check form-check-custom form-check-solid me-3">
											<input class="form-check-input h-20px w-20px" type="checkbox" name="roles_a[]" value="3" id="rol_vendedor" />
											<span class="form-check-label fw-semibold">Vendedor</span>
										</label>
										<label class="form-check form-check-custom form-check-solid">
											<input class="form-check-input h-20px w-20px" type="checkbox" name="roles_a[]" value="2" id="rol_comprador" />
											<span class="form-check-label fw-semibold">Comprador</span>
										</label>
									</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label for="" class="required fw-semibold fs-6 mb-2">Usuario</label>
                                    <input type="email" class="form-control" id="usuario" name="usuario" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="" class="required fw-semibold fs-6 mb-2">Contraseña</label>
                                <input type="password" class="form-control" id="pass" name="pass">
                                <small id="text_pass" style="display: none" class="text-danger">Vuelva a introducir una nueva contraseña si desea cambiar, si no desea cambiar la contraseña deje vacio el campo</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-success w-100" type="button" onclick="guardarUsuario()">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6 bg-light-primary">
            <!--begin::Card title-->
            <div class="card-title">
                <h2>Listado de Usuarios</h2>
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user" onclick="nuevo()">
                    <i class="ki-duotone ki-plus fs-2"></i>Nuevo Usuario</button>
                    <!--end::Add user-->
                </div>
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
        <div class="card-body py-4 table-responsive">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="tabla_usuarios">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th>N</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Rol de Usuario</th>
                        <th>Correo / Usuario</th>
                        <td>Fecha de Registro</td>
                        <td>Estado</td>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($perfiles as $p)
                        @php
                            $persona = App\Models\Persona::where("idPersona",$p->idPersona)->first();
                        @endphp
                        <tr>
                            <td>{{ $p->idPerfil }}</td>
                            <td>{{ $persona->nombres }}</td>
                            <td>{{ $persona->apellido_paterno." ".$persona->apellido_materno }}</td>
                            <td>
                                @php
                                    $cadenaJson = $p->rol;
                                    $miArray = json_decode($cadenaJson);

                                    // dd($miArray, $p->rol);
                                @endphp
                                @if (in_array(1, $miArray))
                                    <span class="badge badge-success">Administrador</span>
                                @endif

                                @if (in_array(2, $miArray))
                                    <br><span class="badge badge-dark">Comprador</span>
                                @endif

                                @if (in_array(3, $miArray))
                                    <br><span class="badge badge-warning">Vendedor</span>
                                @endif

                                {{-- @if ($p->rol === 1)
                                    <span class="badge badge-success">Administrador</span>
                                @elseif($p->rol === 2)
                                    <span class="badge badge-dark">Comprador</span>
                                @elseif($p->rol === 3)
                                        <span class="badge badge-warning">Vendedor</span>
                                @endif --}}
                            </td>
                            <td>{{ $p->usuario }}</td>
                            <td>{{ $p->fecha_creacion }}</td>
                            <td>
                                <select name="estadoPerfil_{{ $p->idPerfil }}" id="estadoPerfil_{{ $p->idPerfil }}" class="form-control" onchange="cambiarEstadoPerfil({{$p->idPerfil}})">
                                    <option {{ $p->estado === 1? 'selected' : '' }} value="1">Activo</option>
                                    <option {{ $p->estado === 2? 'selected' : '' }} value="2">Suspendido</option>
                                </select>
                                <small id="msg_estado_{{ $p->idPerfil }}" style="display: none" class="text-success">Se guado con exito</small>
                            </td>
                            <td>
                                <button class="btn btn-warning btn-icon btn-sm" onclick="editar('{{ $persona->idPersona }}','{{ $p->usuario }}','{{ $persona->nombres }}', '{{ $persona->apellido_paterno }}','{{ $persona->apellido_materno }}',  '{{ $persona->ci }}', '{{ $p->rol }}')"><i class="fa fa-edit"></i></button></button>
                                <button class="btn btn-danger btn-icon btn-sm" onclick="eliminar('{{ $persona->idPersona }}')"><i class="fa fa-trash"></i></button></button>
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

            $('#tabla_usuarios').DataTable({
                responsive:true
            });

        });

        function guardarUsuario(){
            if($("#formularioUsuarios")[0].checkValidity()){
                var checkboxes = document.querySelectorAll('input[name="roles_a[]"]:checked');
                if (checkboxes.length === 0) {
                    Swal.fire({
                        title: 'Error',
                        text: 'Debe seleccionar al menos un rol!',
                        icon: 'error',
                        timer: 2500
                    })
                } else {
        			$("#formularioUsuarios")[0].submit()
                }
            }else{
    			$("#formularioUsuarios")[0].reportValidity()
            }  
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

        function nuevo(){
            $('#persona_id').val('0')
            $('#usuario').val('')
            $('#nombre').val('')
            $('#ap_paterno').val('')
            $('#ap_materno').val('')
            $('#cedula').val('')
            $('#rol').val('')
            $('#text_pass').hide('toggle')
            $('#rol_administrador, #rol_comprador, #rol_vendedor').prop('checked', false);
            $('#kt_modal_add_user').modal('show')
        }

        function editar(perfil,user ,nombre, ap, am,ci,rol){
            $('#persona_id').val(perfil)
            $('#usuario').val(user)
            $('#nombre').val(nombre)
            $('#ap_paterno').val(ap)
            $('#ap_materno').val(am)
            $('#cedula').val(ci)
            $('#rol_administrador, #rol_comprador, #rol_vendedor').prop('checked', false);
            rolesArray = JSON.parse(rol);
            rolesArray.forEach(function(valor) {
                if (valor === 1)
                    $('#rol_administrador').prop('checked', true);
                else if(valor === 2)
                    $('#rol_comprador').prop('checked', true);
                else if(valor === 3)
                    $('#rol_vendedor').prop('checked', true);
            });
            $('#text_pass').show('toggle')

            $('#kt_modal_add_user').modal('show')
        }

        function eliminar(persona){
            $.ajax({
                url: "{{ url('users/eliminar') }}",
                type: 'POST',
                data:{id:persona},
                dataType: 'json',
                success: function(data) {
                    if(data.estado === 'success')
                        window.location.reload();
                }
            });
        }

        function cambiarEstadoPerfil(perfil){
            $.ajax({
                url: "{{ url('users/cambiarEstadoPerfil') }}",
                type: 'POST',
                data:{
                    id      :   perfil,
                    estado  :   $('#estadoPerfil_'+perfil).val()
                },
                dataType: 'json',
                success: function(data) {
                    if(data.estado === 'success')
                        $('#msg_estado_'+perfil).show('toggle')

                }
            });
        }
    </script>
@endsection


