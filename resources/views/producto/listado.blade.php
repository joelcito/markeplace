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
                    <h2 class="fw-bold">Formulario de producto</h2>
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

                    <form id="formularioProducto">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Categoria</label>
                                    <select name="categoria_id" id="categoria_id" class="form-control form-control-solid mb-3 mb-lg-0" onchange="buscarSubCategorias(this)">
                                        <option value="">SELECCIONE</option>
                                        @foreach ($categorias as $c)
                                            <option value="{{ $c->idCategoria }}">{{ $c->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2"> Sub Categoria</label>
                                    <select name="subcategoria_id" id="subcategoria_id" class="form-control form-control-solid mb-3 mb-lg-0">
                                        @foreach ($subcategorias as $c)
                                            <option value="{{ $c->idSubcategoria }}">{{ $c->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Titulo</label>
                                    <input type="text" id="nombre" name="nombre" class="form-control form-control-solid mb-3 mb-lg-0">
                                    <input type="hidden" id="producto_id" name="producto_id" value="0">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Descripcion</label>
                                    <textarea id="descripcion" name="descripcion" cols="30" rows="3" class="form-control form-control-solid mb-3 mb-lg-0"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Prec. Uni.</label>
                                    <input type="number" id="precio_unitario" name="precio_unitario" class="form-control form-control-solid mb-3 mb-lg-0">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Descuento</label>
                                    <input type="number" id="cantidad" name="cantidad" class="form-control form-control-solid mb-3 mb-lg-0" >
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Tipo M.</label>
                                    <select name="" id="" class="form-control form-control-solid mb-3 mb-lg-0">
                                        <option value="Bs">Bs</option>
                                        <option value="$us">$us</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Cantidad Disponible</label>
                                    <input type="text" id="cantidad" name="cantidad" class="form-control form-control-solid mb-3 mb-lg-0" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Archivo PDF</label>
                                    <input type="file" id="archivo" name="archivo" class="form-control form-control-solid mb-3 mb-lg-0" multiple>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Imagenes</label>
                                    <input type="file" id="imagenes" name="imagenes" class="form-control form-control-solid mb-3 mb-lg-0" multiple accept="image/*">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="text-center">Imagenes subidas</h6>
                                <div id="vista-previa">

                                </div>
                            </div>
                        </div>

                    </form>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-success w-100" onclick="guardarProducto()">Guardar</button>
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
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Buscar Usuario" />
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
                    <i class="ki-duotone ki-plus fs-2"></i>Nuevo Producto</button>
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
        <div class="card-body py-4">
            <div id="tabla_productos">

            </div>

            {{--  <div id="table_roles">

            </div>  --}}
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

            $('#tabla_producto').DataTable({
                language: {
                    {{--  url: '{{ asset('datatableEs.json') }}'  --}}
                },

                // Opciones de exportación
                dom: 'Bfrtip', // Elementos de control a mostrar (por ejemplo, botones de exportación)
                buttons: [
                    'copy', 'excel', 'pdf', 'print' // Botones de exportación disponibles (ejemplo: copiar, excel, pdf, imprimir)
                ]
            });


            // Detectar cambios en el input de imágenes
            $('#imagenes').on('change', function(e) {
                // Obtener los archivos seleccionados
                var archivos = e.target.files;

                // Limpiar la vista previa
                $('#vista-previa').empty();

                // Recorrer los archivos
                for (var i = 0; i < archivos.length; i++) {
                var archivo = archivos[i];

                // Crear un objeto FileReader
                var lector = new FileReader();

                // Cargar la imagen
                lector.onload = function(e) {
                    // Crear un elemento <img> para mostrar la imagen
                    var imagen = $('<img>').attr('src', e.target.result)
                                           .attr('width', '30%');

                    // Agregar la imagen a la vista previa
                    $('#vista-previa').append(imagen);
                }

                // Leer el archivo como una URL de datos
                lector.readAsDataURL(archivo);
                }
            });



        });

       function guardarProducto(){
            if($("#formularioProducto")[0].checkValidity()){

                var formData = new FormData();
                var archivo = $('#imagenes')[0].files;
                for(let i=0;i<archivo.length;i++){
                    formData.append('archivo[]', archivo[i]);
                }
                formData.append('nombre',           $('#nombre').val());
                formData.append('producto_id',      $('#producto_id').val());
                formData.append('descripcion',      $('#descripcion').val());
                formData.append('categoria_id',     $('#subcategoria_id').val());
                formData.append('precio_unitario',  $('#precio_unitario').val());
                formData.append('cantidad',         $('#cantidad').val());
                $.ajax({
                    url: "{{ url('producto/guarda') }}",
                    data:formData,
                    type: 'POST',
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if(data.estado === 'success'){
                            Swal.fire({
                                title:'Registrado!',
                                text :'Se registro con exito.',
                                icon: 'success',
                                timer: 1500
                            })
                            $('#kt_modal_add_user').modal('hide');
                            ajaxListado();
                        }
                    }
                });

            }else{
    			$("#formularioProducto")[0].reportValidity()
            }
        }

        function ajaxListado(){
            $.ajax({
                url: "{{ url('producto/ajaxListado') }}",
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    if(data.estado === 'success')
                        $('#tabla_productos').html(data.listado);
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

        function edita(idProducto,idSubcategoria,nombre,descripcion,preciounitario,cantidad,estado,calificacion, ubicacion){
            $('#nombre').val(nombre)
            $('#producto_id').val(idProducto)
            $('#descripcion').val(descripcion.replaceAll('"',''))
            $('#categoria_id').val(idSubcategoria)
            $('#precio_unitario').val(preciounitario)
            $('#cantidad').val(cantidad)
            $('#kt_modal_add_user').modal('show')
        }

        function buscarSubCategorias(select){
            let idCategoria = select.value
            $.ajax({
                url: "{{ url('categoria/buscaSubCategorias') }}",
                type: 'POST',
                data:{id:idCategoria},
                dataType: 'json',
                success: function(data) {
                    if(data.estado === 'success'){
                        $('#subcategoria_id').empty();
                        let subCategorias = data.subCategorias
                        $(subCategorias).each(function(index) {
                            if(subCategorias.length>0){
                                $('#subcategoria_id').append($('<option>', {
                                    value: subCategorias[index]['idSubcategoria'],
                                    text: subCategorias[index]['nombre']
                                }));
                            }
                        });
                    }
                }
            });
        }

        function cambiaEstado(valor, producto){
            $.ajax({
                url: "{{ url('producto/cambiaEstado') }}",
                type: 'POST',
                data:{
                    valor:valor,
                    producto:producto
                },
                dataType: 'json',
                success: function(data) {
                    if(data.estado === 'success'){
                        if(valor === 0){
                            html = "<span class='badge badge-light-danger fw-dold' onclick='cambiaEstado(1,"+producto+")'>Inactivo</span>";
                        }else{
                            html = "<span class='badge badge-light-success fw-dold' onclick='cambiaEstado(0,"+producto+")'>Activo</span>";
                        }
                        $('#contEstadoProd_'+producto).html(html);
                    }

                }
            });
        }
    </script>
@endsection


