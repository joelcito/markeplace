@extends('layouts.app')
@section('css')

@endsection
@section('metadatos')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')
<!--begin::Content wrapper-->
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">

            <div id="detalleperfil">

            </div>

            <div class="row g-5 g-xxl-8">
                <div class="col-xl-12">
                    <div class="card mb-5 mb-xxl-8">
                        <div class="card-body pb-0">
                            <form action="" id="formularioTienda">
                                <div class="row mt-6">
                                    <div class="col-md-6">
                                        <label for="" class="required">Nombre o Razon Social (Nombre de la Tienda)</label>
                                        <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $tienda->nombre }}" required>
                                        <input type="hidden" id="tienda_id" name="tienda_id" value="{{ $tienda->idTienda }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">NIT o CI</label>
                                        <input type="text" id="nit" name="nit" class="form-control" value="{{ $tienda->nit }}" required>
                                    </div>
                                </div>

                                <div class="row mt-6">
                                    <div class="col-md-12">

                                        <label for="" class="required">Descripcion breve de la tienda</label>
                                        <input type="text" id="descripcion" name="descripcion" class="form-control" value="{{ $tienda->descripcion }}" required>
                                    </div>
                                </div>

                                <div class="row mt-12">
                                    <div class="col-md-6">
                                        <label for="" class="required">Ciudad / Pais</label>
                                        <input type="text" id="ubicacion" name="ubicacion" class="form-control" value="{{ $tienda->ubicacion }}" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" class="required">Correo</label>
                                        <input type="email" id="correo" name="correo" class="form-control" value="{{ $tienda->correo }}" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" class="required">Celular</label>
                                        <input type="text" id="celular" name="celular" class="form-control" value="{{ $tienda->celular }}" required>
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <label for="" class="required">Direccion de la Tienda</label>
                                        <input type="text" id="" name="" class="form-control">
                                    </div> --}}
                                </div>

                                <div class="row mt-6">
                                    <div class="col-md-4">
                                        <label for="">Enlace WhatsApp</label>
                                        <input type="text" id="url_whatsapp" name="url_whatsapp" class="form-control" value="{{ $tienda->url_whatsapp }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Enlace Facebook</label>
                                        <input type="text" id="url_facebook" name="url_facebook" class="form-control" value="{{ $tienda->url_facebook }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Enlace Instagram</label>
                                        <input type="text" id="url_instagram" name="url_instagram" class="form-control" value="{{ $tienda->url_instagram }}" required>
                                    </div>
                                </div>
                                <div class="row mt-6">
                                    <div class="col-md-6">
                                        <label for="" class="required">Adjuntar logo de la empresa</label>
                                        <input id="imagenes" name="imagenes" type="file" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="required">Certificacion de NIT</label>
                                        <input id="certificacion" name="certificacion" type="file" class="form-control">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Usuario</label>
                                        <input type="text" id="usuario" name="usuario" class="form-control" value="{{ $perfil->usuario }}" required readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Contraseña</label>
                                        <input type="password" id="contrasena" name="contrasena" class="form-control">
                                        <small class="text-danger">Llene el campo si desea cambiar la contraseña, caso contrario deje el campo vacio.</small>
                                    </div>
                                </div>
                                <div class="row mt-10 mb-5">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-primary w-100 btn-sm" onclick="guardarTienda()">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('js')
    <script>
        $.ajaxSetup({
            // definimos cabecera donde estarra el token y poder hacer nuestras operaciones de put,post...
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        $( document ).ready(function() {
            detallePerfil();
        });

        function guardarTienda(){
            if($("#formularioTienda")[0].checkValidity()){

                var formData = new FormData();
                var archivo = $('#imagenes')[0].files;
                formData.append('archivo', archivo[0]);

                var certificado = $('#certificacion')[0].files;
                formData.append('certificado', certificado[0]);

                formData.append('nombre',       $('#nombre').val());
                formData.append('nit',          $('#nit').val());
                formData.append('descripcion',  $('#descripcion').val());

                formData.append('ubicacion',        $('#ubicacion').val());
                formData.append('url_facebook',     $('#url_facebook').val());
                formData.append('url_instagram',    $('#url_instagram').val());
                formData.append('url_whatsapp',     $('#url_whatsapp').val());

                formData.append('celular',      $('#celular').val());
                formData.append('correo',       $('#correo').val());
                formData.append('tienda_id',    $('#tienda_id').val());

                formData.append('usuario',      $('#usuario').val());
                formData.append('contrasena',   $('#contrasena').val());

                $.ajax({
                    url: "{{ url('tienda/guarda') }}",
                    data:formData,
                    type: 'POST',
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if(data.estado === 'success'){
                            Swal.fire({
                                title:'Guardado!',
                                text :'Se guardo con exito.',
                                icon: 'success',
                                timer: 1500
                            })
                            $('#detalleperfil').html(data.detalle);
                            location.reload(); // Recargar la página
                        }
                    }
                });

            }else{
    			$("#formularioTienda")[0].reportValidity()
            }
        }

        function detallePerfil(){
            $.ajax({
                url: "{{ url('tienda/detallePerfil') }}",
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    if(data.estado === 'success')
                        $('#detalleperfil').html(data.detalle);
                }
            });
        }

    </script>
@endsection

