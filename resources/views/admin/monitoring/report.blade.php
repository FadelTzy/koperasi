@extends('base')
@section('css')
    <link href="{{ asset('v/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('v/assets/plugins/notifications/css/lobibox.min.css') }}" />
    <link href="{{ asset('v/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('v/assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Report Mingguan Monitoring Perkuliahan</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->



        <hr />
        <div class="card">
            <div class="card-body">
                <h6 class="mb-0 text-uppercase">Diagram Report Mingguan</h6>
                <hr />
                <div class="card">
                    <div class="card-body">
                        <div id="chart5"></div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    @endsection
    @push('js')
        <!--notification js -->
        <script src="{{ asset('v/assets/plugins/notifications/js/lobibox.min.js') }}"></script>
        <script src="{{ asset('v/assets/plugins/notifications/js/notifications.min.js') }}"></script>
        <script src="{{ asset('v/assets/plugins/notifications/js/notification-custom-script.js') }}"></script>
        <script src="{{ asset('v/assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
        <script src="{{ asset('v/assets/plugins/apexcharts-bundle/js/apex-custom.js') }}"></script>
        <script src="{{ asset('v/assets/plugins/select2/js/select2.min.js') }}"></script>
        <script
                src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ">
        </script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var keys = '{!! json_encode($keys) !!}';
            var nt = '{!! json_encode($nt) !!}';

            var url = window.location.origin;
            // chart 5
            var options = {
                series: [{
                    data: JSON.parse(nt),
                }],
                chart: {
                    foreColor: '#9ba7b2',
                    type: 'bar',
                    height: 350
                },
                colors: ["#0d6efd"],
                plotOptions: {
                    bar: {
                        horizontal: true,
                        columnWidth: '35%',
                        endingShape: 'rounded'
                    }
                },
                dataLabels: {
                    enabled: false
                },
                xaxis: {
                    categories: JSON.parse(keys),
                }
            };
            var chart = new ApexCharts(document.querySelector("#chart5"), options);
            chart.render();
        </script>
    @endpush
