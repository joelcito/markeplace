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

                            {{--  @dd($informacion)  --}}

                            <form action="{{ url('informacion/guarda') }}" id="formularioTienda" method="POST">
                                @csrf
                                <div class="row mt-6">
                                    <div class="col-md-3">
                                        <div style="height: 250px; width: 250px;">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/1200px-User_icon_2.svg.png" alt="la imae" width="100%">
                                        </div>
                                        {{--  <input type="file" class="form-control mt-5">  --}}
                                        {{--  @dd($persona)  --}}
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="" class="required">NOMBRES</label>
                                                {{--  <textarea name="quienessomos" id="quienessomos" cols="30" rows="5" class="form-control"></textarea>  --}}
                                                <input type="text" id="quiensomos" name="quiensomos" class="form-control" value="{{ $persona->nombres }}">
                                                <input type="text" id="quiensomos" name="quiensomos" value="{{ $persona->idPersona }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="" class="required">APELLIDO PATERNO</label>
                                                {{--  <textarea name="quienessomos" id="quienessomos" cols="30" rows="5" class="form-control"></textarea>  --}}
                                                <input type="text" id="quiensomos" name="quiensomos" class="form-control" value="{{ $persona->apellido_paterno }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="" class="required">APELLIDO MATERNO</label>
                                                {{--  <textarea name="quienessomos" id="quienessomos" cols="30" rows="5" class="form-control"></textarea>  --}}
                                                <input type="text" id="quiensomos" name="quiensomos" class="form-control" value="{{ $persona->apellido_materno }}">
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-md-4">
                                                <label for="" class="required">CEDULA</label>
                                                {{--  <textarea name="quienessomos" id="quienessomos" cols="30" rows="5" class="form-control"></textarea>  --}}
                                                <input type="text" id="quiensomos" name="quiensomos" class="form-control" value="{{ $persona->ci }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="" class="required">NIT</label>
                                                {{--  <textarea name="quienessomos" id="quienessomos" cols="30" rows="5" class="form-control"></textarea>  --}}
                                                <input type="text" id="quiensomos" name="quiensomos" class="form-control" value="{{ $persona->nit }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="" class="required">RAZON SOCIAL</label>
                                                {{--  <textarea name="quienessomos" id="quienessomos" cols="30" rows="5" class="form-control"></textarea>  --}}
                                                <input type="text" id="quiensomos" name="quiensomos" class="form-control" value="{{ $persona->razon_social }}">
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-md-4">
                                                <label for="" class="required">CELULAR</label>
                                                <input type="text" id="quiensomos" name="quiensomos" class="form-control" value="{{ $persona->celular }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="" class="required">CORREO</label>
                                                <input type="text" id="quiensomos" name="quiensomos" class="form-control" value="{{ $persona->correo }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="" class="required">FECHA DE NACIMEINTO</label>
                                                <input type="date" id="quiensomos" name="quiensomos" class="form-control" value="{{ $persona->fecha_nacimiento }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-6">
                                    <div class="col-md-6">
                                        <label for="" class="required">DIRECCION</label>
                                        <input type="text" id="whatsapp" name="whatsapp" class="form-control" value="{{ $persona->direccion }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="required">FOTO</label>
                                        <input type="file" id="telegram" name="telegram" class="form-control" value="{{ $persona->nombres }}">
                                    </div>
                                </div>

                                <div class="row mt-10 mb-5">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success w-100 btn-sm">Guardar</button>
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

        {{--  $( document ).ready(function() {
            detallePerfil();
        });

        function guardarInformacion(){
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
        }  --}}

    </script>
@endsection

