@extends('layouts.app')
@section('css')

@endsection
@section('content')
<!--begin::Content wrapper-->
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Toolbar-->
    {{--  <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Charts</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Widgets</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Filter menu-->
                <div class="m-0">
                    <!--begin::Menu toggle-->
                    <a href="#" class="btn btn-sm btn-flex bg-body btn-color-gray-700 btn-active-color-primary fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <i class="ki-duotone ki-filter fs-6 text-muted me-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>Filter</a>
                    <!--end::Menu toggle-->
                    <!--begin::Menu 1-->
                    <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_641ac46cc5ca0">
                        <!--begin::Header-->
                        <div class="px-7 py-5">
                            <div class="fs-5 text-dark fw-bold">Filter Options</div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Menu separator-->
                        <div class="separator border-gray-200"></div>
                        <!--end::Menu separator-->
                        <!--begin::Form-->
                        <div class="px-7 py-5">
                            <!--begin::Input group-->
                            <div class="mb-10">
                                <!--begin::Label-->
                                <label class="form-label fw-semibold">Status:</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <div>
                                    <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_641ac46cc5ca0" data-allow-clear="true">
                                        <option></option>
                                        <option value="1">Approved</option>
                                        <option value="2">Pending</option>
                                        <option value="2">In Process</option>
                                        <option value="2">Rejected</option>
                                    </select>
                                </div>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="mb-10">
                                <!--begin::Label-->
                                <label class="form-label fw-semibold">Member Type:</label>
                                <!--end::Label-->
                                <!--begin::Options-->
                                <div class="d-flex">
                                    <!--begin::Options-->
                                    <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                        <span class="form-check-label">Author</span>
                                    </label>
                                    <!--end::Options-->
                                    <!--begin::Options-->
                                    <label class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                        <span class="form-check-label">Customer</span>
                                    </label>
                                    <!--end::Options-->
                                </div>
                                <!--end::Options-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="mb-10">
                                <!--begin::Label-->
                                <label class="form-label fw-semibold">Notifications:</label>
                                <!--end::Label-->
                                <!--begin::Switch-->
                                <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
                                    <label class="form-check-label">Enabled</label>
                                </div>
                                <!--end::Switch-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Actions-->
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                                <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Form-->
                    </div>
                    <!--end::Menu 1-->
                </div>
                <!--end::Filter menu-->
                <!--begin::Secondary button-->
                <!--end::Secondary button-->
                <!--begin::Primary button-->
                <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Create</a>
                <!--end::Primary button-->
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>  --}}
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-xl-stretch mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Catidad de Vendedores y Compradores</span>
                        {{--  <span class="text-muted fw-semibold fs-7">More than 400 new members</span>  --}}
                    </h3>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Menu-->
                        <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <i class="ki-duotone ki-category fs-6">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </button>
                        <!--begin::Menu 1-->
                            {{--  <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_641ac46cc882e">
                                <!--begin::Header-->
                                <div class="px-7 py-5">
                                    <div class="fs-5 text-dark fw-bold">Filter Options</div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Menu separator-->
                                <div class="separator border-gray-200"></div>
                                <!--end::Menu separator-->
                                <!--begin::Form-->
                                <div class="px-7 py-5">
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label fw-semibold">Status:</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <div>
                                            <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_641ac46cc882e" data-allow-clear="true">
                                                <option></option>
                                                <option value="1">Approved</option>
                                                <option value="2">Pending</option>
                                                <option value="2">In Process</option>
                                                <option value="2">Rejected</option>
                                            </select>
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label fw-semibold">Member Type:</label>
                                        <!--end::Label-->
                                        <!--begin::Options-->
                                        <div class="d-flex">
                                            <!--begin::Options-->
                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" type="checkbox" value="1" />
                                                <span class="form-check-label">Author</span>
                                            </label>
                                            <!--end::Options-->
                                            <!--begin::Options-->
                                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                                <span class="form-check-label">Customer</span>
                                            </label>
                                            <!--end::Options-->
                                        </div>
                                        <!--end::Options-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label fw-semibold">Notifications:</label>
                                        <!--end::Label-->
                                        <!--begin::Switch-->
                                        <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
                                            <label class="form-check-label">Enabled</label>
                                        </div>
                                        <!--end::Switch-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="d-flex justify-content-end">
                                        <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                                        <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Form-->
                            </div>  --}}
                        <!--end::Menu 1-->
                        <!--end::Menu-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Chart-->
                    <div id="cantidad_vendedores_compradores" style="height: 350px"></div>
                    <!--end::Chart-->
                </div>
                <!--end::Body-->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-xl-stretch mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Cantidad de productos exhibidos por vendedor</span>
                    </h3>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Menu-->
                        <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <i class="ki-duotone ki-category fs-6">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </button>
                        <!--end::Menu 1-->
                        <!--end::Menu-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <div id="cantidad_exibidos" style="height: 350px"></div>
                </div>
                <!--end::Body-->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-xl-stretch mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Catidad de Vendedores por Subcripcion</span>
                    </h3>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Menu-->
                        <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <i class="ki-duotone ki-category fs-6">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </button>
                        <!--end::Menu 1-->
                        <!--end::Menu-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <center>
                        <div id="kt_docs_google_chart_column" style="height: 350px"></div>
                    </center>
                </div>
                <!--end::Body-->
            </div>
        </div>
    </div>
    {{--  <div class="row">
        <div class="col-md-12">
            <!--begin::Charts Widget 2-->
            <div class="card card-xl-stretch mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Pedidos por mes</span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Chart-->
                    <div id="pedidos_por_mes" style="height: 350px"></div>
                    <!--end::Chart-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Charts Widget 2-->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!--begin::Charts Widget 2-->
            <div class="card card-xl-stretch mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Visualización y calificación</span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Chart-->
                    <div id="visuallizaciones" style="height: 350px"></div>
                    <!--end::Chart-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Charts Widget 2-->
        </div>
    </div>  --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card card-xl-stretch mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Ventas Alcanzadas por mes</span>
                        {{--  <span class="text-muted fw-semibold fs-7">More than 1000 new records</span>  --}}
                    </h3>
                    {{--  <!--begin::Toolbar-->
                    <div class="card-toolbar" data-kt-buttons="true">
                        <a class="btn btn-sm btn-color-muted btn-active btn-active-primary active px-4 me-1" id="kt_charts_widget_3_year_btn">Year</a>
                        <a class="btn btn-sm btn-color-muted btn-active btn-active-primary px-4 me-1" id="kt_charts_widget_3_month_btn">Month</a>
                        <a class="btn btn-sm btn-color-muted btn-active btn-active-primary px-4" id="kt_charts_widget_3_week_btn">Week</a>
                    </div>
                    <!--end::Toolbar-->  --}}
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Chart-->
                    <div id="kt_charts_widget_3_chart" style="height: 350px"></div>
                    <!--end::Chart-->
                </div>
                <!--end::Body-->
            </div>
        </div>
    </div>
</div>
<!--end::Content wrapper-->
@stop
@section('js')
{{--  <script src="{{ asset('assets/js/custom/widgets.js') }}"></script>  --}}
<script src="//www.google.com/jsapi"></script>
<script>
    var e = document.getElementById("cantidad_vendedores_compradores");
    if (e) {
        var t = { self: null, rendered: !1 },
            a = function () {
                var a = parseInt(KTUtil.css(e, "height")),
                    o = KTUtil.getCssVariableValue("--bs-gray-500"),
                    r = KTUtil.getCssVariableValue("--bs-gray-200"),
                    s = {
                        series: [
                            {
                                name: "Cantidad de Vendedores",
                                {{--  data: @json($numerosAleatorios),  --}}
                                data: [105,95,83, 72, 61, 58, 100,105,95,83, 72, 61],
                            },
                            {
                                name: "Cantidad de Compradores",
                                data: [76, 85, 101, 98, 87, 105, 61, 58, 100,105,95,83],
                            },
                        ],
                        chart: {
                            fontFamily: "inherit",
                            type: "bar",
                            height: a,
                            toolbar: { show: !1 },
                        },
                        plotOptions: {
                            bar: {
                                horizontal: !1,
                                columnWidth: ["30%"],
                                borderRadius: [10],
                            },
                        },
                        legend: { show: !1 },
                        dataLabels: { enabled: !1 },
                        stroke: {
                            show: !0,
                            width: 2,
                            colors: ["transparent"],
                        },
                        xaxis: {
                            {{--  categories: @json($productos),  --}}
                            categories: [
                                "Enero",
                                "Febrero",
                                "Marzo",
                                "Abril",
                                "Mayo",
                                "Junio",
                                "Julio",
                                "Agosto",
                                "Septiembre",
                                "Octubre",
                                "Noviembre",
                                "Diciembre"
                            ],
                            axisBorder: { show: !1 },
                            axisTicks: { show: !1 },
                            labels: {
                                style: {
                                    colors: o,
                                    fontSize: "12px",
                                },
                            },
                        },
                        yaxis: {
                            labels: {
                                style: {
                                    colors: o,
                                    fontSize: "12px",
                                },
                            },
                        },
                        fill: { opacity: 1 },
                        states: {
                            normal: {
                                filter: { type: "none", value: 0 },
                            },
                            hover: {
                                filter: { type: "none", value: 0 },
                            },
                            active: {
                                allowMultipleDataPointsSelection:
                                    !1,
                                filter: { type: "none", value: 0 },
                            },
                        },
                        tooltip: {
                            style: { fontSize: "12px" },
                            y: {
                                formatter: function (e) {
                                    {{--  return "$" + e + " thousands";  --}}
                                    {{--  return e + " unidades";  --}}
                                    return e;
                                },
                            },
                        },
                        colors: [
                            KTUtil.getCssVariableValue(
                                "--bs-primary"
                            ),
                            KTUtil.getCssVariableValue(
                                "--bs-gray-300"
                            ),
                        ],
                        grid: {
                            borderColor: r,
                            strokeDashArray: 4,
                            yaxis: { lines: { show: !0 } },
                        },
                    };
                (t.self = new ApexCharts(e, s)),
                    t.self.render(),
                    (t.rendered = !0);
            };
        a(),
        KTThemeMode.on("kt.thememode.change", function () {
            t.rendered && t.self.destroy(), a();
        });
    }

    var e = document.getElementById("pedidos_por_mes");
    if (e) {
        var t = { self: null, rendered: !1 },
            a = function () {
                var a = parseInt(KTUtil.css(e, "height")),
                    o = KTUtil.getCssVariableValue("--bs-gray-500"),
                    r = KTUtil.getCssVariableValue("--bs-gray-200"),
                    s = {
                        series: [
                            {
                                name: ["Son"],
                                data: [0, 55, 57, 56, 61, 58,0, 55, 57, 56, 61, 58],
                            },
                            {{--  {
                                name: "Revenue",
                                data: [76, 85, 101, 98, 87, 105],
                            },  --}}
                        ],
                        chart: {
                            fontFamily: "inherit",
                            type: "bar",
                            height: a,
                            toolbar: { show: !1 },
                        },
                        plotOptions: {
                            bar: {
                                horizontal: !1,
                                columnWidth: ["30%"],
                                borderRadius: 4,
                            },
                        },
                        legend: { show: !1 },
                        dataLabels: { enabled: !1 },
                        stroke: {
                            show: !0,
                            width: 2,
                            colors: ["transparent"],
                        },
                        xaxis: {
                            categories: [
                                "Ene",
                                "Feb",
                                "Mar",
                                "Abr",
                                "May",
                                "Jun",
                                "Jul",
                                "Ago",
                                "Set",
                                "Oct",
                                "Nom",
                                "Dic",
                            ],
                            axisBorder: { show: !1 },
                            axisTicks: { show: !1 },
                            labels: {
                                style: {
                                    colors: o,
                                    fontSize: "12px",
                                },
                            },
                        },
                        yaxis: {
                            labels: {
                                style: {
                                    colors: o,
                                    fontSize: "12px",
                                },
                            },
                        },
                        fill: { opacity: 1 },
                        states: {
                            normal: {
                                filter: { type: "none", value: 0 },
                            },
                            hover: {
                                filter: { type: "none", value: 0 },
                            },
                            active: {
                                allowMultipleDataPointsSelection:
                                    !1,
                                filter: { type: "none", value: 0 },
                            },
                        },
                        tooltip: {
                            style: { fontSize: "12px" },
                            y: {
                                formatter: function (e) {
                                    {{--  return "$" + e + " thousands";  --}}
                                    return e + " Pedidos";
                                },
                            },
                        },
                        colors: [
                            KTUtil.getCssVariableValue(
                                "--bs-warning"
                            ),
                            KTUtil.getCssVariableValue(
                                "--bs-gray-300"
                            ),
                        ],
                        grid: {
                            borderColor: r,
                            strokeDashArray: 4,
                            yaxis: { lines: { show: !0 } },
                        },
                    };
                (t.self = new ApexCharts(e, s)),
                    t.self.render(),
                    (t.rendered = !0);
            };
        a(),
            KTThemeMode.on("kt.thememode.change", function () {
                t.rendered && t.self.destroy(), a();
            });
    }

    var e = document.getElementById("kt_charts_widget_3_chart");
    if (e) {
        var t = { self: null, rendered: !1 },
            a = function () {
                parseInt(KTUtil.css(e, "height"));
                var a = KTUtil.getCssVariableValue("--bs-gray-500"),
                    o = KTUtil.getCssVariableValue("--bs-gray-200"),
                    r = KTUtil.getCssVariableValue("--bs-info"),
                    s = {
                        series: [
                            {
                                name: "Monto de Venta",
                                data: [30, 40, 40, 90, 90, 70, 70,20,50,18,80,10],
                            },
                        ],
                        chart: {
                            fontFamily: "inherit",
                            type: "area",
                            height: 350,
                            toolbar: { show: !1 },
                        },
                        plotOptions: {},
                        legend: { show: !1 },
                        dataLabels: { enabled: !1 },
                        fill: { type: "solid", opacity: 1 },
                        stroke: {
                            curve: "smooth",
                            show: !0,
                            width: 3,
                            colors: [r],
                        },
                        xaxis: {
                            categories: [
                                "Ene",
                                "Feb",
                                "Mar",
                                "Abr",
                                "May",
                                "Jun",
                                "Jul",
                                "Aug",
                                "Set",
                                "Oct",
                                "Nom",
                                "Dic",
                            ],
                            axisBorder: { show: !1 },
                            axisTicks: { show: !1 },
                            labels: {
                                style: {
                                    colors: a,
                                    fontSize: "12px",
                                },
                            },
                            crosshairs: {
                                position: "front",
                                stroke: {
                                    color: r,
                                    width: 1,
                                    dashArray: 3,
                                },
                            },
                            tooltip: {
                                enabled: !0,
                                formatter: void 0,
                                offsetY: 0,
                                style: { fontSize: "12px" },
                            },
                        },
                        yaxis: {
                            labels: {
                                style: {
                                    colors: a,
                                    fontSize: "12px",
                                },
                            },
                        },
                        states: {
                            normal: {
                                filter: { type: "none", value: 0 },
                            },
                            hover: {
                                filter: { type: "none", value: 0 },
                            },
                            active: {
                                allowMultipleDataPointsSelection:
                                    !1,
                                filter: { type: "none", value: 0 },
                            },
                        },
                        tooltip: {
                            style: { fontSize: "12px" },
                            y: {
                                formatter: function (e) {
                                    {{--  return "$" + e + " thousands";  --}}
                                    return e + " Bs.";
                                },
                            },
                        },
                        colors: [
                            KTUtil.getCssVariableValue(
                                "--bs-info-light"
                            ),
                        ],
                        grid: {
                            borderColor: o,
                            strokeDashArray: 4,
                            yaxis: { lines: { show: !0 } },
                        },
                        markers: { strokeColor: r, strokeWidth: 3 },
                    };
                (t.self = new ApexCharts(e, s)),
                    t.self.render(),
                    (t.rendered = !0);
            };
        a(),
            KTThemeMode.on("kt.thememode.change", function () {
                t.rendered && t.self.destroy(), a();
            });
    }

    var e = document.getElementById("cantidad_exibidos");
    if (e) {
        var t = { self: null, rendered: !1 },
            a = function () {
                var a = parseInt(KTUtil.css(e, "height")),
                    o = KTUtil.getCssVariableValue("--bs-gray-500"),
                    r = KTUtil.getCssVariableValue("--bs-gray-200"),
                    s = {
                        series: [
                            {
                                name: ["Cantidad de visualizacion"],
                                data: [0, 55, 57, 56, 61, 58,10, 55, 57, 56, 61, 58],
                            },
                            /*
                            {
                                name: "Cantidad de calificacion",
                                data: [76, 85, 101, 98, 87, 105, 76, 85, 101, 98, 87, 105],
                            },
                            */
                        ],
                        chart: {
                            fontFamily: "inherit",
                            type: "bar",
                            height: a,
                            toolbar: { show: !1 },
                        },
                        plotOptions: {
                            bar: {
                                horizontal: !1,
                                columnWidth: ["30%"],
                                borderRadius: 4,
                            },
                        },
                        legend: { show: !1 },
                        dataLabels: { enabled: !1 },
                        stroke: {
                            show: !0,
                            width: 2,
                            colors: ["transparent"],
                        },
                        xaxis: {
                            categories: [
                                "Ene",
                                "Feb",
                                "Mar",
                                "Abr",
                                "May",
                                "Jun",
                                "Jul",
                                "Ago",
                                "Set",
                                "Oct",
                                "Nom",
                                "Dic",
                            ],
                            axisBorder: {
                                {{--  show: !1  --}}
                                show: true,
                                color: KTUtil.getCssVariableValue("--bs-gray-500"),
                                height: 1,
                                width: '100%',
                                offsetX: 0,
                                offsetY: 0
                            },
                            axisTicks: { show: !1 },
                            labels: {
                                style: {
                                    colors: o,
                                    fontSize: "12px",
                                },
                            },
                        },
                        yaxis: {
                            labels: {
                                style: {
                                    colors: o,
                                    fontSize: "12px",
                                },
                            },
                        },
                        fill: { opacity: 1 },
                        states: {
                            normal: {
                                filter: { type: "none", value: 0 },
                            },
                            hover: {
                                filter: { type: "none", value: 0 },
                            },
                            active: {
                                allowMultipleDataPointsSelection:
                                    !1,
                                filter: { type: "none", value: 0 },
                            },
                        },
                        tooltip: {
                            style: { fontSize: "12px" },
                            y: {
                                formatter: function (e) {
                                    {{--  return "$" + e + " thousands";  --}}
                                    return e;
                                },
                            },
                        },
                        colors: [
                            KTUtil.getCssVariableValue(
                                "--bs-warning"
                            ),
                            KTUtil.getCssVariableValue(
                                "--bs-gray-300"
                            ),
                        ],
                        grid: {
                            borderColor: r,
                            strokeDashArray: 4,
                            yaxis: { lines: { show: !0 } },
                        },
                    };
                (t.self = new ApexCharts(e, s)),
                    t.self.render(),
                    (t.rendered = !0);
            };
        a(),
        KTThemeMode.on("kt.thememode.change", function () {
            t.rendered && t.self.destroy(), a();
        });
    }

    // GOOGLE CHARTS INIT
    google.load('visualization', '1', {
        packages: ['corechart', 'bar', 'line']
    });

    google.setOnLoadCallback(function () {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Basica', 20],
            ['Estandar', 10],
            ['Premiun', 6],
        ]);

        var options = {
            //title: 'My Daily Activities',
            colors: ['#fe3995', '#f6aa33', '#6e4ff5', '#2abe81', '#c7d2e7', '#593ae1']
        };

        var chart = new google.visualization.PieChart(document.getElementById('kt_docs_google_chart_column'));
        chart.draw(data, options);
    });


</script>
@endsection
