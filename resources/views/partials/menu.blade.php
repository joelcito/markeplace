@section('css')
    <style>
        .active-link {
            color: orange;
        }
    </style>
@endsection
{{--  <div class="app-sidebar-menu overflow-hidden flex-column-fluid">  --}}
<div class="app-sidebar-menu overflow-hidden flex-column-fluid" style="background: #046cac;">
    <!--begin::Menu wrapper-->
    <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
        <!--begin::Menu-->
        <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
            {{--  @dd(session('rol'))  --}}
            @if (session('rol') === 1)
                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="text-white">ADMINISTRADOR</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="{{ url('informacion/perfil') }}">
                        <span class="menu-icon">
                            {{-- <i class="ki-duotone ki-rocket fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i> --}}

                            <i class="fa-solid fa-house"></i>

                        </span>
                        <span class="menu-title" {{ Request::is('informacion/perfil') ? "style=color:orange" : 'style=color:white' }}>PERFIL</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="{{ url('users') }}">
                        <span class="menu-icon">
                            {{-- <i class="ki-duotone ki-rocket fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i> --}}
                            <i class="fa-solid fa-user-plus"></i>
                        </span>
                        <span class="menu-title" {{ Request::is('users') ? "style=color:orange" : 'style=color:white' }}>USUARIOS</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="{{ url('tienda/listado') }}">
                        <span class="menu-icon">
                            {{-- <i class="ki-duotone ki-rocket fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i> --}}
                            <i class="fa-solid fa-store"></i>
                        </span>
                        <span class="menu-title" {{ Request::is('tienda/listado') ? "style=color:orange" : 'style=color:white' }}>TIENDAS</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="{{ url('categoria/listado') }}">
                        <span class="menu-icon">
                            {{-- <i class="ki-duotone ki-rocket fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i> --}}
                            <i class="fa-solid fa-folder"></i>
                        </span>
                        <span class="menu-title" {{ Request::is('categoria/listado') ? "style=color:orange" : 'style=color:white' }}>CATEGORIAS</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="{{ url('subcategoria/listado') }}">
                        <span class="menu-icon">
                            {{-- <i class="ki-duotone ki-rocket fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i> --}}
                            <i class="fa-solid fa-shapes"></i>
                        </span>
                        <span class="menu-title" {{ Request::is('subcategoria/listado') ? "style=color:orange" : 'style=color:white' }}>SUB CATEGORIAS</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="{{ url('/') }}">
                        <span class="menu-icon">
                            {{-- <i class="ki-duotone ki-rocket fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i> --}}
                            <i class="fa-solid fa-chart-simple"></i>
                        </span>
                        <span class="menu-title" {{ Request::is('/') ? "style=color:orange" : 'style=color:white' }}>PANEL INFORMATIVO</span>
                    </a>
                    <!--end:Menu link-->
                </div>

            @endif

            @if (session('rol') === 3)
                {{--  @dd(
                    $sw,
                    $rol,
                    $persona->nombres,
                    $persona->apellido_materno,
                    $persona->razon_social,
                    $persona->direccion,
                    $persona->celular,
                    is_null($tienda->logo),
                    // $tienda->logo,
                    is_null($tienda->nombre),
                    // $tienda->nombre,
                    is_null($tienda->ubicacion),
                    // $tienda->ubicacion,
                    empty($tienda->logo),
                    // $tienda->logo,
                    empty($tienda->nombre),
                    // $tienda->nombre,
                    empty($tienda->ubicacion),
                    // $tienda->ubicacion,
                    $tienda->idTienda
                    )  --}}
                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="text-white">VENDEDOR</span>
                    </div>
                    <!--end:Menu content-->
                </div>

                <div class="menu-item">
                    <!--begin:Menu link-->
                    {{-- <a class="menu-link" href="{{ ($sw)? url('tienda/perfil') : 'javascript:void(0)' }}"> --}}
                    <a class="menu-link" {{ ($sw)? 'href='.url('tienda/perfil').'' : 'onclick=verificar()' }} >
                        <span class="menu-icon">
                            <i class="fa-solid fa-house"></i>
                        </span>
                        <span class="menu-title" {{ Request::is('tienda/perfil') ? "style=color:orange" : 'style=color:white' }}>PERFIL DE EMPRESA</span>
                    </a>
                    <!--end:Menu link-->
                </div>

                <div class="menu-item">
                    <!--begin:Menu link-->
                    {{-- <a class="menu-link" href="{{ ($sw)? url('producto/listado') : 'javascript:void(0)' }}" > --}}
                    <a class="menu-link" {{ ($sw)? 'href='.url('producto/listado').'' : 'onclick=verificar()' }} >
                        <span class="menu-icon">
                            {{-- <i class="ki-duotone ki-rocket fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i> --}}
                            <i class="fa-solid fa-calendar-week"></i>
                        </span>
                        <span class="menu-title" {{ Request::is('producto/listado') ? "style=color:orange" : 'style=color:white' }}>MIS PRODUCTOS</span>
                    </a>
                    <!--end:Menu link-->
                </div>

                <div class="menu-item">
                    <!--begin:Menu link-->
                    {{-- <a class="menu-link" href="{{ ($sw)? url('vendedor/pedido') : 'javascript:void(0)' }}"> --}}
                    <a class="menu-link" {{ ($sw)? 'href='.url('vendedor/pedido').'' : 'onclick=verificar()' }} >
                        <span class="menu-icon">
                            {{-- <i class="ki-duotone ki-rocket fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i> --}}
                            <i class="fa-regular fa-rectangle-list"></i>
                        </span>
                        <span class="menu-title" {{ Request::is('vendedor/pedido') ? "style=color:orange" : 'style=color:white' }}>PEDIDOS</span>
                    </a>
                    <!--end:Menu link-->
                </div>

                <div class="menu-item">
                    <!--begin:Menu link-->
                    {{-- <a class="menu-link" href="{{ ($sw)? url('subcripcion/subcripcion') : 'javascript:void(0)' }}"> --}}
                    <a class="menu-link" {{ ($sw)? 'href='.url('subcripcion/subcripcion').'' : 'onclick=verificar()' }} >
                        <span class="menu-icon">
                            <i class="fa-solid fa-book-bookmark"></i>
                        </span>
                        <span class="menu-title" {{ Request::is('subcripcion/subcripcion') ? "style=color:orange" : 'style=color:white' }}>SUSCRIPCION</span>
                    </a>
                    <!--end:Menu link-->
                </div>

                <div class="menu-item">
                    <!--begin:Menu link-->
                    {{-- <a class="menu-link" href="{{ ($sw)? url('vendedor/inicio') : 'javascript:void(0)' }}"> --}}
                    <a class="menu-link" {{ ($sw)? 'href='.url('vendedor/inicio').'' : 'onclick=verificar()' }} >
                        <span class="menu-icon">
                            <i class="fa-solid fa-chart-simple"></i>
                        </span>
                        <span class="menu-title" {{ Request::is('vendedor/inicio') ? "style=color:orange" : 'style=color:white' }}>PANEL INFORMATIVO</span>
                    </a>
                    <!--end:Menu link-->
                </div>
            @endif

            @if (session('rol') === 2)
                {{--  @dd(
                    $sw,
                    $rol,
                    $persona->nombres,
                    $persona->apellido_materno,
                    $persona->razon_social,
                    $persona->direccion,
                    $persona->celular,
                    $persona->nombres  === null,w
                    $persona->apellido_materno  === null,
                    $persona->razon_social  === null,
                    $persona->direccion  === null,
                    $persona->celular  === null,
                    $persona->nombres  === '',
                    $persona->apellido_materno  === '',
                    $persona->razon_social  === '',
                    $persona->direccion  === '',
                    $persona->celular  === ''
                    // is_null($persona->nombres),
                    // is_null($persona->apellido_materno),
                    // is_null($persona->razon_social),
                    // is_null($persona->direccion),
                    // is_null($persona->celular),
                    // empty($persona->nombres),
                    // empty($persona->apellido_materno),
                    // empty($persona->razon_social),
                    // empty($persona->direccion),
                    // empty($persona->celular),
                    // (isset($persona->razon_social) || trim($persona->razon_social) === ''),
                    // (isset($persona->direccion) || trim($persona->direccion) === '')
                    )  --}}
                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="text-white">COMPRADOR</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <div class="menu-item">
                    <!--begin:Menu link-->
                    {{-- <a class="menu-link" href="{{ ($sw)? url('persona/perfil') : 'javascript:void(0)' }}"> --}}
                    <a class="menu-link" {{ ($sw)? 'href='.url('persona/perfil').'' : 'onclick=verificar()' }} >
                        <span class="menu-icon">
                            {{-- <i class="ki-duotone ki-rocket fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i> --}}
                            <i class="fa-solid fa-house"></i>
                        </span>
                        <span class="menu-title" {{ Request::is('persona/perfil') ? "style=color:orange" : 'style=color:white' }}>PERFIL</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <div class="menu-item">
                    <!--begin:Menu link-->
                    {{-- <a class="menu-link" href="{{ ($sw)? url('persona/pedido') : 'javascript:void(0)' }}"> --}}
                    <a class="menu-link" {{ ($sw)? 'href='.url('persona/pedido').'' : 'onclick=verificar()' }} >
                        <span class="menu-icon">
                            {{-- <i class="ki-duotone ki-rocket fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i> --}}
                            <i class="fa-regular fa-rectangle-list"></i>
                        </span>
                        <span class="menu-title" {{ Request::is('persona/pedido') ? "style=color:orange" : 'style=color:white' }}>PEDIDOS</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
            @endif

            <div class="menu-item">
                <!--begin:Menu link-->
                @php
                    $u = session('perfil')->usuario;
                    $p = session('perfil')->contrasena;
                @endphp
                <a class="menu-link" href="https://comercio-latino.com/services_landing_esp/postSesion2.php?correo={{ $u }}&contrasena={{ $p }}">
                    <span class="menu-icon">
                        {{-- <i class="ki-duotone ki-rocket fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i> --}}
                        <i class="fa-solid fa-bag-shopping"></i>
                    </span>
                    <span class="menu-title text-white">IR A LA TIENDA</span>
                </a>
                <!--end:Menu link-->
            </div>
            <div class="menu-item">
                <!--begin:Menu link-->
                {{-- <a class="menu-link" href="https://comercio-latino.com/services_landing/cerrarsesion.php"> --}}
                {{-- <a class="menu-link" id="enlaceCerrarSesion" href="#"> --}}
                <a class="menu-link" href="https://comercio-latino.com/services_landing_esp/cerrarsesion.php">
                    <span class="menu-icon">
                        {{-- <i class="ki-duotone ki-rocket fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i> --}}
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </span>
                    <span class="menu-title text-white">CERRAR SESION</span>
                </a>
                <!--end:Menu link-->
            </div>

            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <div class="menu-sub menu-sub-accordion">
                </div>
            </div>
        </div>
    </div>
</div>
