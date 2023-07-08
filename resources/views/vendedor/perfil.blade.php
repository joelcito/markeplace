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
                                        <label for="" class="required">Nombre o Razon Social</label>
                                        <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $tienda->nombre }}">
                                        <input type="hidden" id="tienda_id" name="tienda_id" value="{{ $tienda->idTienda }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="required">Numero de Identificacion Tributaria</label>
                                        <input type="text" id="nit" name="nit" class="form-control" value="{{ $tienda->nit }}">
                                    </div>
                                </div>

                                <div class="row mt-6">
                                    <div class="col-md-12">

                                        <label for="" class="required">Descripcion de la tienda</label>
                                        <input type="text" id="descripcion" name="descripcion" class="form-control" value="{{ $tienda->descripcion }}">
                                    </div>
                                </div>

                                <div class="row mt-6">
                                    <div class="col-md-6">
                                        <label for="" class="required">Pais / Ciudad</label>
                                        <input type="text" id="" name="" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="required">Direccion de la Tienda</label>
                                        <input type="text" id="" name="" class="form-control">
                                    </div>
                                </div>

                                <div class="row mt-6">
                                    <div class="col-md-4">
                                        <label for="" class="required">Correo</label>
                                        <input type="email" id="correo" name="correo" class="form-control" value="{{ $tienda->correo }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="required">Telefono</label>
                                        <input type="text" id="" name="" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="required">Celular</label>
                                        <input type="text" id="celular" name="celular" class="form-control" value="{{ $tienda->celular }}">
                                    </div>
                                </div>

                                <div class="row mt-6">
                                    <div class="col-md-4">
                                        <label for="">Enlace WhatsApp</label>
                                        <input type="text" id="" name="" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Enlace Facebook</label>
                                        <input type="text" id="" name="" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Enlace Instagram</label>
                                        <input type="text" id="" name="" class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-6">
                                    <div class="col-md-12">
                                        <label for="" class="required">Imagen</label>
                                        <input id="imagenes" name="imagenes" type="file" class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-10 mb-5">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-success w-100 btn-sm" onclick="guardarTienda()">Guardar</button>
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
                //for(let i=0;i<archivo.length;i++){
                //formData.append('archivo[]', archivo[i]);
                formData.append('archivo', archivo[0]);
                //}
                formData.append('nombre',       $('#nombre').val());
                formData.append('nit',          $('#nit').val());
                formData.append('celular',      $('#celular').val());
                formData.append('correo',       $('#correo').val());
                formData.append('descripcion',  $('#descripcion').val());
                formData.append('tienda_id',    $('#tienda_id').val());
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
