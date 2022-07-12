@extends('base')
@section('css')
    <link href="{{ asset('v/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('v/assets/plugins/notifications/css/lobibox.min.css') }}" />
@endsection
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Data Penarikan Simpanan</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Data Penarikan </li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="modal fade" id="exampleLargeModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pengajuan </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form id="tambahdata" class=" form-horizontal form-bordered">
                            @csrf
                            <input type="hidden" name="id" value="{{ $dataa->id }}">

                            <label class="form-label">Tanggal Penarikan</label>
                            <div class="input-group">
                                <input type="text" readonly value="{{ $date }}" name="tanggal"
                                    placeholder="Input Tanggal" class="form-control" />

                            </div><!-- input-group -->
                            <br>
                            <label for="nomor" class="form-label">Jumlah Simpanan</label>
                            <div class="input-group">
                                <input type="text" name="simpanan" id="simpanan" readonly
                                    value="{{ $detail->simpanan }}" class="form-control" />
                            </div><!-- input-group -->
                            <br>
                            <label class="form-label">Jumlah Penarikan</label>
                            <div class="input-group">
                                <input type="number" id="penarikan" name="penarikan" placeholder="Input jumlah"
                                    class="form-control" />
                            </div><!-- input-group -->
                            <br>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button id="submitbtn" type="button" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleLargeModalu" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form id="editdata" class=" form-horizontal form-bordered">
                            @csrf
                            <input type="hidden" name="id" id="idu">
                            <label class="form-label">Kode Simpanan</label>
                            <div class="input-group">
                                <input type="text" name="kode" id="kodeu" placeholder="Input kode"
                                    class="form-control" />

                            </div><!-- input-group -->

                            <br>
                            <label class="form-label">Nama</label>
                            <div class="input-group">
                                <input type="text" id="namau" name="nama" placeholder="Input Nama"
                                    class="form-control" />

                            </div><!-- input-group -->

                            <br>
                            <label class="form-label">Jumlah Simpanan</label>
                            <div class="input-group">
                                <input type="number" id="jumlahu" name="jumlah" placeholder="Input Jumlah"
                                    class="form-control" />

                            </div><!-- input-group -->

                            <br>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button id="submitbtnu" type="button" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <div style="vertical-align: bottom" class="d-flex justify-content-between">
            <h6 class="mb-0 text-uppercase">Manajemen Data Simpanan Anggota - {{ $dataa->kode }} {{ $dataa->name }}
            </h6>
            <div>
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                    data-bs-target="#exampleLargeModal" class="btn btn-sm btn-success">Pengajuan Penarikan <i
                        class="bx bx-folder-plus"></i></button>


            </div>
        </div>

        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-hover table-bordered" style="width:100%">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Kode Penarikan</th>
                                <th>Tanggal Penarikan</th>
                                <th>Jumlah Penarikan</th>
                                <th>Tabungan</th>
                                <th>Sisa</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>


                    </table>
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
    <script src="{{ asset('v/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('v/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js">
    </script>
    <script>
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
                        width: "20%",

                    },
                    {
                        orderable: false,

                        targets: 3,
                        width: "20%",

                    },
                    {
                        orderable: false,

                        targets: 4,
                        width: "20%",


                    },
                    {
                        orderable: false,
                        visible: true,
                        targets: 5,
                        width: "20%",

                    },
                    {
                        orderable: false,
                        visible: true,
                        targets: 6,
                        width: "20%",

                    },
                    {
                        orderable: false,
                        visible: true,
                        targets: 7,
                        width: "20%",

                    },
                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('anggota/data-penarikan') }}",
                },

                columns: [{
                        nama: 'DT_RowIndex',
                        data: 'DT_RowIndex'
                    }, {
                        nama: 'kode',
                        data: 'kode'
                    },
                    {
                        nama: 'tanggal',
                        data: 'tanggal'
                    },

                    {
                        nama: 'jumlah',
                        data: function(param) {
                            return 'Rp. ' + param['jumlah']
                        }
                    },

                    {
                        nama: 'tabungan',
                        data: function(param) {
                            return 'Rp. ' + param['tabungan'];
                        }
                    },
                    {
                        name: 'sisa',
                        data: function(param) {
                            return 'Rp. ' + (param['tabungan'] - param['jumlah']);
                        },
                    },
                    {
                        name: 'status_pe',
                        data: 'status_pe',
                    }, {
                        nama: 'aksi',
                        data: 'aksi'
                    },
                ],

            });




        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var url = window.location.origin;
        $("#jenissimpanan").on('change', function(e) {
            var optVal = $("#jenissimpanan option:selected");
            $("#jumlahs").val(optVal[0].dataset.jumlah)
            $("#namas").val(optVal[0].dataset.name)

            console.log(optVal[0].dataset.name)
        })

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
                    url: url + '/admin/tabungan/penarikan/' + id,
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
        $("#submitbtn").on('click', function() {
            checking();
        });

        function checking() {
            var simpanan = $("#simpanan").val();
            var penarikan = $("#penarikan").val();
            if (parseInt(penarikan) > parseInt(simpanan)) {
                round_error_noti("Simpanan tidak mencukupi");
            } else {
                if (parseInt(penarikan) == 0) {
                    round_error_noti("Penarikan tidak sah");
                } else {
                    $("#tambahdata").trigger('submit');
                }

            }
        }
        $("#tambahdata").on('submit', function(id) {
            id.preventDefault();
            var data = $(this).serialize();
            $.LoadingOverlay("show");
            $.ajax({
                url: '{{ route('penarikan.store') }}',
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
                url: '{{ route('simpanan.update') }}',
                data: data,
                type: "POST",

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

        function staffupd(id) {
            $('#exampleLargeModalu').modal('show');
            $('#editdata').trigger("reset");
            $("#idu").val(id.id);
            $("#jumlahu").val(id.jumlah);

            $("#namau").val(id.nama);

            $("#kodeu").val(id.kode);

        }
    </script>
@endpush
