@extends('base')
@section('css')
    <link rel="stylesheet" href="{{ asset('v/assets/plugins/notifications/css/lobibox.min.css') }}" />
    <link href="{{ asset('v/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('v/assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Profil User</div>
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

        <div style="vertical-align: bottom" class="d-flex justify-content-between">
            <div>
                <h6 class="mb-0 text-uppercase"> Profil </h6>
            </div>
            <div>

            </div>
        </div>

        <hr />
        <div class="card">
            <div class="card-body">
                <form id="tambahdata" class="row g-3">
                    @csrf



                    <div id="" class="col-md-6">
                        <label for="inputState" class="form-label">Nama </label>
                        <input type="text" class="form-control" name="nama" value="{{ Auth::user()->name }}">
                    </div>
                    <div id="" class="col-md-6">
                        <label for="inputState" class="form-label">Username (login) </label>
                        <input type="text" class="form-control" name="username" value="{{ Auth::user()->username }}">
                    </div>
                    @if (Auth::user()->role == 3)
                        <div id="" class="col-md-6">
                            <label for="inputState" class="form-label">Kode Anggota</label>
                            <input type="text" value="{{ Auth::user()->kode }}" class="form-control" disabled>
                        </div>
                    @endif


                    <div id="" class="col-md-6">
                        <label for="inputState" class="form-label">Email</label>
                        <input type="text" value="{{ Auth::user()->email }}" class="form-control" name="email">
                    </div>
                    @if (Auth::user()->role == 3)
                        <div id="" class="col-md-6">
                            <label for="inputState" class="form-label">No </label>
                            <input type="text" class="form-control" name="no"
                                value="{{ Auth::user()->detail->nohp }}">
                        </div>
                        <div id="" class="col-md-6">
                            <label for="inputState" class="form-label">Alamat</label>
                            <input type="text" value="{{ Auth::user()->detail->alamat }}" class="form-control"
                                name="alamat">
                        </div>
                    @endif
                    <div id="" class="col-md-6">
                        <label for="inputState" class="form-label">Set Password Baru</label>
                        <input type="text" class="form-control" name="password">
                    </div>
                    <button id="submitbtn" type="button" class="btn btn-sm btn-primary">Simpan</button>
                </form>
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

    <script src="{{ asset('v/assets/plugins/select2/js/select2.min.js') }}"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ">
    </script>
    <script>
        jQuery(document).ready(function() {
            $("#matkul").on('change', function(param) {
                val = $(this).val();
                var matkularr = val.split(',');

                $("#dosen").select2().val(matkularr[1]).trigger("change");

            })
            $("input[name='sp']").on('click', function() {
                if ($("#daring").is(':checked')) {
                    $("#colruangan").addClass('d-none');
                }
                if ($("#luring").is(':checked')) {
                    $("#colruangan").removeClass('d-none');
                }
            })


        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var url = window.location.origin;


        $("#submitbtn").on('click', function() {
            $("#tambahdata").trigger('submit');
        });

        $("#tambahdata").on('submit', function(id) {
            id.preventDefault();
            var data = $(this).serialize();
            $.LoadingOverlay("show");
            $.ajax({
                url: '{{ route('profil.store') }}',
                data: new FormData(this),
                type: "POST",
                contentType: false,
                processData: false,
                success: function(id) {
                    console.log(id);
                    $.LoadingOverlay("hide");
                    // $("#tambahdata").trigger('reset');
                    if (id.status == 'error') {
                        var data = id.data;
                        var elem;
                        var result = Object.keys(data).map((key) => [data[key]]);
                        elem =
                            '<div><ul>';
                        result.forEach(function(data) {
                            elem += '<li>' + data[0][0] + '</li>';
                        });
                        elem += '</ul></div>';
                        $("#listnotif").html(elem);
                        $("#listnotif").addClass('mt-2');
                        console.log(elem)
                        round_error_noti(elem);
                    } else {
                        $('#exampleLargeModal').modal('hide');
                        round_success_noti();

                        tabel.ajax.reload();

                    }
                }
            })


        })
        $("#submitbtnu").on('click', function() {
            $("#editdata").trigger('submit');
        });

        $("#editdata").on('submit', function(id) {
            id.preventDefault();
            var data = $(this).serialize();
            $.LoadingOverlay("show");
            $.ajax({
                url: '{{ url('matkul/edit') }}',
                data: new FormData(this),
                type: "POST",
                contentType: false,
                processData: false,
                success: function(id) {
                    $('#exampleLargeModalu').modal('hide');
                    $.LoadingOverlay("hide");
                    if (id.status == 'error') {
                        var data = id.data;
                        var elem;
                        var result = Object.keys(data).map((key) => [data[key]]);
                        elem =
                            '<div ><u>';
                        elem +=
                            '   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span> </button><ul>';
                        result.forEach(function(data) {
                            elem += '<li>' + data[0][0] + '</li>';
                        });
                        elem += '</ul></div>';
                        $("#listnotif").html(elem);
                        $("#listnotif").addClass('mt-2');
                        round_error_noti(elem);

                    } else {
                        round_success_noti();

                        tabel.ajax.reload();

                    }
                }
            })


        })
        $('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });

        function staffupd(id) {
            $('#exampleLargeModalu').modal('show');

            $("#idu").val(id.id);
            $("#kodeu").val(id.kode_matkul);
            $("#matkulu").val(id.nama_matkul);

            $("#sksu").val(id.sks);
            var jam = id.jam.split(' - ');
            $("#jam_awalu").val(jam[0]);
            $("#jam_akhiru").val(jam[1]);

            $('#dosenu option[value=' + id.dosen + ']').attr('selected', 'selected');
            $('#mitrau option[value=' + id.mitra + ']').attr('selected', 'selected');
            $('#hariu option[value=' + id.hari + ']').attr('selected', 'selected');

            // Demo Button Events

        }
    </script>
@endpush
