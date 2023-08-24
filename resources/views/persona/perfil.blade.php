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

            {{--  <div id="detalleperfil">

            </div>  --}}

            <div class="row g-5 g-xxl-8">
                <div class="col-xl-12">
                    <div class="card mb-5 mb-xxl-8">
                        <div class="card-body pb-0">
                            <h1>EDICION DE PERFIL</h1>

                            {{--  @dd($informacion)  --}}

                            <form action="{{ url('persona/guarda') }}" id="formularioTienda" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mt-6">
                                    <div class="col-md-3">
                                        <div style="height: 250px; width: 250px;">
                                            <img width="100%" src="{{ asset('compradorPerfil/'.$persona->foto) }}" alt="">
                                        </div>
                                        {{--  <input type="file" class="form-control mt-5">  --}}
                                        {{--  @dd($persona)  --}}
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="" class="required">NOMBRES</label>
                                                {{--  <textarea name="quienessomos" id="quienessomos" cols="30" rows="5" class="form-control"></textarea>  --}}
                                                <input type="text" id="nombres" name="nombres" class="form-control" value="{{ $persona->nombres }}" required>
                                                <input type="hidden" id="persona_id" name="persona_id" value="{{ $persona->idPersona }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="" class="required">APELLIDO PATERNO</label>
                                                {{--  <textarea name="quienessomos" id="quienessomos" cols="30" rows="5" class="form-control"></textarea>  --}}
                                                <input type="text" id="ap_paterno" name="ap_paterno" class="form-control" value="{{ $persona->apellido_paterno }}" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="" class="required">APELLIDO MATERNO</label>
                                                <input type="text" id="ap_materno" name="ap_materno" class="form-control" value="{{ $persona->apellido_materno }}" required>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-md-6">
                                                <label for="" class="required">RAZON SOCIAL</label>
                                                <input type="text" id="razon_social" name="razon_social" class="form-control" value="{{ $persona->razon_social }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">NIT</label>
                                                <input type="text" id="nit" name="nit" class="form-control" value="{{ $persona->nit }}">
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-md-6">
                                                <label for="" class="required">CORREO / USUARIO</label>
                                                <input type="email" id="correo" name="correo" class="form-control" value="{{ $persona->correo }}" required readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="" class="required">TELEFONO / CELULAR</label>
                                                <input type="text" id="celular" name="celular" class="form-control" value="{{ $persona->celular }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-6">
                                    <div class="col-md-6">
                                        <label for="" class="required">DIRECCION DE ENTREGA</label>
                                        <input type="text" id="direccion" name="direccion" class="form-control" value="{{ $persona->direccion }}" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">FOTO</label>
                                        <input type="file" id="foto" name="foto" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">CAMBIAR CONTRASEÑA</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                </div>

                                <div class="row mt-10 mb-5">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success w-100 btn-sm" onclick="guardar()">Guardar</button>
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

        function guardar(){
            if($("#formularioTienda")[0].checkValidity()){
                Swal.fire({
                    title: 'Exito!!',
                    text: 'Se guardo con exito!',
                    icon: 'success',
                    timer: 5500
                })
                $("#formularioTienda")[0].submit()
            }else{
    			$("#formularioTienda")[0].reportValidity()
            }
        }

        // $( document ).ready(function() {
        //     detallePerfil();
        // });

        // function guardarInformacion(){
        //     if($("#formularioTienda")[0].checkValidity()){

        //         var formData = new FormData();
        //         var archivo = $('#imagenes')[0].files;
        //         //for(let i=0;i<archivo.length;i++){
        //         //formData.append('archivo[]', archivo[i]);
        //         formData.append('archivo', archivo[0]);
        //         //}
        //         formData.append('nombre',       $('#nombre').val());
        //         formData.append('nit',          $('#nit').val());
        //         formData.append('celular',      $('#celular').val());
        //         formData.append('correo',       $('#correo').val());
        //         formData.append('descripcion',  $('#descripcion').val());
        //         formData.append('tienda_id',    $('#tienda_id').val());
        //         $.ajax({
        //             url: "{{ url('tienda/guarda') }}",
        //             data:formData,
        //             type: 'POST',
        //             dataType: 'json',
        //             processData: false,
        //             contentType: false,
        //             success: function(data) {
        //                 if(data.estado === 'success'){
        //                     Swal.fire({
        //                         title:'Guardado!',
        //                         text :'Se guardo con exito.',
        //                         icon: 'success',
        //                         timer: 1500
        //                     })
        //                     $('#detalleperfil').html(data.detalle);
        //                 }
        //             }
        //         });

        //     }else{
    	// 		$("#formularioTienda")[0].reportValidity()
        //     }
        // }

        // function detallePerfil(){
        //     $.ajax({
        //         url: "{{ url('tienda/detallePerfil') }}",
        //         type: 'POST',
        //         dataType: 'json',
        //         success: function(data) {
        //             if(data.estado === 'success')
        //                 $('#detalleperfil').html(data.detalle);
        //         }
        //     });
        // }

    </script>
@endsection

