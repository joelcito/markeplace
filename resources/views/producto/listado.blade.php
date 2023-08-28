@extends('layouts.app')
@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
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
                    <h2 class="fw-bold">Formulario de producto (PLAN ACTUAL:<span id="plan_actual" class="text-success"></span>)</h2>
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

                    <form id="formularioProducto">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Categoria</label>
                                    <select name="categoria_id" id="categoria_id" class="form-control form-control-solid mb-3 mb-lg-0" onchange="buscarSubCategorias(this)" required>
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
                                    <select name="subcategoria_id" id="subcategoria_id" class="form-control form-control-solid mb-3 mb-lg-0" required>
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
                                    <input type="text" id="nombre" name="nombre" class="form-control form-control-solid mb-3 mb-lg-0" required>
                                    <input type="hidden" id="producto_id" name="producto_id" value="0" >
                                </div>
                            </div>
                            <input type="hidden" id="imagenes_seleccionados" name="imagenes_seleccionados">
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Descripcion</label>
                                    <textarea id="descripcion" name="descripcion" cols="30" rows="3" class="form-control form-control-solid mb-3 mb-lg-0" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Prec. Uni.</label>
                                    <input type="number" id="precio_unitario" name="precio_unitario" class="form-control form-control-solid mb-3 mb-lg-0" required min="1">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="fv-row mb-7">
                                    <label class="fw-semibold fs-6 mb-2">Descuento %</label>
                                    {{-- <input type="range" max="100" min="0" id="descuento" name="descuento" class="form-control form-control-solid mb-3 mb-lg-0"> --}}
                                    <input type="range" id="descuento" min="0" max="100" value="0">
                                    <div id="valorActual">Valor: <span>0</span>%</div>
                                </div>
                            </div>
                            {{-- <div class="col-md-3">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Tipo M.</label>
                                    <select name="moneda" id="moneda" class="form-control form-control-solid mb-3 mb-lg-0" required>
                                        <option value="0">Bs</option>
                                        <option value="1">$us</option>
                                    </select>
                                </div>
                            </div> --}}
                            <div class="col-md-3">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Cantidad Disponible</label>
                                    <input type="text" id="cantidad" name="cantidad" class="form-control form-control-solid mb-3 mb-lg-0" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="fv-row mb-7">
                                    <label class="fw-semibold fs-6 mb-2">Agregar Cantidad</label>
                                    <input type="number" id="agregaCantidad" name="agregaCantidad" class="form-control form-control-solid mb-3 mb-lg-0" value="0">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="fv-row mb-7">
                                    <label class="fw-semibold fs-6 mb-2">Archivo PDF</label>
                                    <input type="file" id="archivo" name="archivo" class="form-control form-control-solid mb-3 mb-lg-0" multiple>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Imagenes / Video</label>
                                    <input type="file" id="imagenes" name="imagenes" class="form-control form-control-solid mb-3 mb-lg-0" multiple accept="image/*,video/*">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="text-center">Imagenes subidas</h6>
                                <small class="text-danger text-center" id="msg_nuevas_img_edit" style="display: none">Si desea subir nuevas imagenes, se remplazara las que subio anteriormente</small>
                                <div id="vista-previa">

                                </div>
                            </div>
                        </div>

                    </form>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-success w-100" id="btnAgregaProcuto" onclick="guardarProducto()">Guardar</button>
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
                <h2>Listado de Productos</h2>
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user" onclick="nuevoProducto()">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script type="text/javascript">

        $.ajaxSetup({
            // definimos cabecera donde estarra el token y poder hacer nuestras operaciones de put,post...
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        $( document ).ready(function() {
            let arryaFoto = [];
            toastr.options = {
                "closeButton"       : true,
                "debug"             : false,
                "newestOnTop"       : false,
                "progressBar"       : true,
                "positionClass"     : "toast-top-right",
                "preventDuplicates" : false,
                "onclick"           : null,
                "showDuration"      : "300",
                "hideDuration"      : "1000",
                "timeOut"           : "5000",
                "extendedTimeOut"   : "1000",
                "showEasing"        : "swing",
                "hideEasing"        : "linear",
                "showMethod"        : "fadeIn",
                "hideMethod"        : "fadeOut"
            }
            ajaxListado();
            $('#tabla_producto').DataTable({
                language: {
                    // url: '{{ asset('datatableEs.json') }}'
                },

                // Opciones de exportación
                dom: 'Bfrtip', // Elementos de control a mostrar (por ejemplo, botones de exportación)
                buttons: [
                    'copy', 'excel', 'pdf', 'print' // Botones de exportación disponibles (ejemplo: copiar, excel, pdf, imprimir)
                ]
            });
            // Detectar cambios en el input de imágenes
            $('#imagenes').on('change', function(e) {
                arryaFoto = []
                // Obtener los archivos seleccionados
                var archivos = e.target.files;
                let maxSizeInBytes = 10 * 1024 * 1024; // 10 MB

                // Limpiar la vista previa
                $('#vista-previa').empty();

                // Recorrer los archivos
                for (var i = 0; i < archivos.length; i++) {
                    var archivo = archivos[i];
                    if(archivo.size > maxSizeInBytes){
                        toastr.error('¡EL ARCHIVO '+archivo.name+' EXEDE LOS 10MB!');
                    }else{
                        // Crear un objeto FileReader
                        var lector = new FileReader();
                        lector.onload = (function(archivo) {
                            return function(e) {
                                var contenido;
                                var tipo = archivo.type;
                                if (tipo.startsWith('image/')) {
                                    contenido = $('<img>').attr('src', e.target.result)
                                                        .attr('width', '30%');
                                    arryaFoto.push(archivo.name);
                                    // arryaFoto.push("┼"+archivo.name);
                                    // arryaFoto.push(archivo.name+"┼");
                                } else if (tipo.startsWith('video/')) {
                                    // Crear un elemento de video temporal para obtener las dimensiones
                                    var videoTemp = document.createElement('video');
                                    videoTemp.src = e.target.result;
                                    videoTemp.addEventListener('loadedmetadata', function() {
                                        var ancho = videoTemp.videoWidth;
                                        var alto = videoTemp.videoHeight;
                                        if (ancho > alto) {
                                            console.log('Video horizontal');
                                            contenido = $('<video controls>').attr('src', e.target.result)
                                                                    .attr('width', '30%');
                                            // arryaFoto.push("┼"+archivo.name);
                                            // arryaFoto.push(archivo.name+"┼");
                                            arryaFoto.push(archivo.name);
                                        } else if (ancho < alto) {
                                            console.log('Video vertical');
                                            toastr.warning('¡EL VIDEO '+archivo.name+' NO CUMPLE CON LAS DIMENCIONES DE HORIZONTAL!');
                                        } else {
                                            console.log('Video cuadrado');
                                        }
                                        $('#vista-previa').append(contenido);
                                        $('#imagenes_seleccionados').val(arryaFoto)
                                    });
                                }
                                if (contenido) {
                                    $('#vista-previa').append(contenido);
                                }
                                $('#imagenes_seleccionados').val(arryaFoto)
                            };
                        })(archivo);
                        lector.readAsDataURL(archivo);
                    }
                }
            });
        });

        // Función para verificar si una imagen o video es horizontal
        function esHorizontal(file) {
            return new Promise(resolve => {
                const img = new Image();
                img.onload = function() {
                    const width = img.width;
                    const height = img.height;
                    resolve(width >= height); // Se considera horizontal si el ancho es mayor o igual a la altura
                };
                img.src = URL.createObjectURL(file);
            });
        }

        function verificarSiEsVideo(file) {
            if (file.type.startsWith('video/'))
                return true;
            else
                return false;
        }

        function guardarProducto(){
            if($("#formularioProducto")[0].checkValidity()){
                $('#btnAgregaProcuto').prop('disabled', true);
                var formData = new FormData();
                var archivo = $('#imagenes')[0].files;
                let contador = 0;

                let maxSizeInBytes = 10 * 1024 * 1024; // 10 MB
                let arrayLenos = [];
                // console.log($('#imagenes_seleccionados').val())
                let cadenaSeleccionados = $('#imagenes_seleccionados').val();
                var nombresArray = cadenaSeleccionados.split(',');
                // var nombresArray = cadenaSeleccionados.split(',┼');
                for(let i=0;i<archivo.length;i++){
                    let file = archivo[i];
                    if(nombresArray.includes(file.name)){
                        formData.append('archivo[]', file);
                        contador++;
                    }
                }

                var file = $('#archivo')[0].files;
                formData.append('file', file[0]);

                let valor = $('#producto_id').val();
                let sw = false;

                if(valor == 0){
                    if(contador >= 2)
                        sw = true;
                }else{
                    sw = true;
                    if(contador != 0){
                        if(contador >= 2)
                            sw = true;
                        else
                            sw = false;
                    }
                }
                if(sw){
                    formData.append('nombre',           $('#nombre').val());
                    formData.append('producto_id',      $('#producto_id').val());
                    formData.append('descripcion',      $('#descripcion').val());
                    formData.append('categoria_id',     $('#subcategoria_id').val());
                    formData.append('precio_unitario',  $('#precio_unitario').val());
                    formData.append('cantidad',         $('#cantidad').val());
                    formData.append('descuento',        $('#descuento').val());
                    formData.append('agregaCantidad',   $('#agregaCantidad').val());
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
                                $('#btnAgregaProcuto').prop('disabled', false);
                            }else if(data.estado === 'error'){
                                Swal.fire({
                                    title:  'Error!',
                                    text :  data.msg,
                                    icon:   'error',
                                    timer:  1500
                                })
                            }
                        }
                    });
                }else{
                    Swal.fire({
                        title:'Error!',
                        icon:'error',
                        text: 'Debe seleccionar al menos 2 fotografias',
                        timer: 3000
                    })
                    $('#btnAgregaProcuto').prop('disabled', false);
                }
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

        function eliminar(producto){
            Swal.fire({
                title: 'Esta seguro de eliminar?',
                text: "No podras revertir eso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminar!'
            }).then((result) => {
                $.ajax({
                    url: "{{ url('producto/eliminar') }}",
                    type: 'POST',
                    data:{id:producto},
                    dataType: 'json',
                    success: function(data) {
                        if(data.estado === 'success'){
                            if (result.isConfirmed) {
                                Swal.fire(
                                'Eliminado!',
                                'Se elimino el producto.',
                                'success'
                                )
                            }
                            ajaxListado();
                        }
                    }
                });
            })
        }

        function edita(idProducto,categoria,idSubcategoria,nombre,descripcion,preciounitario,cantidad,estado,calificacion, ubicacion, descuento){
            $('#nombre').val(nombre)
            $('#producto_id').val(idProducto)
            $('#descripcion').val(descripcion.replaceAll('"',''))
            $('#subcategoria_id').val(idSubcategoria)
            $('#categoria_id').val(categoria)
            $('#precio_unitario').val(preciounitario)
            $('#cantidad').val(cantidad)
            $('#descuento').val(descuento)
            $('#agregaCantidad').val(0)
            $('#valorActual span').text(descuento);
            $('#vista-previa').empty();

            $('#cantidad').prop('readonly', true);
            $('#agregaCantidad').prop('readonly', false);

            $('#btnAgregaProcuto').prop('disabled',false)
            $('#msg_nuevas_img_edit').show('toggle')

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

        function nuevoProducto(){
            $.ajax({
                url: "{{ url('producto/verificaPlan') }}",
                type: 'POST',
                // data:{id:producto},
                dataType: 'json',
                success: function(data) {
                    if(data.estado === 'success'){
                        $('#nombre').val('')
                        $('#nombre').val('')
                        $('#producto_id').val(0)
                        $('#descripcion').val('')
                        $('#subcategoria_id').val('')
                        $('#precio_unitario').val('')
                        $('#cantidad').val('')
                        $('#descuento').val(0)
                        $('#valorActual span').text(0);
                        $('#moneda').val(0)
                        $('#categoria_id').val('')
                        $('#vista-previa').empty();

                        $('#archivo').val(null);
                        $('#imagenes').val(null);
                        $('#cantidad').prop('readonly', false);
                        $('#agregaCantidad').prop('readonly', true);
                        $('#msg_nuevas_img_edit').hide('toggle')

                        $('#plan_actual').text(data.plan)
                        if(data.planChe==="Basico"){
                            if(data.cantidad >= 5){
                                $('#btnAgregaProcuto').prop('disabled',true)
                            }else{
                                $('#btnAgregaProcuto').prop('disabled',false)
                            }
                        }else if(data.planChe==="Estandar"){
                            $('#btnAgregaProcuto').prop('disabled',false)
                        }else if(data.planChe==="Superior"){
                            $('#btnAgregaProcuto').prop('disabled',false)
                        }else if(data.planChe==="Suspendido"){
                            $('#btnAgregaProcuto').prop('disabled',true)
                        }
                    }else{

                    }
                }
            });
        }

        $(document).ready(function() {
            $('#descuento').on('input', function() {
                var valor = $(this).val();
                $('#valorActual span').text(valor);
            });
        });
    </script>
@endsection


