@extends('layouts.app')
@section('css')

@endsection
@section('metadatos')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')
<!--begin::Pricing card-->
<div class="card" id="kt_pricing">
    <!--begin::Card body-->
    <div class="card-body p-lg-17">
        <!--begin::Plans-->
        <div class="d-flex flex-column">
            <!--begin::Heading-->
            <div class="mb-13 text-center">
                <h1 class="fs-2hx fw-bold mb-5">Plan de suscripcion</h1>
            </div>
            <div class="row g-10">
                <!--begin::Col-->
                <div class="col-xl-4">
                    <div class="d-flex h-100 align-items-center">
                        <!--begin::Option-->
                        <div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
                            <!--begin::Heading-->
                            <div class="mb-7 text-center">
                                <!--begin::Title-->
                                <h1 class="text-dark mb-5 fw-bolder">Basica</h1>
                                <div class="row w-100">
                                    <div class="col-md-6">
                                        <div class="text-center">
                                            <span class="mb-2 text-primary">Bs</span>
                                            <span class="fs-2x fw-bold text-primary" data-kt-plan-price-month="39" data-kt-plan-price-annual="399">0</span>
                                            <span class="fs-7 fw-semibold opacity-50">/
                                            <span data-kt-element="period">Mensual</span></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-center">
                                            <span class="mb-2 text-primary">Bs</span>
                                            <span class="fs-2x fw-bold text-primary" data-kt-plan-price-month="39" data-kt-plan-price-annual="399">0</span>
                                            <span class="fs-7 fw-semibold opacity-50">/
                                            <span data-kt-element="period">Anual</span></span>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Price-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Features-->
                            <div class="w-100 mb-10">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center mb-5">
                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Productos exhibidos (5 por año)</span>
                                    <i class="ki-duotone ki-check-circle fs-1 text-success">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center mb-5">
                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Exhibicion y alcance al publico (Baja)</span>
                                    <i class="ki-duotone ki-check-circle fs-1 text-success">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center mb-5">
                                    <span class="fw-semibold fs-6 text-gray-400 flex-grow-1 pe-3">Marketing de productos (Ninguno)</span>
                                    <i class="ki-duotone ki-cross-circle fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center mb-5">
                                    <span class="fw-semibold fs-6 text-gray-400 flex-grow-1">Creacion de documentos (Ninguno)</span>
                                    <i class="ki-duotone ki-cross-circle fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center mb-5">
                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1">Verificacion Comercial (Si)</span>
                                    <i class="ki-duotone ki-check-circle fs-1 text-success">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center mb-5">
                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1">Soporte y Atencion al cliente (Si)</span>
                                    <i class="ki-duotone ki-check-circle fs-1 text-success">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                            </div>
                            @php
                                $perfil_id =session('perfil')->idPerfil;
                                $perfil = App\Models\Perfil::find($perfil_id);
                            @endphp
                            <div class="row w-100" >
                                <div class="col-md-12">
                                    <form id="form_basica">
                                        <label for="" class="required">Modalidad</label>
                                        <select name="modalidad_basica" id="modalidad_basica" class="form-control" required>
                                            <option value="">Seleccione</option>
                                            <option value="Mensual">Mensual</option>
                                            <option value="Anual">Anual</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                            <button type="button" onclick="enviarCorreo('basica')" class="btn w-100 btn-sm btn-primary mt-5" target="_blank">
                                Solicitar
                            </button>
                            @if ($perfil->plandepago === 1)
                                <h3 class="text-success mt-2 text-center">PLAN ACTUAL</h3>
                            @endif
                            <!--end::Select-->
                        </div>
                        <!--end::Option-->
                    </div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-4">
                    <div class="d-flex h-100 align-items-center">
                        <!--begin::Option-->
                        <div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-20 px-10">
                            <!--begin::Heading-->
                            <div class="mb-7 text-center">
                                <!--begin::Title-->
                                <h1 class="text-dark mb-5 fw-bolder">Estandar</h1>
                                <!--end::Title-->
                                <!--begin::Description-->
                                {{--  <div class="text-gray-400 fw-semibold mb-5">Optimal for 100+ team siz
                                <br />e and grown company</div>  --}}
                                <!--end::Description-->
                                <!--begin::Price-->
                                <div class="row w-100">
                                    <div class="col-md-6">
                                        <div class="text-center">
                                            <span class="mb-2 text-primary">Bs</span>
                                            <span class="fs-2x fw-bold text-primary" data-kt-plan-price-month="39" data-kt-plan-price-annual="399">200</span>
                                            <span class="fs-7 fw-semibold opacity-50">/
                                            <span data-kt-element="period">Mensual</span></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-center">
                                            <span class="mb-2 text-primary">Bs</span>
                                            <span class="fs-2x fw-bold text-primary" data-kt-plan-price-month="39" data-kt-plan-price-annual="399">2.000</span>
                                            <span class="fs-7 fw-semibold opacity-50">/
                                            <span data-kt-element="period">Anual</span></span>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Price-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Features-->
                            <div class="w-100 mb-10">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center mb-5">
                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Productos exhibidos <br> ( Ilimitado )</span>
                                    <i class="ki-duotone ki-check-circle fs-1 text-success">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center mb-5">
                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Exhibicion y alcance al publico <br> ( Intermedia )</span>
                                    <i class="ki-duotone ki-check-circle fs-1 text-success">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                {{-- <div class="d-flex align-items-center mb-5">
                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Marketing de productos <br> ( Facebook )</span>
                                    <i class="ki-duotone ki-check-circle fs-1 text-success">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div> --}}
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center mb-5">
                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1">Creacion de documentos (Pedido en Pdf)</span>
                                    <i class="ki-duotone ki-check-circle fs-1 text-success">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center mb-5">
                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1">Verificacion Comercial (Si)</span>
                                    <i class="ki-duotone ki-check-circle fs-1 text-success">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center mb-5">
                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1">Soporte y Atencion al cliente (Si)</span>
                                    <i class="ki-duotone ki-check-circle fs-1 text-success">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                            </div>
                            <div class="row w-100" >
                                <div class="col-md-12">
                                    <form id="form_estandar">
                                        <label for="" class="required">Modalidad</label>
                                        <select name="modalidad_estandar" id="modalidad_estandar" class="form-control" required>
                                            <option value="">Seleccione</option>
                                            <option value="Mensual">Mensual</option>
                                            <option value="Anual">Anual</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                            <button type="button" onclick="enviarCorreo('estandar')" class="btn btn-sm btn-primary mt-5 w-100" target="_blank">
                                Solicitar
                            </button>
                            @if ($perfil->plandepago === 2)
                                <h3 class="text-success mt-2 text-center">PLAN ACTUAL</h3>
                            @endif
                        </div>
                        <!--end::Option-->
                    </div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-4">
                    <div class="d-flex h-100 align-items-center">
                        <!--begin::Option-->
                        <div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
                            <!--begin::Heading-->
                            <div class="mb-7 text-center">
                                <!--begin::Title-->
                                <h1 class="text-dark mb-5 fw-bolder">Superior</h1>
                                <!--end::Title-->
                                <!--begin::Description-->
                                {{--  <div class="text-gray-400 fw-semibold mb-5">Optimal for 1000+ team
                                <br />and enterpise</div>  --}}
                                <!--end::Description-->
                                <!--begin::Price-->
                                <div class="row w-100">
                                    <div class="col-md-6">
                                        <div class="text-center">
                                            <span class="mb-2 text-primary">Bs</span>
                                            <span class="fs-2x fw-bold text-primary" data-kt-plan-price-month="39" data-kt-plan-price-annual="399">500</span>
                                            <span class="fs-7 fw-semibold opacity-50">/
                                            <span data-kt-element="period">Mensual</span></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-center">
                                            <span class="mb-2 text-primary">Bs</span>
                                            <span class="fs-2x fw-bold text-primary" data-kt-plan-price-month="39" data-kt-plan-price-annual="399">5.000</span>
                                            <span class="fs-7 fw-semibold opacity-50">/
                                            <span data-kt-element="period">Anual</span></span>
                                        </div>
                                    </div>
                                </div>s
                                <!--end::Price-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Features-->
                            <div class="w-100 mb-10">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center mb-5">
                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Productos exhibidos <br> ( Ilimitado )</span>
                                    <i class="ki-duotone ki-check-circle fs-1 text-success">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center mb-5">
                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Exhibicion y alcance al publico <br> ( Alta )</span>
                                    <i class="ki-duotone ki-check-circle fs-1 text-success">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                {{-- <div class="d-flex align-items-center mb-5">
                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Marketing de productos <br> ( Facebook, Instagram )</span>
                                    <i class="ki-duotone ki-check-circle fs-1 text-success">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div> --}}
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center mb-5">
                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1">Creacion de documentos (Pedido y cotizaciones PDF)</span>
                                    <i class="ki-duotone ki-check-circle fs-1 text-success">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center mb-5">
                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1">Verificacion Comercial (Si)</span>
                                    <i class="ki-duotone ki-check-circle fs-1 text-success">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center mb-5">
                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1">Soporte y Atencion al cliente (Si)</span>
                                    <i class="ki-duotone ki-check-circle fs-1 text-success">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <div class="row w-100" >
                                    <div class="col-md-12">
                                        <form id="form_superior">
                                            <label for="" class="required">Modalidad</label>
                                            <select name="modalidad_superior" id="modalidad_superior" class="form-control" required>
                                                <option value="">Seleccione</option>
                                                <option value="Mensual">Mensual</option>
                                                <option value="Anual">Anual</option>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                                <button type="button" onclick="enviarCorreo('superior')" class="btn w-100 btn-sm btn-primary mt-5" target="_blank">
                                    Solicitar
                                </button>
                                @if ($perfil->plandepago === 3)
                                    <h3 class="text-success mt-2 text-center">PLAN ACTUAL</h3>
                                @endif
                            </div>
                        </div>
                        <!--end::Option-->
                    </div>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Plans-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Pricing card-->

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

        function enviarCorreo(tipo){
            let f = "form_"+tipo;
            // let dato = $('#'+f).serialize()
            if($("#"+f)[0].checkValidity()){
                $.ajax({
                    url: "{{ url('tienda/enviarCorreo') }}",
                    type: 'POST',
                    data:{
                        tipo        :   tipo,
                        modalidad   :  $('#modalidad_'+tipo).val()
                    },
                    dataType: 'json',
                    success: function(data) {
                        if(data.estado === 'success'){
                            Swal.fire({
                                title:'Guardado!',
                                text :'Se guardo con exito.',
                                icon: 'success',
                                timer: 1500
                            })
                            location.reload();
                        }
                    }
                });
            }else{
    			$("#"+f)[0].reportValidity()
            }
        }

    </script>
@endsection

