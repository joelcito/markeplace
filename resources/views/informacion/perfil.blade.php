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
                                            <img src="{{ asset('imgLogoTienda/20230621015635.jpg') }}" alt="la imae" width="100%">
                                        </div>
                                        <input type="file" class="form-control mt-5">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="" class="required">QUIENES SOMOS</label>
                                                <textarea name="quienessomos" id="quienessomos" cols="30" rows="5" class="form-control">{{ $informacion[6]->descripcion }}</textarea>
                                                {{--  <input type="text" id="quiensomos" name="quiensomos" class="form-control" value="{{ $informacion[6]->descripcion }}">  --}}
                                            </div>
                                        </div>
                                        <div class="row mt-6">
                                            <div class="col-md-6">
                                                <label for="" class="required">MISION</label>
                                                <textarea name="mision" id="mision" cols="30" rows="5" class="form-control">{{ $informacion[4]->descripcion }}</textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="" class="required">VISION</label>
                                                <textarea name="vision" id="vision" cols="30" rows="5" class="form-control">{{ $informacion[5]->descripcion }}</textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="row mt-6">
                                    <div class="col-md-4">
                                        <label for="" class="required">WhatsApp</label>
                                        <input type="text" id="whatsapp" name="whatsapp" class="form-control" value="{{ $informacion[0]->descripcion }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="required">Telegram</label>
                                        <input type="text" id="telegram" name="telegram" class="form-control" value="{{ $informacion[1]->descripcion }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="required">Facebook</label>
                                        <input type="text" id="facebook" name="facebook" class="form-control" value="{{ $informacion[2]->descripcion }}">
                                    </div>
                                </div>

                                <div class="row mt-6">
                                    <div class="col-md-4">
                                        <label for="" class="required">Politicas</label>
                                        <input type="text" id="politicas" name="politicas" class="form-control" value="{{ $informacion[7]->descripcion }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="required">Telefono</label>
                                        <input type="text" id="telefono" name="telefono" class="form-control" value="{{ $informacion[8]->descripcion }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="required">Correo</label>
                                        <input type="text" id="correo" name="correo" class="form-control" value="{{ $informacion[9]->descripcion }}">
                                    </div>
                                </div>

                                <div class="row mt-6">
                                    <div class="col-md-4">
                                        <label for="" class="required">IMAGEN QR 1</label>
                                        <img src="" alt="">
                                        <input type="file" class="form-control" id="qr1" name="qr1">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="required">IMAGEN QR 2</label>
                                        <img src="" alt="">
                                        <input type="file" class="form-control" id="qr2" name="qr2">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="required">IMAGEN QR 3</label>
                                        <img src="" alt="">
                                        <input type="file" class="form-control" id="qr3" name="qr3">
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

        $( document ).ready(function() {
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
        }

    </script>
@endsection
