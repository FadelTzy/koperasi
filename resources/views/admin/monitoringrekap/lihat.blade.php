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
            <div class="breadcrumb-title pe-3">Manajemen Monitoring Perkuliahan</div>
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
                <h6 class="mb-0 text-uppercase">Rekap Data Monitoring </h6>
            </div>
            <div>
                <button type="button" id="printbtn" class="btn btn-sm btn-primary">Print <i
                        class="bx bx-folder-plus"></i></button>
            </div>
        </div>

        <hr />
        <div class="card">
            <div class="card-body">
                <div style="vertical-align: bottom">
                    <div class="row">
                        <div class="col-md-3">
                            @php $ped = DB::table('periodes')->get() @endphp
                            <select id="periodeval" name="periode" class="form-control single-select" id="">
                                <option value="0">Pilih Periode</option>
                                @foreach ($ped as $item)
                                    <option @if ($item->status == 1) 'selected' @endif value="{{ $item->id }}">
                                        {{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if (Auth::user()->hasRole('mahasiswa'))
                            <div class="col-md-3">
                                @php $kel = DB::table('mata_kuliahs')->get() @endphp
                                <select id="matkulval" name="matkul" class="form-control single-select">
                                    <option selected value="0" disable>Pilih Matkul</option>
                                    @foreach ($kel as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->nama_matkul }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <input id="matkulval" type="hidden" value="0">
                        @endif
                        @if (Auth::user()->hasRole('pimpinan') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('dosen'))
                            <div class="col-md-3">
                                @php $kel = DB::table('kelas')->get() @endphp
                                <select id="kelasval" name="kelas" class="form-control single-select">
                                    <option selected value="0" disable>Pilih Kelas</option>
                                    @foreach ($kel as $item)
                                        <option @if ($item->id_keti == Auth::user()->no_identitas) 'selected' @endif
                                            value="{{ $item->id }}">
                                            {{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <input id="kelasval" type="hidden" value="0">
                        @endif
                        @if (Auth::user()->hasRole('pimpinan') || Auth::user()->hasRole('admin'))
                            <div class="col-md-3">

                                <select id="dosenval" name="dosen" class="form-control single-select">
                                    <option selected value="0" disable>Pilih Dosen</option>
                                    @foreach ($dosen as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <input id="dosenval" type="hidden" value="0">
                        @endif

                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-8">

                                    <select name="status" id="statusval" class="form-control single-select">
                                        <option selected value="9" disable>Status
                                        <option value="0">Menunggu</option>
                                        <option value="1">Disetujui</option>
                                        <option value="2">Ditolak</option>

                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="inputState2" class="form-label"></label>

                                    <button id="buttonval" class="btn btn-sm btn-primary">Filter</button>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <br>
                <div class="table-responsive">
                    <table id="example" class="table table-hover table-bordered" style="width:100%">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Mata Kuliah</th>
                                <th>Kelas</th>
                                <th>Tanggal</th>
                                <th>Dosen</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>


                    </table>
                </div>
            </div>
        </div>
        <hr>

        <div class="modal fade" id="exampleLargeModalu" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Perkuliahan </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                <h6>Jam Masuk</h6> <span id="jammasuk">12:90</span>
                            </div>
                            <div class="col-md-3">
                                <h6>Jam Pulang</h6> <span id="jampulang">12:90</span>
                            </div>
                            <div class="col-md-3">
                                <h6>Status Belajar</h6> <span id="statusbelajar">12:90</span>
                            </div>
                            <div class="col-md-3">
                                <h6>Jumlah Hadir</h6> <span id="jumlahhadir"></span>
                            </div>
                            <div class="col-md-3">
                                <h6>Pertemuan</h6> <span id="pertemuan"></span>
                            </div>
                            <div class="col-md-9">
                                <h6>Keterangan</h6> <span id="keterangan"></span>
                            </div>
                            <br>
                            <div class="col-md-12">
                                <h6>Foto Dokumentasi</h6>

                                <div id="dokumentasi"></div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('js')
        <!--notification js -->
        <script src="{{ asset('v/assets/plugins/notifications/js/lobibox.min.js') }}"></script>
        <script src="{{ asset('v/assets/plugins/notifications/js/notifications.min.js') }}"></script>
        <script src="{{ asset('v/assets/plugins/notifications/js/notification-custom-script.js') }}"></script>
        <script src="{{ asset('v/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('v/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('v/assets/plugins/select2/js/select2.min.js') }}"></script>
        <script
                src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ">
        </script>
        <script>
            var url = window.location.origin;

            $("#printbtn").on('click', function() {
                var setstatus = $("#statusval").val();
                var setkelas = $('#kelasval').val();
                var setmatkul = $('#matkulval').val();

                var setperiode = $('#periodeval').val();
                var setdosen = $('#dosenval').val();
                var urlprint = url + '/monitoring/print?';

                if (setstatus != 9) {
                    urlprint = urlprint + 'status=' + setstatus + '&';
                }
                if (setkelas != 0) {
                    urlprint = urlprint + 'kelas=' + setkelas + '&';
                }
                if (setdosen != 0) {
                    urlprint = urlprint + 'dosen=' + setdosen + '&';
                }
                if (setperiode != 0) {
                    urlprint = urlprint + 'periode=' + setperiode + '&';
                }
                if (setmatkul != 0) {
                    urlprint = urlprint + 'matkul=' + setmatkul + '&';
                }
                window.open(urlprint, "_blank");
            });
            jQuery(document).ready(function() {

                tabel = $("#example").DataTable({
                    columnDefs: [{
                            targets: 0,
                            width: "1%",
                        },
                        {
                            targets: 1,
                            width: "10%",
                        },
                        {
                            orderable: false,
                            targets: 2,
                            width: "30%",
                        },
                        {
                            orderable: false,

                            targets: 3,
                            width: "15%",

                        },
                        {
                            orderable: false,

                            targets: 4,
                            width: "20%",

                        },
                        {
                            orderable: false,

                            targets: 5,
                            width: "5%",

                        },
                        {
                            orderable: false,

                            targets: 6,
                            width: "20%",

                        },

                    ],
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('monitoring.rekap') }}",
                        data: function(d) {
                            d.status = $('#statusval').val(),
                                d.kelas = $('#kelasval').val(),
                                d.periode = $('#periodeval').val(),
                                d.matkul = $('#matkulval').val(),

                                d.dosen = $('#dosenval').val()

                        }
                    },
                    columns: [{
                            nama: 'DT_RowIndex',
                            data: 'DT_RowIndex',
                            orderable: false,
                            searchable: false,
                            class: 'text-center'
                        }, {
                            nama: 'nama_matkul',
                            data: 'nama_matkul'
                        },
                        {
                            nama: 'nama_kelas',
                            data: 'nama_kelas'
                        },
                        {
                            nama: 'tanggal',
                            data: 'tanggal'
                        },
                        {
                            nama: 'nama_dosen',
                            data: 'nama_dosen'
                        },
                        {
                            nama: 'status',
                            data: 'status'
                        },
                        {
                            name: 'aksi',
                            data: 'aksi',
                        }
                    ],

                });
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function staffdel(id) {
                data = confirm("Klik Ok Untuk Melanjutkan");
                if (data) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.LoadingOverlay("show");

                    $.ajax({
                        url: url + '/monitoring/' + id,
                        type: "delete",
                        success: function(e) {
                            $.LoadingOverlay("hide");
                            if (e == 'success') {
                                round_success_noti('Berhasil menghapus data');

                                tabel.ajax.reload();

                            } else {

                                round_error_noti('Gagal menghapus data');
                            }

                        }
                    })

                }
            }

            function staffkonfirm(id, tipe) {
                console.log(tipe)
                data = confirm("Klik Ok Untuk Melanjutkan");
                if (data) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.LoadingOverlay("show");

                    $.ajax({
                        url: url + '/monitoring/konfirm',
                        type: "post",
                        data: {
                            id: id,
                            tipe: tipe
                        },
                        success: function(e) {
                            $.LoadingOverlay("hide");
                            if (e == 'success') {
                                round_success_noti('Berhasil mengubah data');

                                tabel.ajax.reload();

                            } else {

                                round_error_noti('Gagal mengubah data');
                            }

                        }
                    })

                }
            }
            $("#buttonval").on('click', function(id) {
                tabel.draw();
            })
            $("#submitbtn").on('click', function() {
                $("#tambahdata").trigger('submit');
            });

            $("#tambahdata").on('submit', function(id) {
                id.preventDefault();
                var data = $(this).serialize();
                $.LoadingOverlay("show");
                $.ajax({
                    url: '{{ route('matkul.store') }}',
                    data: new FormData(this),
                    type: "POST",
                    contentType: false,
                    processData: false,
                    success: function(id) {
                        console.log(id);
                        $.LoadingOverlay("hide");
                        $("#tambahdata").trigger('reset');
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

            $("#periodeval").val("{{ $idp->id }}").trigger('change');

            function staffupd(id) {
                $('#exampleLargeModalu').modal('show');
                console.log(id.bukti);
                $("#jammasuk").html(id.jam_awal);
                $("#jampulang").html(id.jam_akhir);
                $("#jumlahhadir").html(id.jml_hadir);
                $("#pertemuan").html(id.pertemuan);
                $("#keterangan").html(id.keterangan);
                var gambar = `<img src='${url + "/gambar/bukti/" + id.bukti}'/>`;
                $("#dokumentasi").html(gambar);
                if (id.status_belajar == 1) {
                    $("#statusbelajar").html('Luring');

                } else {
                    $("#statusbelajar").html('During');

                }


                // Demo Button Events

            }
        </script>
    @endpush
