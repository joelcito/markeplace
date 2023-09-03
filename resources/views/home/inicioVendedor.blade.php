@extends('layouts.app')
@section('css')

@endsection
@section('content')
<!--begin::Content wrapper-->
<div class="d-flex flex-column flex-column-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-xl-stretch mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Producto mas vendido</span>
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
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Chart-->
                    <div id="productos_mas_vendidos" style="height: 350px"></div>
                    <!--end::Chart-->
                </div>
                <!--end::Body-->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!--begin::Charts Widget 2-->
            <div class="card card-xl-stretch mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Pedidos por mes</span>
                    </h3>
                </div>
                <div class="card-body">
                    <div id="pedidos_por_mes" style="height: 350px"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <!--begin::Charts Widget 2-->
            <div class="card card-xl-stretch mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Visualizacion de productos</span>
                    </h3>
                </div>
                <div class="card-body">
                    <div id="visualizacion_por_mes" style="height: 350px"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-md-12">
            <!--begin::Charts Widget 2-->
            <div class="card card-xl-stretch mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Visualización y calificación</span>
                         <span class="text-muted fw-semibold fs-7">More than 500 new orders</span>
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
    </div> --}}
</div>
<!--end::Content wrapper-->
@stop
@section('js')
{{--  <script src="{{ asset('assets/js/custom/widgets.js') }}"></script>  --}}
<script>
    var e = document.getElementById("productos_mas_vendidos");
    if (e) {
        var t = { self: null, rendered: !1 },
            a = function () {
                var a = parseInt(KTUtil.css(e, "height")),
                    o = KTUtil.getCssVariableValue("--bs-gray-500"),
                    r = KTUtil.getCssVariableValue("--bs-gray-200"),
                    s = {
                        series: [
                            {
                                name: "Cantidad Vendido",
                                data: @json($numerosAleatorios),
                            },
                            // {
                            //     name: "Revenue",
                            //     data: [76, 85, 101, 98, 87, 105],
                            // },
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
                            categories: @json($productos),
                            // categories: [
                            //     "Feb",
                            //     "Mar",
                            //     "Apr",
                            //     "May",
                            //     "Jun",
                            //     "Jul",
                            // ],
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
                                    return e + " unidades";
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
                                data: @json($cnatidaMeses),
                            },
                            // {
                            //     name: "Revenue",
                            //     data: [76, 85, 101, 98, 87, 105],
                            // },
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

    var e = document.getElementById("visualizacion_por_mes");
    if (e) {
        var t = { self: null, rendered: !1 },
            a = function () {
                var a = parseInt(KTUtil.css(e, "height")),
                    o = KTUtil.getCssVariableValue("--bs-gray-500"),
                    r = KTUtil.getCssVariableValue("--bs-gray-200"),
                    s = {
                        series: [
                            {
                                name: "Cantidad Visualizacion",
                                data: @json($cantidadViosualizaciones),
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
                            categories: @json($productos1),
                            {{--  categories: [
                                "Feb",
                                "Mar",
                                "Apr",
                                "May",
                                "Jun",
                                "Jul",
                            ],  --}}
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
                                    return e + " Visualizacion";
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

    // var e = document.getElementById("visuallizaciones");
    // if (e) {
    //     var t = { self: null, rendered: !1 },
    //         a = function () {
    //             var a = parseInt(KTUtil.css(e, "height")),
    //                 o = KTUtil.getCssVariableValue("--bs-gray-500"),
    //                 r = KTUtil.getCssVariableValue("--bs-gray-200"),
    //                 s = {
    //                     series: [
    //                         {
    //                             name: ["Cantidad de visualizacion"],
    //                             data: [0, 55, 57, 56, 61, 58,0, 55, 57, 56, 61, 58],
    //                         },
    //                         {
    //                             name: "Cantidad de calificacion",
    //                             data: [76, 85, 101, 98, 87, 105, 76, 85, 101, 98, 87, 105],
    //                         },
    //                     ],
    //                     chart: {
    //                         fontFamily: "inherit",
    //                         type: "bar",
    //                         height: a,
    //                         toolbar: { show: !1 },
    //                     },
    //                     plotOptions: {
    //                         bar: {
    //                             horizontal: !1,
    //                             columnWidth: ["30%"],
    //                             borderRadius: 4,
    //                         },
    //                     },
    //                     legend: { show: !1 },
    //                     dataLabels: { enabled: !1 },
    //                     stroke: {
    //                         show: !0,
    //                         width: 2,
    //                         colors: ["transparent"],
    //                     },
    //                     xaxis: {
    //                         categories: [
    //                             "Ene",
    //                             "Feb",
    //                             "Mar",
    //                             "Abr",
    //                             "May",
    //                             "Jun",
    //                             "Jul",
    //                             "Ago",
    //                             "Set",
    //                             "Oct",
    //                             "Nom",
    //                             "Dic",
    //                         ],
    //                         axisBorder: { show: !1 },
    //                         axisTicks: { show: !1 },
    //                         labels: {
    //                             style: {
    //                                 colors: o,
    //                                 fontSize: "12px",
    //                             },
    //                         },
    //                     },
    //                     yaxis: {
    //                         labels: {
    //                             style: {
    //                                 colors: o,
    //                                 fontSize: "12px",
    //                             },
    //                         },
    //                     },
    //                     fill: { opacity: 1 },
    //                     states: {
    //                         normal: {
    //                             filter: { type: "none", value: 0 },
    //                         },
    //                         hover: {
    //                             filter: { type: "none", value: 0 },
    //                         },
    //                         active: {
    //                             allowMultipleDataPointsSelection:
    //                                 !1,
    //                             filter: { type: "none", value: 0 },
    //                         },
    //                     },
    //                     tooltip: {
    //                         style: { fontSize: "12px" },
    //                         y: {
    //                             formatter: function (e) {
    //                                 {{--  return "$" + e + " thousands";  --}}
    //                                 return e;
    //                             },
    //                         },
    //                     },
    //                     colors: [
    //                         KTUtil.getCssVariableValue(
    //                             "--bs-warning"
    //                         ),
    //                         KTUtil.getCssVariableValue(
    //                             "--bs-gray-300"
    //                         ),
    //                     ],
    //                     grid: {
    //                         borderColor: r,
    //                         strokeDashArray: 4,
    //                         yaxis: { lines: { show: !0 } },
    //                     },
    //                 };
    //             (t.self = new ApexCharts(e, s)),
    //                 t.self.render(),
    //                 (t.rendered = !0);
    //         };
    //     a(),
    //     KTThemeMode.on("kt.thememode.change", function () {
    //         t.rendered && t.self.destroy(), a();
    //     });
    // }


</script>
@endsection
