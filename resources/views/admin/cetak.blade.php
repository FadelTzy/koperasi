@extends('base')
@section('css')
    <link rel="stylesheet" href="{{ asset('v/assets/plugins/notifications/css/lobibox.min.css') }}" />
@endsection
@section('content')
    <div class="page-content">
        <!--breadcrumb-->

        <!--end breadcrumb-->

        <div style="vertical-align: bottom">
            <div>
                <h6 class="mb-0 ">Cetak </h6>
            </div>

        </div>

        <hr />
        <div class="card">
            <div class="card-body">
                <div class="border p-4 rounded">
                    <div class="row row-cols-1 row-cols-md-3 row-cols-xl-5">
                        <div class="col">
                            <div class="card radius-10">
                                <div class="card-body">
                                    <div class="text-center">
                                        <div
                                            class="widgets-icons rounded-circle mx-auto bg-light-primary text-primary mb-3">
                                            <i class="bx  bx-printer"></i>
                                        </div>
                                        <h4 class="my-1">Cetak SPP</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card radius-10">
                                <div class="card-body">
                                    <div class="text-center">
                                        <div class="widgets-icons rounded-circle mx-auto bg-light-danger text-danger mb-3">
                                            <i class="bx  bx-printer"></i>
                                        </div>
                                        <h4 class="my-1">Cetak SPM</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card radius-10">
                                <div class="card-body">
                                    <div class="text-center">
                                        <div class="widgets-icons rounded-circle mx-auto bg-light-info text-info mb-3"><i
                                                class="bx bx-printer"></i>
                                        </div>
                                        <h4 class="my-1">Cetak SP2D</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
@endsection
@push('js')
    <!--notification js -->
    <script src="{{ asset('v/assets/plugins/notifications/js/lobibox.min.js') }}"></script>
    <script src="{{ asset('v/assets/plugins/notifications/js/notifications.min.js') }}"></script>
    <script src="{{ asset('v/assets/plugins/notifications/js/notification-custom-script.js') }}"></script>

    <script
        src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ">
    </script>
@endpush
